<?php

namespace App\Http\Resources\Algolia;

use App\Helpers;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ApartmentAlgoliaResource extends JsonResource
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
            "name" => $this->getTranslations('name'),
            "slug" => $this->slug,
            "code" => $this->code,
            "deadline" => $this->deadline ? Helpers::format($this->deadline) : null,
            'expired' => $this->isExpired(),
            "price" => (double)$this->price,
            "price_after" => (double)$this->price_after,
            "down_payment_percent" => $this->down_payment_percent,
            "down_payment_value" => $this->down_payment_value,
            "installments_period" => $this->installments_period,
            "installments_value" => $this->installments_value,
            "meter_price" => $this->meter_price,
            "for_investment" => $this->for_investment,
            "return_investment_value" => $this->return_investment_value,
            "bedrooms" => $this->bedrooms,
            "living_rooms" => $this->living_rooms,
            "total_area" => (double)$this->total_area,
            "net_area" => (double)$this->net_area,
            "directions" => $this->directions,
            "floor" => $this->floor,
            "apartment_number" => $this->apartment_number,
            "bloc_number" => $this->bloc_number,
            "floors" => $this->floors,
            "bathrooms" => $this->bathrooms,
            "balacony" => $this->balacony,
            "kitchen_type" => $this->kitchen_type ? trans("site.$this->kitchen_type") : "",
            "image" => Storage::url($this->image),
            "floor_plan" => $this->floor_plan ? Storage::url($this->floor_plan) : null,
            "created_at" => $this->created_at,
            "meta" => $this->meta,

            "project" => $this->project ? new ProjectAlgoliaResource($this->project) : null,

            "payment_type" => $this->paymentType ? new PaymentTypeAlgoliaResource($this->paymentType) : null,
            "investment_return" => $this->investmentReturn ? new InvestmentReturnAlgoliaResource($this->investmentReturn) : null,
            "apartment_type" => $this->apartmentType ? new ApartmentTypeAlgoliaResource($this->apartmentType) : null,
            "views" => ViewsAlgoliaResource::collection($this->views),
            "tags" => ViewsAlgoliaResource::collection($this->tags),
            "deliverables" => DeliverablesAlgoliaResource::collection($this->deliverables),
            "status" => $this->apartmentStatus ? new ApartmentStatusAlgoliaResource($this->apartmentStatus) : null
        ];

        if ($this->project) {
            $result = array_merge($result, [
                "municipality" => new MunicipalityAlgoliaResource($this->project->municipality),
                "downtown_distance" => $this->project->downtown_distance,
            ]);
        } else {
            $result = array_merge($result, [
                "municipality" => new MunicipalityAlgoliaResource($this->municipality),
                "downtown_distance" => $this->downtown_distance,
            ]);
        }

        return $result;
    }
}
