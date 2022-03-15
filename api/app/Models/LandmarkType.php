<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\LandmarkType
 *
 * @property int $id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Landmark[] $landmarks
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LandmarkType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LandmarkType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LandmarkType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LandmarkType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LandmarkType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LandmarkType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LandmarkType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class LandmarkType extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $casts = ['name' => 'array'];

    public function landmarks()
    {
        return $this->hasMany(Landmark::class);
    }
}
