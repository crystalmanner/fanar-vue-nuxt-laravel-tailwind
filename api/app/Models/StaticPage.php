<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
    protected $fillable = [
        'type',
        'name',
        'title',
        'attributes'
    ];

    protected $casts = [
        'attributes' => "array"
    ];
}
