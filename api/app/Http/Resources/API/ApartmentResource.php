<?php

namespace App\Http\Resources\API;

use App\Helpers;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ApartmentResource extends JsonResource
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
            "name" => $this->name,
            "description" => $this->description,
            "slug" => $this->slug,
            "code" => $this->code,
            "deadline" => $this->deadline ? Helpers::format($this->deadline) : null,
            'expired' => $this->isExpired(),
            "price" => $this->price,
            "price_after" => $this->price_after,
            "down_payment_percent" => $this->down_payment_percent,
            "down_payment_value" => $this->down_payment_value,
            "installments_period" => $this->installments_period,
            "installments_value" => $this->installments_value,
            "meter_price" => $this->meter_price,
            "for_investment" => $this->for_investment,
            "return_investment_value" => $this->return_investment_value,
            "bedrooms" => $this->bedrooms,
            "living_rooms" => $this->living_rooms,
            "total_area" => $this->total_area,
            "net_area" => $this->net_area,
            "directions" => $this->getDirections(),
            "floor" => $this->floor,
            "apartment_number" => $this->apartment_number,
            "bloc_number" => $this->bloc_number,
            "floors" => $this->floors,
            "bathrooms" => $this->bathrooms,
            "balacony" => $this->balacony,
            "kitchen_type" => $this->kitchen_type ? trans("site.$this->kitchen_type") : "",
            "image" => $image,
            "created_at" => Helpers::format($this->created_at),

            "project" => new ProjectResource($this->project),

            "payment_type" => new PaymentTypeResource($this->paymentType),
            "investment_return" => new InvestmentReturnResource($this->investmentReturn),
            "apartment_type" => new ApartmentTypeResource($this->apartmentType),
            "views" => ApartmentViewResource::collection($this->views),
            "deliverables" => ApartmentDeliverableResource::collection($this->deliverables),
            "tags" => ApartmentDeliverableResource::collection($this->tags),
            "images" => MediaResource::collection($this->getMediaResource()),
            "offer" => new PropertyOfferResource($this->offer),

            "image_title" => $this->when($this->withSeo, basename($image)),
            "image_alt" => $this->when($this->withSeo, $this->image_alt),
            "seo" => $this->when($this->withSeo, $this->getSeo(), []),

            "status" => $this->apartmentStatus ? new ApartmentStatusResource($this->apartmentStatus) : null
        ];

        if ($this->project) {
            $result = array_merge($result, [
                "municipality" => new MunicipalityResource($this->project->municipality),
                "downtown_distance" => $this->project->downtown_distance,
                "landmarks" => $this->project->getLandmarksKeyByType(),
                "transports" => TransportResource::collection($this->project->transports)
            ]);
        } else {
            $result = array_merge($result, [
                "municipality" => new MunicipalityResource($this->municipality),
                "downtown_distance" => $this->downtown_distance,
                "landmarks" => $this->getLandmarksKeyByType(),
                "transports" => TransportResource::collection($this->transports)
            ]);
        }

        if ($this->related)
            $result['related'] = SimpleApartmentResource::collection($this->related);
        return $result;
    }

    public function withSeo()
    {
        $this->withSeo = true;
        return $this;
    }
}
