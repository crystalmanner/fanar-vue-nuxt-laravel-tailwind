<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Project
 *
 * @property int $id
 * @property array $name
 * @property string $slug
 * @property string $code
 * @property string|null $contact
 * @property string|null $phone
 * @property int|null $municipality_id
 * @property float|null $availability
 * @property \Illuminate\Support\Carbon|null $delivery_date
 * @property bool|null $ready_for_registration
 * @property int|null $buildings
 * @property int|null $apartments
 * @property string|null $construction_company
 * @property float|null $downtown_distance
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Facility[] $facilities
 * @property-read mixed $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Media[] $media
 * @property-read \App\Models\Municipality|null $municipality
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transport[] $transports
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereApartments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereAvailability($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereBuildings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereConstructionCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereDeliveryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereDowntownDistance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereMunicipalityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereReadyForRegistration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $video
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Landmark[] $landmarks
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereVideo($value)
 */
class Project extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    public $fillable = ['slug', 'code', 'contact', 'phone', 'municipality_id',
        'availability', 'delivery_date', 'ready_for_registration', 'buildings', 'apartments',
        'construction_company', 'downtown_distance', 'image', 'video'];

    protected $dates = ['delivery_date'];

    protected $casts = ['ready_for_registration' => 'boolean', 'name' => 'array'];

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, "project_facility");
    }

    public function transports()
    {
        return $this->belongsToMany(Transport::class, "project_transport");
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }


    public function landmarks()
    {
        return $this->belongsToMany(Landmark::class, "project_landmark");
    }

    public function getLandmarksKeyByType()
    {
        return $this->landmarks()->with("landmarkType")->get()->groupBy("landmarkType.name");
    }
}
