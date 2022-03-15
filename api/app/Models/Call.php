<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    protected $fillable = ['email', 'name', 'message', 'mobile', 'code', 'page', 'apartment_id'];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, "code", "phone_code");
    }
}
