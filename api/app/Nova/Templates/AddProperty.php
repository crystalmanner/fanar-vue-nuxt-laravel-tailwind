<?php

namespace App\Nova\Templates;

use Illuminate\Http\Request;
use Laravel\Nova\Panel;
use MrMonat\Translatable\Translatable;

class AddProperty extends Template
{

    protected $jsonAttributes = ['title', 'seo_description', 'image_alt', 'seo_keywords'];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            new Panel('Site Page Title', [
                Translatable::make("Title")
                    ->singleLine()
                    ->rules("required"),
            ]),
            $this->getSeoFields()
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }
}
