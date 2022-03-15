<?php

namespace App\Http\Resources\API;

use App\Helpers;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyOfferResource extends JsonResource
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
            "age" => $this->age,
            "rooms" => $this->rooms,
            "rooms_categories" => $this->rooms_categories,
            "annual_expenses" => $this->annual_expenses,
            "expected_return_value" => $this->expected_return_value,
            "building_area" => $this->building_area,
            "available_furniture" => $this->available_furniture,
//            "end_date" => Helpers::format($this->end_date),
        ];
    }
}
