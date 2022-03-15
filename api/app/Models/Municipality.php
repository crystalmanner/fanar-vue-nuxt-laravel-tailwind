<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Municipality
 *
 * @property int $id
 * @property array $name
 * @property int|null $city_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\City|null $city
 * @property-read mixed $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Landmark[] $landmarks
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Municipality newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Municipality newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Municipality query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Municipality whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Municipality whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Municipality whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Municipality whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Municipality whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Municipality extends Model
{
    use HasTranslations;

    protected $fillable = ['city_id'];

    public $translatable = ['name'];

    protected $casts = ['name' => 'array'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function landmarks()
    {
        return $this->belongsToMany(Landmark::class, "municipality_landmark");
    }

    public function apartments()
    {
        return $this->hasMany(Apartment::class);
    }
}
