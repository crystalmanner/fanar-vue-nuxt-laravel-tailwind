<?php


namespace App\Nova\Templates;


use App\Helpers;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Panel;
use MrMonat\Translatable\Translatable;

abstract class Template extends \Whitecube\NovaPage\Pages\Template
{
    use HasTranslations;

    public $translatable = ['title', 'seo_description', 'image_alt', 'seo_keywords'];

    public function getSeoFields()
    {
        return new Panel('Site Page SEO', [
            Translatable::make('Description', 'seo_description')
                ->hideFromIndex()
                ->rules('nullable'),

            Translatable::make('Image Alt')->singleLine()
                ->hideFromIndex()
                ->rules('nullable', 'max:254'),

            Translatable::make('Keywords', 'seo_keywords')->singleLine()
                ->hideFromIndex()
                ->rules('nullable'),

            Image::make('Cover Image', 'seo_image')
                ->help("max file size 4M")
                ->rules("nullable")
                ->hideFromIndex()
        ]);
    }

    public function mapContent()
    {
        return collect($this->content)->keyBy('layout')->map(function ($item) {
            if (empty($item['attributes']))
                return null;

            return array_map(function ($attr) {
                if (!is_array($attr)) {
                    return $attr;
                }

                if (empty($attr)) {
                    return "";
                }

                return Arr::get($attr, config('app.locale'));

            }, $item['attributes']);
        });
    }

    public function getSeo()
    {
        $data = [];

        if ($this->title) {
            foreach (Helpers::getSeoTags("title") as $tag) {
                $data[] = Helpers::getTagObj($tag, $this->getAttribute('title'));
            }
        }

        $seo_description = $this->seo_description ?? "";
        foreach (Helpers::getSeoTags("description") as $tag) {
            $data[] = Helpers::getTagObj($tag, $seo_description);
        }

        if ($this->seo_image) {
            foreach (Helpers::getSeoTags("image") as $tag) {
                $data[] = Helpers::getTagObj($tag, Storage::url($this->seo_image));
            }
        }

        if ($this->seo_keywords) {
            $data[] = Helpers::getTagObj("keywords", is_array($this->seo_keywords) ? implode(",", $this->seo_keywords) : $this->seo_keywords);
        }

        foreach (Helpers::getSeoTags("url") as $tag) {
            $data[] = Helpers::getTagObj($tag, config('app.website') . "/{$this->getName()}");
        }

        foreach (Helpers::getGeneralSeo() as $tag => $value) {
            $data[] = Helpers::getTagObj($tag, $value);
        }

        return $data;
    }
}
