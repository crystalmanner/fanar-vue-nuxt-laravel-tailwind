<?php

namespace App\Models;

use App\Helpers;
use App\Http\Resources\Algolia\ApartmentAlgoliaResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Scout\Searchable;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;

/**
 * App\Models\Apartment
 *
 * @property int $id
 * @property int|null $project_id
 * @property array|null $name
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $deadline
 * @property int|null $municipality_id
 * @property int|null $landmark_id
 * @property float|null $downtown_distance
 * @property float|null $price
 * @property float|null $price_after
 * @property int|null $payment_type_id
 * @property float|null $down_payment_percent
 * @property float|null $down_payment_value
 * @property int|null $installments_period
 * @property float|null $installments_value
 * @property float|null $meter_price
 * @property bool|null $for_investment
 * @property int|null $investment_return_id
 * @property float|null $return_investment_value
 * @property int|null $apartment_type_id
 * @property int|null $bedrooms
 * @property int|null $living_rooms
 * @property float|null $total_area
 * @property float|null $net_area
 * @property array|null $directions
 * @property int|null $floor
 * @property int|null $apartment_number
 * @property int|null $bloc_number
 * @property int|null $floors
 * @property int|null $bathrooms
 * @property bool|null $balacony
 * @property string|null $kitchen_type
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ApartmentType|null $apartmentType
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ApartmentDeliverable[] $deliverables
 * @property-read mixed $translations
 * @property-read \App\Models\InvestmentReturn|null $investmentReturn
 * @property-read \App\Models\Landmark|null $landmark
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Media[] $media
 * @property-read \App\Models\Municipality|null $municipality
 * @property-read \App\Models\PaymentType|null $paymentType
 * @property-read \App\Models\Project|null $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transport[] $transports
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ApartmentView[] $views
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereApartmentNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereApartmentTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereBalacony($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereBathrooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereBedrooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereBlocNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereDirections($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereDownPaymentPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereDownPaymentValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereDowntownDistance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereFloor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereFloors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereForInvestment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereInstallmentsPeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereInstallmentsValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereInvestmentReturnId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereKitchenType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereLandmarkId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereLivingRooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereMeterPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereMunicipalityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereNetArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment wherePaymentTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment wherePriceAfter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereReturnInvestmentValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereTotalArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereUpdatedAt($value)
 * @property string|null $video
 * @property string|null $floor_plan
 * @property string|null $slug
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Landmark[] $landmarks
 * @property-read \App\Models\ApartmentOffer $offer
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereFloorPlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Apartment whereVideo($value)
 * @mixin \Eloquent
 */
class Apartment extends Model implements HasMedia
{
    use HasTranslations, Searchable;
    use HasMediaTrait;

    public $translatable = ['name', 'description', 'image_alt', 'seo_keywords'];

    public $fillable = [
        'name', 'description', 'project_id', 'code', 'deadline', 'municipality_id', 'landmark_id',
        'downtown_distance', 'price', 'price_after', 'payment_type_id',
        'down_payment_percent', 'down_payment_value', 'installments_period', 'installments_value',
        'meter_price', 'for_investment', 'investment_return_id', 'return_investment_value',
        'apartment_type_id', 'bedrooms', 'living_rooms', 'total_area',
        'net_area', 'directions', 'floor', 'apartment_number',
        'bloc_number', 'floors', 'bathrooms', 'balacony',
        'kitchen_type', 'image', 'video', 'floor_plan', 'slug', 'show_in_home', 'show_at'
        , 'image_alt', 'seo_keywords', 'meta', 'project_status_id'

    ];

    protected $dates = ['deadline'];

    protected $casts = [
        'for_investment' => 'boolean',
        'balacony' => 'boolean',
        'directions' => 'array',
        'name' => 'array',
        'image_alt' => 'array',
        'description' => 'array',
        'seo_keywords' => 'array',
        'meta' => 'array'
    ];

    const DIRECT_NORTH = 'north';
    const DIRECT_SOUTH = 'south';
    const DIRECT_WEST = 'west';
    const DIRECT_EAST = 'east';

    const DIRECTIONS = [
        'North' => self::DIRECT_NORTH,
        'South' => self::DIRECT_SOUTH,
        'West' => self::DIRECT_WEST,
        'East' => self::DIRECT_EAST,
    ];

    const KITCHEN_TYPE_OPEN = 'open';
    const KITCHEN_TYPE_CLOSE = 'close';
    const KITCHEN_TYPES = [
        'Open' => self::KITCHEN_TYPE_OPEN,
        'Close' => self::KITCHEN_TYPE_CLOSE
    ];

    const SHOW_IN_FEATURED_OFFERS = 'featured_offer';
    const SHOW_IN_FEATURED_PROJECTS = 'featured_project';
    const SHOW_IN = [
        'Featured Offer' => self::SHOW_IN_FEATURED_OFFERS,
        'Featured Project' => self::SHOW_IN_FEATURED_PROJECTS,
        'None' => '',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function landmarks()
    {
        return $this->belongsToMany(Landmark::class, "apartment_landmark");
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }

    public function investmentReturn()
    {
        return $this->belongsTo(InvestmentReturn::class);
    }

    public function apartmentType()
    {
        return $this->belongsTo(ApartmentType::class);
    }

    public function transports()
    {
        return $this->belongsToMany(Transport::class, "apartment_transport");
    }

    public function tags()
    {
        return $this->belongsToMany(ApartmentTag::class, "apartment_tag");
    }

    public function views()
    {
        return $this->belongsToMany(ApartmentView::class, "apartment_view");
    }

    public function deliverables()
    {
        return $this->belongsToMany(ApartmentDeliverable::class, "apartment_deliverable");
    }

    public function apartmentStatus()
    {
        return $this->belongsTo(ProjectStatus::class, 'project_status_id');
    }

    public function toSearchableArray()
    {
        $request = new Request();
        $this->load([
            "project.municipality.city",
            "project.facilities",
            "apartmentStatus",
            "municipality.city",
            "paymentType",
            "investmentReturn",
            "apartmentType",
            "views",
            "tags",
            "deliverables",
        ]);

        return (new ApartmentAlgoliaResource($this))->toArray($request);
    }

    public function offer()
    {
        return $this->hasOne(ApartmentOffer::class, "apartment_id");
    }


    public function offers()
    {
        return $this->hasMany(ApartmentOffer::class, "apartment_id");
    }


    public function getLandmarksKeyByType()
    {
        return $this->landmarks->load("landmarkType")->groupBy("landmarkType.name");
    }

    public function getSeo()
    {
        $data = [];

        foreach (Helpers::getSeoTags("title") as $tag) {
            $data[] = Helpers::getTagObj($tag, trans("site.seo_title", ["title" => $this->name]));
        }

        foreach (Helpers::getSeoTags("description") as $tag) {
            $data[] = Helpers::getTagObj($tag, trans("site.seo_description", [
                'type' => $this->apartmentType->name,
                'rooms' => $this->bedrooms,
                'municipality' => $this->project_id ? optional($this->project->municipality)->name : optional($this->municipality)->name,
                'city' => $this->project_id ? optional($this->project->municipality->city)->name : optional($this->municipality->city)->name,
            ]));
        }

        foreach (Helpers::getSeoTags("image") as $tag) {
            $data[] = Helpers::getTagObj($tag, Storage::url($this->image));
        }

        if ($this->seo_keywords) {
            $data[] = Helpers::getTagObj("keywords", is_array($this->seo_keywords) ? implode(",", $this->seo_keywords) : $this->seo_keywords);
        }

        foreach (Helpers::getSeoTags("url") as $tag) {
            $data[] = Helpers::getTagObj($tag, config('app.website') . "/properties/istanbul/{$this->slug}");
        }

        foreach (Helpers::getGeneralSeo() as $tag => $value) {
            $data[] = Helpers::getTagObj($tag, $value);
        }

        return $data;
    }

    public function getDirections()
    {
        if ($this->directions) {
            $trans = [];
            foreach ($this->directions as $direction) {
                $trans[] = trans("site.$direction");
            }
            return $trans;
        } else {
            return [];
        }
    }

    public function getMediaResource()
    {
        $images = $this->media->map(function (Media $media) {
            $media->file_name = $media->getFullUrl();
            if (!$media->title) {
                $media->title = $this->name;
            }
            return $media;
        });

        $images = $images->push(new Media([
            'id' => uniqid(),
            'title' => $this->name,
            'file_name' => Storage::url($this->image)
        ]));

        if ($this->floor_plan) {
            $images = $images->push(new Media([
                'id' => uniqid(),
                'title' => $this->name,
                'file_name' => Storage::url($this->floor_plan)
            ]));
        }

        if ($this->video) {
            $media = new Media([
                'id' => uniqid(),
                'title' => $this->name,
                'file_name' => $this->video
            ]);

            $media->is_video = true;
            $images = $images->push($media);
        }

        return $images;
    }

    public function getPriceMeta()
    {
        $prices = [
            "en" => [
                trans("site.less_500", [], 'en'),
                trans("site.500_1000", [], 'en'),
                trans("site.1000_1500", [], 'en'),
                trans("site.1500_2000", [], 'en'),
                trans("site.2000_2500", [], 'en'),
                trans("site.2500_3000", [], 'en'),
                trans("site.greater_3000", [], 'en'),
            ],
            "ar" => [
                trans("site.less_500", [], 'ar'),
                trans("site.500_1000", [], 'ar'),
                trans("site.1000_1500", [], 'ar'),
                trans("site.1500_2000", [], 'ar'),
                trans("site.2000_2500", [], 'ar'),
                trans("site.2500_3000", [], 'ar'),
                trans("site.greater_3000", [], 'ar'),
            ]
        ];

        if ($this->price < 500)
            return ['en' => $prices['en'][0], 'ar' => $prices['ar'][0]];

        if ($this->price > 500 && $this->price < 1000)
            return ['en' => $prices['en'][1], 'ar' => $prices['ar'][1]];

        if ($this->price > 1000 && $this->price < 1500)
            return ['en' => $prices['en'][2], 'ar' => $prices['ar'][2]];

        if ($this->price > 1500 && $this->price < 2000)
            return ['en' => $prices['en'][3], 'ar' => $prices['ar'][3]];

        if ($this->price > 2000 && $this->price < 2500)
            return ['en' => $prices['en'][4], 'ar' => $prices['ar'][4]];

        if ($this->price > 2500 && $this->price < 3000)
            return ['en' => $prices['en'][5], 'ar' => $prices['ar'][5]];

        return ['en' => $prices['en'][6], 'ar' => $prices['ar'][6]];
    }

    public function getRoomsMeta()
    {
        $rooms = [
            "en" => [
                trans("site.studio", [], 'en'),
                trans("site.1rooms", [], 'en'),
                trans("site.2rooms", [], 'en'),
                trans("site.3rooms", [], 'en'),
                trans("site.4rooms", [], 'en'),
                trans("site.>4rooms", [], 'en'),
            ],
            "ar" => [
                trans("site.studio", [], 'ar'),
                trans("site.1rooms", [], 'ar'),
                trans("site.2rooms", [], 'ar'),
                trans("site.3rooms", [], 'ar'),
                trans("site.4rooms", [], 'ar'),
                trans("site.>4rooms", [], 'ar'),
            ]
        ];

        if ($this->bedrooms > 4)
            return ['en' => $rooms['en'][5], 'ar' => $rooms['ar'][5]];

        return ['en' => $rooms['en'][$this->bedrooms] ?? '', 'ar' => $rooms['ar'][$this->bedrooms] ?? ''];
    }

    public function getAreaMeta()
    {
        $area = [
            "en" => [
                trans("site.<50", [], 'en'),
                trans("site.50_100", [], 'en'),
                trans("site.100_150", [], 'en'),
                trans("site.150_200", [], 'en'),
                trans("site.200_250", [], 'en'),
                trans("site.>250", [], 'en'),
            ],
            "ar" => [
                trans("site.<50", [], 'ar'),
                trans("site.50_100", [], 'ar'),
                trans("site.100_150", [], 'ar'),
                trans("site.150_200", [], 'ar'),
                trans("site.200_250", [], 'ar'),
                trans("site.>250", [], 'ar'),
            ]
        ];

        if ($this->total_area < 50)
            return ['en' => $area['en'][0], 'ar' => $area['ar'][0]];

        if ($this->total_area > 50 && $this->total_area < 100)
            return ['en' => $area['en'][1], 'ar' => $area['ar'][1]];

        if ($this->total_area > 100 && $this->total_area < 150)
            return ['en' => $area['en'][2], 'ar' => $area['ar'][2]];

        if ($this->total_area > 150 && $this->total_area < 200)
            return ['en' => $area['en'][3], 'ar' => $area['ar'][3]];

        if ($this->total_area > 200 && $this->total_area < 250)
            return ['en' => $area['en'][4], 'ar' => $area['ar'][4]];

        return ['en' => $area['en'][5], 'ar' => $area['ar'][5]];
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function (self $item) {
            $item->meta = [
                "price" => $item->getPriceMeta(),
                "rooms" => $item->getRoomsMeta(),
                "area" => $item->getAreaMeta()
            ];
            unset($item->has_project);
        });
    }


    public function registerMediaCollections()
    {
        $this->addMediaCollection('media');
    }

    public function isExpired()
    {
        if (!$this->deadline) {
            return false;
        }

        return now()->diffInDays($this->deadline, false) < 0;
    }
}
