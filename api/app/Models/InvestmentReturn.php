<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\InvestmentReturn
 *
 * @property int $id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvestmentReturn newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvestmentReturn newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvestmentReturn query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvestmentReturn whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvestmentReturn whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvestmentReturn whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvestmentReturn whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class InvestmentReturn extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $casts = ['name' => 'array'];

}
