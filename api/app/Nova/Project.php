<?php

namespace App\Nova;

use App\Http\Resources\API\ProjectResource;
use App\Nova\Filters\FromDateFilter;
use App\Nova\Filters\ToDateFilter;
use App\Rules\CheckImage;
use Benjaminhirsch\NovaSlugField\Slug;
use Davidpiesse\NovaToggle\Toggle;
use DigitalCloud\MultiSelectField\MultiSelectField;
use DigitalCloud\TranslatableSlug\TranslatableSlug;
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\TabsOnEdit;
use Illuminate\Http\Request;
use Infinety\Filemanager\FilemanagerField;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use App\Models\Project as ResourceModel;
use Laravel\Nova\Http\Requests\NovaRequest;
use Media24si\NovaYoutubeField\Youtube;
use NovaAjaxSelect\AjaxSelect;
use Laravel\Nova\Panel;

class Project extends Resource
{
    use Authorizable, TabsOnEdit;

    public static $apiResource = ProjectResource::class;

    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->cities = \App\Models\City::all()->mapWithKeys(function ($city) {
            return [$city->id => $city->name];
        });
        $this->facilities = \App\Models\Facility::pluck('name', 'id')->toArray();
        $this->transports = \App\Models\Transport::pluck('name', 'id')->toArray();
    }

    private $cities;
    private $facilities;
    private $transports;


    public static $with = ['municipality.city',  'transports', 'facilities'];
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

    public static $group = "Projects";

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
        return [
            (new Tabs('Project', [
                    'Main Info' => [
                        ID::make()->sortable(),

                        TranslatableSlug::make('Name')
                            ->slug('slug')
                            ->forLang(config("app.fallback_locale"))
                            ->rules("required", 'max:254')
                            ->sortable(false),

                        Slug::make('Slug')
                            ->help("This text will appear in the url!")
                            ->disableAutoUpdateWhenUpdating()
                            ->onlyOnForms()
                            ->readonly()
                            ->creationRules("required", 'unique:projects,slug', 'max:254')
                            ->updateRules("required", 'unique:projects,slug,{{resourceId}}', 'max:254'),

                        Text::make('Code')
                            ->rules('required', 'max:254', "alpha_num")
                            ->creationRules("unique:projects,code")
                            ->updateRules("unique:projects,code,{{resourceId}}"),
                    ],
                    'Contact' => [
                        Text::make('Contact')
                            ->help("for internal use")
                            ->rules("required", 'max:254')
                            ->hideFromIndex(),

                        Text::make('Phone')
                            ->help("for internal use")
                            ->rules("required", "required", 'max:254')
                            ->hideFromIndex(),
                    ],
                    'Location' => [
                        $this->getCityField($request),

                        $this->getMunicipalityField($request),

                        $this->getLandmarksField($request),
                    ],
                    'Other Info' => [
                        Number::make('Buildings')
                            ->rules("required", 'integer', 'min:0')
                            ->hideFromIndex(),

                        Number::make('Apartments')
                            ->rules("nullable", 'integer', 'min:0')
                            ->hideFromIndex(),

                        Number::make('Availability')
                            ->help("percentage %")
                            ->rules("nullable", 'numeric', 'min:0', 'max:100')
                            ->step(0.01)
                            ->hideFromIndex(),

                        Number::make('Downtown Distance')
                            ->help("in km")
                            ->rules("required", 'numeric', 'min:0')
                            ->hideFromIndex(),

                        Text::make("Construction Company")
                            ->help("for internal use")
                            ->rules("nullable", 'max:254')
                            ->hideFromIndex(),

                        Date::make("Delivery Date")
                            ->rules("nullable", 'date')
                            ->hideFromIndex(),

                        Toggle::make('Ready For Registration')
                            ->rules("required", "boolean")
                            ->values(true, false)
                            ->hideFromIndex(),

                        MultiSelectField::make("Facilities")
                            ->relation("facilities")
                            ->rules("nullable", "array")
                            ->options($this->facilities),

                        MultiSelectField::make("Transports")
                            ->relation("transports")
                            ->rules("nullable", "array")
                            ->options($this->transports),

                        FilemanagerField::make('Image')
                            ->help("max file size 4M")
                            ->rules("required", new CheckImage(4))
                            ->folder("projects")
                            ->displayAsImage()
                            ->hideFromIndex(),

                        Youtube::make('Video')
                            ->help("select the last segment of the youtube url like HwyheOVNuTc in  'https://www.youtube.com/watch?v=HwyheOVNuTc'")
                            ->rules("nullable")->hideFromIndex()
                    ]
                ]
            )),
        ];
    }

    private function getCityField(Request $request)
    {
        return $this->viewIs('detail', $request) ? Text::make("City", "municipality.city.name") :
            Select::make('City')
                ->options($this->cities)
                ->withMeta([
                    'value' => $this->model()->municipality->city_id ?? null
                ])
                ->onlyOnForms()
                ->rules('required', 'integer')
                ->fillUsing(function () {
                });
    }

    private function getMunicipalityField(Request $request)
    {
        return $this->viewIs('detail', $request) ? Text::make("Municipality", "municipality->name") :
            AjaxSelect::make('Municipality', 'municipality_id')
                ->get('/api/city/{city}/municipalities')
                ->parent('city')
                ->onlyOnForms()
                ->rules('required', 'integer');
    }

    private function getLandmarksField(Request $request)
    {
        return MultiSelectField::make("Landmarks")
            ->rules("nullable", "array")
            ->get('/api/municipality/{municipality_id}/landmarks')
            ->parent('municipality_id')
            ->relation('landmarks')
            ->options($this->viewIs('detail', $request) ? $this->municipality->landmarks->mapWithKeys(function ($city) {
                return [$city->id => $city->name];
            }) : [])
            ->hideFromIndex();
    }

    public function filters(Request $request)
    {
        return [
            new FromDateFilter(),
            new ToDateFilter()
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

}
