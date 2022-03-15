<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Facility
 *
 * @property int $id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Facility newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Facility newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Facility query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Facility whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Facility whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Facility whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Facility whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Facility extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $casts = ['name' => 'array'];

}
