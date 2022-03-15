<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\ApartmentDeliverable
 *
 * @property int $id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentDeliverable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentDeliverable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentDeliverable query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentDeliverable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentDeliverable whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentDeliverable whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentDeliverable whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ApartmentDeliverable extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $casts = ['name' => 'array'];

}
