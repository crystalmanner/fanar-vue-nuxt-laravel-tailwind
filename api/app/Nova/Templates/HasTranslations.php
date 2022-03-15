<?php


namespace App\Nova\Templates;


trait HasTranslations
{
    use \Spatie\Translatable\HasTranslations;

    public function getTranslations(string $key = null): array
    {
        if ($key !== null) {
            $this->guardAgainstNonTranslatableAttribute($key);

            return array_filter($this->getAttributes()[$key] ?? [], function ($value) {
                return $value !== null && $value !== '';
            });
        }

        return array_reduce($this->getTranslatableAttributes(), function ($result, $item) {
            $result[$item] = $this->getTranslations($item);

            return $result;
        });
    }

}
