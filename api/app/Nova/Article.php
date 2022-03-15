<?php

namespace App\Nova;

use App\Http\Resources\API\ArticleResource;
use App\Nova\Filters\StatusFilter;
use App\Nova\Filters\TypeFilter;
use Benjaminhirsch\NovaSlugField\Slug;
use App\Nova\Filters\FromDateFilter;
use App\Nova\Filters\ToDateFilter;
use App\Rules\CheckImage;
use Davidpiesse\NovaToggle\Toggle;
use Digitalcloud\MultilingualNova\Multilingual;
use DigitalCloud\MultiSelectField\MultiSelectField;
use DigitalCloud\TranslatableSlug\TranslatableSlug;
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\TabsOnEdit;
use Illuminate\Http\Request;
use Infinety\Filemanager\FilemanagerField;
use Laravel\Nova\Fields\ID;
use App\Models\Article as ResourceModel;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use MrMonat\Translatable\Translatable;
use Laravel\Nova\Panel;
use NovaButton\Button;

class Article extends Resource
{
    use Authorizable, TabsOnEdit;
    public static $model = ResourceModel::class;
    public static $apiResource = ArticleResource::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'title', 'type'
    ];

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
            (new Tabs('Article', [
                'Info' => [
                    ID::make()->sortable(),

                    TranslatableSlug::make('Title')
                        ->slug('slug')
                        ->forLang(config("app.fallback_locale"))
                        ->rules("required", 'max:254')
                        ->sortable(false),

                    Slug::make('Slug')
                        ->disableAutoUpdateWhenUpdating()
                        ->showUrlPreview('https://fanarrealty.com/blog')
                        ->help("This text will appear in the url!")
                        ->onlyOnForms()
                        ->creationRules("required", 'unique:articles,slug', 'max:254')
                        ->updateRules("required", 'unique:articles,slug,{{resourceId}}', 'max:254'),

                    Translatable::make("Description")
                        ->rules("required")
                        ->hideFromIndex(),

                    Translatable::make('Details')
                        ->hideFromIndex()
                        ->rules("required")
                        ->tiny([
                            'plugins' => [
                                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                                'searchreplace wordcount visualblocks visualchars code fullscreen',
                                'insertdatetime media nonbreaking save table contextmenu directionality',
                                'emoticons template paste textcolor colorpicker textpattern'
                            ],
                            'use_lfm' => true,
                            'toolbar' => 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media',
                        ]),

                    Toggle::make('Show Table Of content', 'show_toc')
                        ->rules("required", "boolean")
                        ->values(true, false)
                        ->hideFromIndex(),

                    Translatable::make('Table Of Content')->asHtml()->onlyOnDetail(),

                    Select::make('Type')
                        ->rules("required")
                        ->options(array_flip(self::$model::TYPES)),

                    MultiSelectField::make('Keywords')
                        ->rules("required", "array")
                        ->hideFromIndex()
                        ->translatable()
                        ->tagging(),

                    Toggle::make('Status')
                        ->rules("required")
                        ->values(self::$model::STATUS_ACTIVE, self::$model::STATUS_NOT_ACTIVE),

                    FilemanagerField::make('Image')
                        ->help("max file size 4M")
                        ->rules("required", new CheckImage(4))
                        ->folder("articles")
                        ->displayAsImage()
                        ->hideFromIndex(),

                    Multilingual::make('Language')->hideFromIndex(),
                    $this->getLink()
                ],
                'SEO' => $this->getSeoFields()
            ]))->withToolbar(),
        ];
    }

    public function filters(Request $request)
    {
        return [
            new TypeFilter(self::$model::TYPES),
            new StatusFilter(self::$model::STATUSES),
            new FromDateFilter(),
            new ToDateFilter()
        ];
    }

    private function getSeoFields()
    {
        return [
            Translatable::make('Image Alt')->singleLine()
                ->hideFromIndex()
                ->rules('required', 'max:254'),

            MultiSelectField::make('Keywords', 'seo_keywords')
                ->rules("nullable", "array")
                ->hideFromIndex()
                ->translatable()
                ->tagging(),

            Multilingual::make('Language')->onlyOnForms(),
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
            ->link(config("app.website") . "/blog/{$this->resource->slug}", '_blank');
    }
}
