<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Transport
 *
 * @property int $id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transport query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transport whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transport whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Transport extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $casts = ['name' => 'array'];

}
