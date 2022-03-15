<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PageResource extends JsonResource
{
    private $withSeo;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "slug" => $this->slug,
            "title" => $this->title,
            "sections" => PageSectionResource::collection($this->allSections),

            "image_title" => $this->when(($this->withSeo && $this->seo_image), basename(Storage::url($this->seo_image))),
            "image_alt" => $this->when($this->withSeo, $this->image_alt),
            "seo" => $this->when($this->withSeo, $this->getSeo(), [])
        ];
    }

    public function withSeo()
    {
        $this->withSeo = true;
        return $this;
    }
}
