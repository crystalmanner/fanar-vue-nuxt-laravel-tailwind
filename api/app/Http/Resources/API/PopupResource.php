<?php

namespace App\Http\Resources\API;

use App\Helpers;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PopupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'page' => $this->page,
            'link' => $this->link,
            'seconds' => $this->seconds,
            'image' => Storage::url($this->image),
            'created_at' => Helpers::format($this->created_at)
        ];
    }
}
