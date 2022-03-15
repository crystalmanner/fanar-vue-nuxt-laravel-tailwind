<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\PaymentType
 *
 * @property int $id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PaymentType extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $casts = ['name' => 'array'];

}
