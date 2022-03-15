<?php

namespace DigitalCloud\TranslatableSlug;

use Laravel\Nova\Element;
use MrMonat\Translatable\Translatable;

class TranslatableSlug extends Translatable
{
    public $component = "translatable-slug-field";

    /**
     * Specify the field that contains the actual slug.
     *
     * @param string $slugField
     *
     * @return $this
     */
    public function slug($slugField = 'slug'): Element
    {
        return $this->withMeta([__FUNCTION__ => $slugField]);
    }

    /**
     * Create a new field.
     *
     * @param string $name
     * @param string|null $attribute
     * @param mixed|null $resolveCallback
     * @return void
     */
    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $locales = array_map(function ($value) {
            return __($value);
        }, config('translatable.locales'));
        $this->withMeta([
            'locales' => $locales,
            'indexLocale' => app()->getLocale()
        ]);
    }

    public function forLang($lang)
    {
        $this->withMeta([
            'slug_lang' => $lang
        ]);

        return $this;
    }

    /**
     * Resolve the given attribute from the given resource.
     *
     * @param mixed $resource
     * @param string $attribute
     * @return mixed
     */
    protected function resolveAttribute($resource, $attribute)
    {
        if (method_exists($resource, 'getTranslations')) {
            return $resource->getTranslations($attribute);
        }
        return data_get($resource, $attribute);
    }
}
