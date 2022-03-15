<?php

namespace App\Nova;

use App\Http\Resources\API\SimpleApartmentResource;
use App\Nova\Actions\DuplicateApartmentAction;
use App\Nova\Actions\ShowInHome;
use App\Nova\Filters\OfferFilter;
use App\Nova\Lenses\HomePageApartments;
use Benjaminhirsch\NovaSlugField\Slug;
use DigitalCloud\TranslatableSlug\TranslatableSlug;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Http\Requests\CreateResourceRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Http\Requests\UpdateResourceRequest;
use MrMonat\Translatable\Translatable;
use App\Nova\Filters\FromDateFilter;
use App\Nova\Filters\ToDateFilter;
use App\Rules\CheckImage;
use Davidpiesse\NovaToggle\Toggle;
use DigitalCloud\MultiSelectField\MultiSelectField;
use Epartment\NovaDependencyContainer\HasDependencies;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Illuminate\Http\Request;
use Infinety\Filemanager\FilemanagerField;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphMany;
use App\Models\Apartment as ResourceModel;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Media24si\NovaYoutubeField\Youtube;
use NovaAjaxSelect\AjaxSelect;
use NovaButton\Button;
use Yassi\NestedForm\NestedForm;
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\TabsOnEdit;
use Laravel\Nova\Panel;

class Apartment extends Resource
{
    use Authorizable, HasDependencies, TabsOnEdit;

    public static $with = ['offer', 'apartmentStatus', "project", "project.municipality.city",
        "municipality.city"];

    public static $apiResource = SimpleApartmentResource::class;

    public function __construct(\Illuminate\Database\Eloquent\Model $resource)
    {
        parent::__construct($resource);
        $this->views = \App\Models\ApartmentView::pluck('name', 'id')->toArray();
        $this->cities = \App\Models\City::all()->mapWithKeys(function ($city) {
            return [$city->id => $city->name];
        });
        $this->transports = \App\Models\Transport::pluck('name', 'id')->toArray();
        $this->devliverables = \App\Models\ApartmentDeliverable::pluck('name', 'id')->toArray();
        $this->tags = \App\Models\ApartmentTag::pluck('name', 'id')->toArray();
    }

    private $views;
    private $devliverables;
    private $tags;
    private $cities;
    private $transports;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = ResourceModel::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name', 'code'
    ];

    public static $group = "Apartments";


    public static $resourcePermissions = [
        'viewAny',
        'view',
        'create',
        'update',
        'delete'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        $this->model()->has_project = $this->model()->id ? (!!$this->model()->project_id) : true;
        $is_detail = $this->viewIs('detail', $request);

        if (($request instanceof CreateResourceRequest) || ($request instanceof UpdateResourceRequest)) {
            $model = $this->model();
            if ($request->get("has_project") && !$model->project_id) {
                $request->merge([
                    "municipality_id" => null,
                    "downtown_distance" => null,
                    "landmarks" => [],
                    "transports" => []
                ]);
            } elseif (!$request->get("has_project") && $model->project_id) {
                $request->merge([
                    "project" => null
                ]);
            }
        }

        return [
            (new Tabs('Apartment', [
                'Project' => [
                    Toggle::make('Belongs To Project', 'has_project')
                        ->rules("required", "boolean")
                        ->values(true, false)
                        ->hideFromIndex()
                        ->fillUsing(function () {
                        }),

                    NovaDependencyContainer::make($this->getProjectFields($is_detail))
                        ->dependsOn('has_project', false),

                    NovaDependencyContainer::make([
                        BelongsTo::make("Project")
                            ->rules("required_if:has_project,1")
                            ->hideFromIndex(),
                    ])->dependsOn('has_project', true),

                    $this->getLink()->onlyOnDetail()
                ],
                'Apartment' => [
                    ID::make()->sortable(),

                    BelongsTo::make("Apartment Type", "apartmentType", ApartmentType::class)
                        ->hideFromIndex()
                        ->rules("nullable"),

                    Text::make('Code')
                        ->rules('required', 'max:254', "alpha_num")
                        ->creationRules("unique:apartments,code")
                        ->updateRules("unique:apartments,code,{{resourceId}}"),

                    TranslatableSlug::make('Name')
                        ->slug('slug')
                        ->forLang(config("app.fallback_locale"))
                        ->rules("required", 'max:254')
                        ->sortable(false),

                    Slug::make('Slug')
                        ->help("This text will appear in the url!")
                        ->onlyOnForms()
                        ->disableAutoUpdateWhenUpdating()
                        ->showUrlPreview(config("app.website") . "/properties/istanbul/{$this->resource->slug}")
                        ->creationRules("required", 'unique:apartments,slug', 'max:254')
                        ->updateRules("required", 'unique:apartments,slug,{{resourceId}}', 'max:254'),

                    Translatable::make("Description")
                        ->rules("nullable")
                        ->hideFromIndex(),

                    BelongsTo::make("Status", "apartmentStatus", ApartmentStatus::class)
                        ->nullable()
                        ->hideFromIndex(),

                    Date::make("Deadline")
                        ->creationRules('after_or_equal:now')
                        ->rules("nullable", 'date')
                        ->hideFromIndex(),

                    Boolean::make("Show In Home")->onlyOnDetail(),

                    Number::make('Floors')
                        ->rules("required", 'integer', 'min:0')
                        ->hideFromIndex(),

                    Number::make('Floor')
                        ->rules("nullable", 'integer', 'min:0')
                        ->hideFromIndex(),

                    Number::make('Apartment Number')
                        ->rules("nullable", 'integer', 'min:0')
                        ->hideFromIndex(),

                    Text::make('Bloc Number')
                        ->rules("nullable")
                        ->hideFromIndex(),

                    MultiSelectField::make("Tags")
                        ->relation("tags")
                        ->rules("nullable", "array")
                        ->options($this->tags),

                    FilemanagerField::make('Image')
                        ->help("max file size 4M")
                        ->rules("required", new CheckImage(4))
                        ->folder("projects")
                        ->displayAsImage()
                        ->hideFromIndex(),

                    FilemanagerField::make('Floor Plan')
                        ->help("max file size 4M")
                        ->rules("nullable", new CheckImage(4))
                        ->folder("apartments")
                        ->displayAsImage()
                        ->hideFromIndex(),

                    Youtube::make('Video')
                        ->help("select the last segment of the youtube url like 'HwyheOVNuTc' in  'https://www.youtube.com/watch?v=HwyheOVNuTc'")
                        ->hideFromIndex(),

                    Boolean::make("Special Project", "offer", function () {
                        return !!$this->model()->offer;
                    })->onlyOnIndex(),

                    Select::make("Show In", "show_in_home")->displayUsingLabels()
                        ->options(array_flip(\App\Models\Apartment::SHOW_IN))->exceptOnForms(),

                ],
                'Size & Payment' => [
                    Number::make('Total Area')
                        ->rules("required", 'numeric', 'min:0')
                        ->step(0.01)
                        ->hideFromIndex(),

                    Number::make('Net Area')
                        ->rules("nullable", 'numeric', 'min:0', 'lte:total_area')
                        ->step(0.01)
                        ->hideFromIndex(),

                    Number::make('Price Before', 'price')
                        ->hideFromIndex()
                        ->rules("nullable", 'numeric', 'min:0'),

                    Number::make('Price After', 'price_after')
                        ->hideFromIndex()
                        ->rules("required", 'numeric', 'min:0'),

                    Number::make('Meter Price')
                        ->rules("nullable", 'numeric', 'min:0')
                        ->hideFromIndex(),

                    Toggle::make('For Investment')
                        ->hideFromIndex()
                        ->rules("nullable", "boolean")
                        ->values(true, false),

                    NovaDependencyContainer::make([
                        BelongsTo::make("Investment Returns", "investmentReturn", InvestmentReturn::class)
                            ->rules("required_if:for_investment,1"),

                        Text::make('Return Investment Value')
                            ->rules("required_if:for_investment,1")
                            ->hideFromIndex(),
                    ])->dependsOn('for_investment', true),

                    BelongsTo::make("Payment Type", "paymentType", PaymentType::class)
                        ->hideFromIndex()
                        ->nullable(),

                    Number::make('Down Payment Percent')
                        ->rules("nullable", 'numeric', 'min:0', 'max:100')
                        ->step(0.01)
                        ->hideFromIndex(),

                    Number::make('Down Payment Value')
                        ->readonly(true)
                        ->fillUsing(function ($request, $model, $attribute, $requestAttribute) {
                            $priceAfter = (float)$request->price_after;
                            $downPercent = (float)$request->down_payment_percent;
                            $model->$attribute = $priceAfter * $downPercent / 100;
                        })
                        ->hideFromIndex(),
                    Number::make('Installments Period')
                        ->rules("nullable", 'integer', 'min:0')
                        ->hideFromIndex(),

                    Number::make('Installments Value')
                        ->readonly(true)
                        ->fillUsing(function ($request, $model, $attribute, $requestAttribute) {
                            if ($request->installments_period) {
                                $priceAfter = (float)$request->price_after;
                                $downPercent = (float)$request->down_payment_percent;
                                $installments_period = (int)$request->installments_period;
                                $downValue = $priceAfter * $downPercent / 100;
                                $model->$attribute = ($priceAfter - $downValue) / $installments_period;
                            } else {
                                $model->$attribute = 0;
                            }
                        })
                        ->hideFromIndex()
                ],
                'Facilities' => [
                    Number::make('Bedrooms')
                        ->rules("nullable", 'integer', 'min:0')
                        ->hideFromIndex(),

                    Number::make('Living Rooms')
                        ->rules("nullable", 'integer', 'min:0')
                        ->hideFromIndex(),

                    Number::make('Bathrooms')
                        ->rules("nullable", 'integer', 'min:0')
                        ->hideFromIndex(),

                    Toggle::make('Balacony')
                        ->rules("nullable", "boolean")
                        ->values(true, false)
                        ->hideFromIndex(),

                    Select::make('Kitchen Type')
                        ->rules("nullable")
                        ->options(array_flip(\App\Models\Apartment::KITCHEN_TYPES))
                        ->hideFromIndex(),

                    MultiSelectField::make("Directions")
                        ->options(array_flip(\App\Models\Apartment::DIRECTIONS))
                        ->rules("nullable", 'array')
                        ->hideFromIndex(),

                    MultiSelectField::make("Views")
                        ->relation("views")
                        ->rules("nullable", "array")
                        ->options($this->views),

                    MultiSelectField::make("Deliverables")
                        ->relation("deliverables")
                        ->rules("nullable", "array")
                        ->options($this->devliverables)],
                'SEO' => $this->getSeoFields(),
                'Special Project' => [
                    NestedForm::make('Offer', "offers", ApartmentOffer::class)
                        ->open($this->model()->id && $this->model()->offers ? true : false)
                        ->max(1)
                        ->heading('Starred Apartment Info'),

                    HasOne::make('Offer', "offer", ApartmentOffer::class)->onlyOnDetail(),
                ],
                'Images' => [
                    Images::make('Gallery', 'media')
                        ->croppable(false)->onlyOnForms()
                        ->setFileName(function ($originalFilename, $extension, $model) {
                            return \App\Models\Media::hashName($extension);
                        }),
                    MorphMany::make("Images", "media", Media::class)->exceptOnForms()
                ],
            ]))->withToolbar()->defaultSearch(false),

            $this->getLink()->onlyOnIndex()
        ];
    }

    private function getProjectFields($is_detail)
    {
        $fields = [];
        if ($is_detail) {
            $fields[] = Text::make("City", "municipality.city.name");
            $fields[] = Text::make("Municipality", "municipality->name");
        } else {
            $fields[] = Select::make('City')
                ->options($this->cities)
                ->withMeta([
                    'value' => optional($this->resource->municipality)->city_id
                ])
                ->hideFromIndex()
                ->rules('required_if:has_project,0', 'integer')
                ->fillUsing(function () {
                })->onlyOnForms();

            $fields[] = AjaxSelect::make('Municipality', 'municipality_id')
                ->get('/api/city/{city}/municipalities')
                ->parent('city')
                ->rules('required_if:has_project,0', 'integer');
        }
        return array_merge($fields, [MultiSelectField::make("Landmarks")
            ->rules("nullable", "array")
            ->get('/api/municipality/{municipality_id}/landmarks')
            ->parent('municipality_id')
            ->relation('landmarks')
            ->options($is_detail ? ($this->municipality ? $this->municipality->landmarks->mapWithKeys(function ($city) {
                return [$city->id => $city->name];
            }) : []) : []),

            MultiSelectField::make("Transports")
                ->relation("transports")
                ->rules("nullable", "array")
                ->options($this->transports),

            Number::make('Downtown Distance')
                ->rules("required_if:has_project,0", 'numeric', 'min:0')
                ->hideFromIndex(),
        ]);
    }

    public function filters(Request $request)
    {
        return [
            new OfferFilter(),
            new \App\Nova\Filters\ShowInHome(),
            new FromDateFilter(),
            new ToDateFilter()
        ];
    }

    public function lenses(Request $request)
    {
        return [
            new HomePageApartments
        ];
    }

    public function actions(Request $request)
    {
        return [
            new ShowInHome,
            new DuplicateApartmentAction
        ];
    }

    private function getSeoFields()
    {
        return [
            Translatable::make('Image Alt', 'image_alt')->singleLine()
                ->hideFromIndex()
                ->rules('nullable', 'max:254'),

            Translatable::make('Keywords', 'seo_keywords')->singleLine()
                ->hideFromIndex()
                ->rules('nullable'),

            // MultiSelectField::make('Keywords', 'seo_keywords')
            //     ->rules("nullable", "array")
            //     ->hideFromIndex()
            //     ->translatable()
            //     ->tagging(),

            // Multilingual::make('Language')
        ];
    }

    public function creationFields(NovaRequest $request)
    {
        return collect(
            [
                'Tabs' => [
                    'component' => 'tabs',
                    'fields' => $this->removeNonCreationFields($this->resolveFields($request)),
                    'panel' => Panel::defaultNameForCreate($request->newResource()),
                ],
            ]
        );
    }

    private function getLink()
    {
        return Button::make('Preview')
            ->exceptOnForms()
            ->fillUsing(function () {
            })
            ->label("Preview")
            ->link(config("app.website") . "/properties/istanbul/{$this->resource->slug}", '_blank');
    }
}
