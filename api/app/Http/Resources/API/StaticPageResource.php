<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;
use Whitecube\NovaPage\Pages\Template;

class StaticPageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        /**
         * @var Template $this
         */
        return [
            "name" => $this->getName(),
            "title" => $this->title,
            "image_title" => $this->seo_image ? basename($this->seo_image) : "",
            "image_alt" => $this->image_alt,
            "content" => $this->mapContent(),
            "seo" => $this->getSeo()
        ];
    }
}
