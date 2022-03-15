<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\ApartmentType
 *
 * @property int $id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ApartmentType extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $casts = ['name' => 'array'];

}
