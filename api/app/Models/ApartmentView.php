<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\ApartmentView
 *
 * @property int $id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentView newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentView newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentView query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentView whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentView whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentView whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentView whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ApartmentView extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $casts = ['name' => 'array'];

}
