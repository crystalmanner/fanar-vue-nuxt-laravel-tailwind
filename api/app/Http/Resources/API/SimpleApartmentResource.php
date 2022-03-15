<?php

namespace App\Http\Resources\API;

use App\Helpers;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class SimpleApartmentResource extends JsonResource
{

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
            "name" => $this->name,
            "slug" => $this->slug,
            "price" => $this->price,
            "price_after" => $this->price_after,
            "bedrooms" => $this->bedrooms,
            "bathrooms" => $this->bathrooms,
            "total_area" => $this->total_area,
            "image" => $image,
            "image_title" => basename($image),
            "image_alt" => $this->image_alt,
            "deadline" => $this->deadline ? Helpers::format($this->deadline) : null,
            'expired' => $this->isExpired(),
            "status" => new ApartmentStatusResource($this->apartmentStatus)
        ];

        if ($this->project) {
            $result = array_merge($result, [
                "municipality" => new MunicipalityResource($this->project->municipality)
            ]);
        } else {
            $result = array_merge($result, [
                "municipality" => new MunicipalityResource($this->municipality)
            ]);
        }
        return $result;
    }
}
