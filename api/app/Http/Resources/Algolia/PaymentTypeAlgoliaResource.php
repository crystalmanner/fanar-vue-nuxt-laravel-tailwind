<?php

namespace App\Http\Resources\Algolia;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentTypeAlgoliaResource extends JsonResource
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
            "name" => $this->getTranslations('name'),
        ];
    }
}
