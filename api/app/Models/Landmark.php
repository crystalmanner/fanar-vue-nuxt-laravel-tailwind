<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Landmark
 *
 * @property int $id
 * @property array $name
 * @property int $landmark_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $translations
 * @property-read \App\Models\LandmarkType $landmarkType
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Municipality[] $municipalities
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Landmark newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Landmark newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Landmark query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Landmark whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Landmark whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Landmark whereLandmarkTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Landmark whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Landmark whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Landmark extends Model
{
    use HasTranslations;

    protected $fillable = ['landmark_type_id', 'name'];

    public $translatable = ['name'];

    protected $casts = ['name' => 'array'];

    public function landmarkType()
    {
        return $this->belongsTo(LandmarkType::class);
    }

    public function municipalities()
    {
        return $this->belongsToMany(Municipality::class, "municipality_landmark");
    }
}
