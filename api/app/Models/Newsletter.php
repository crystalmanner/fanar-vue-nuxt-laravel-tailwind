<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Newsletter
 *
 * @property int $id
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Newsletter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Newsletter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Newsletter query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Newsletter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Newsletter whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Newsletter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Newsletter whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Newsletter extends Model
{
    protected $table = 'newsletter';
    protected $fillable = ['email'];
}