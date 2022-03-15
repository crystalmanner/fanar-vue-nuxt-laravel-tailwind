<?php

namespace App\Http\Resources\API;

use App\Helpers;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProjectResource extends JsonResource
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
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
            "code" => $this->code,
            "contact" => $this->contact,
            "phone" => $this->phone,
            "availability" => $this->availability,
            "delivery_date" => $this->delivery_date ? Helpers::format($this->delivery_date) : null,
            "ready_for_registration" => $this->ready_for_registration,
            "building" => $this->building,
            "apartments" => $this->apartments,
            "construction_company" => $this->construction_company,
            "image" => Storage::url($this->image),
            "created_at" => Helpers::format($this->created_at),
            "facilities" => FacilityResource::collection($this->facilities),
        ];
    }
}
