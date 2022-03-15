<?php

namespace App\Http\Resources\Algolia;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectAlgoliaResource extends JsonResource
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
            "name" => $this->getTranslations('name'),
            "slug" => $this->slug,
            "code" => $this->code,
            "contact" => $this->contact,
            "phone" => $this->phone,
            "availability" => $this->availability,
            "delivery_date" => $this->delivery_date,
            "ready_for_registration" => $this->ready_for_registration,
            "building" => $this->building,
            "apartments" => $this->apartments,
            "construction_company" => $this->construction_company,
            "image" => $this->image,
            "created_at" => $this->created_at,
            "facilities" => FacilityAlgoliaResource::collection($this->facilities),
        ];
    }
}
