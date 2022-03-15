<?php

namespace App\Nova\Templates;

use Illuminate\Http\Request;
use Laravel\Nova\Panel;
use MrMonat\Translatable\Translatable;
use Whitecube\NovaFlexibleContent\Flexible;

class ContactUs extends Template
{

    protected $jsonAttributes = ['title', 'content', 'seo_description', 'image_alt', 'seo_keywords'];

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
            new Panel('Site Page Content', [
                Flexible::make('Content')
                    ->addLayout('Contact Description', 'contact_description', [
                        Translatable::make("Title")
                            ->singleLine()
                            ->rules("required"),

                        Translatable::make("Description")
                            ->rules("required"),
                    ])
                    ->populate()
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
