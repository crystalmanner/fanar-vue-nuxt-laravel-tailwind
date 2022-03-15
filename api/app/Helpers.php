<?php


namespace App;


use Carbon\Carbon;

class Helpers
{
    public static function format(Carbon $date)
    {
        return trans("site." . $date->format("D")) . ", " . $date->format("d") . " " . trans("site." . $date->format("M")) . " " . $date->year;
    }

    public static function getSeoTags($tag)
    {
        return [
            'title' => [
                'title',
                'og:title',
                'twitter:title',
                'subject',
                'topic',
                'apple-mobile-web-app-title'
            ],
            'description' => [
                'description',
                'og:description',
                'twitter:description',
                'summary'
            ],
            'image' => [
                'og:image',
                'twitter:image'
            ],
            'url' => [
                'url',
                'identifier-URL',
                'og:url',
            ]
        ][$tag];
    }

    public static function getGeneralSeo()
    {
        return [
            'language' => app()->getLocale(),
            'author' => "@fanar",
            'twitter:creator' => "@fanar",
            'twitter:site' => "@fanar",
            'twitter:card' => "summary_large_image",
            'og:type' => "website",
            'apple-mobile-web-app-capable' => "yes",
            'apple-touch-fullscreen' => "yes",
            'robots' => "index,follow",
            'twitter:app:country' => "TR",
        ];
    }

    public static function getTagObj($name, $content)
    {
        return ['name' => $name, "content" => $content];
    }
}
