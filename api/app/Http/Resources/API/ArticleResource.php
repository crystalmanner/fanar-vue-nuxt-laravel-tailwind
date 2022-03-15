<?php

namespace App\Http\Resources\API;

use App\Helpers;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ArticleResource extends JsonResource
{
    private $withSeo = false;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $image = Storage::url($this->image);

        $result = [
            "id" => $this->id,
            "title" => $this->title,
            "slug" => $this->slug,
            "description" => $this->description,
            "details" => $this->details,
            "keywords" => $this->keywords ? json_decode($this->keywords, true) : [],
            "image" => $image,
            "type" => $this->type,
            "created_at" => Helpers::format($this->created_at),
            "created_at_meta" => $this->created_at->format("Y-m-d"),
            "table_of_content" => $this->when($this->withSeo && $this->show_toc, $this->table_of_content),

            "image_title" => $this->when($this->withSeo, basename($image)),
            "image_alt" => $this->when($this->withSeo, $this->image_alt),
            "seo" => $this->when($this->withSeo, $this->getSeo(), [])
        ];

        if ($this->related)
            $result['related'] = self::collection($this->related);
        return $result;
    }

    public function withSeo()
    {
        $this->withSeo = true;
        return $this;
    }
}
