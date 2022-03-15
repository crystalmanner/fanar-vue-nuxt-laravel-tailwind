<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class MediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $result = [
            "id" => $this->id,
            "file" => $this->file_name,
            "title" => $this->title
        ];

        if ($this->is_video) {
            $result['is_video'] = true;
        }

        return $result;

    }
}
