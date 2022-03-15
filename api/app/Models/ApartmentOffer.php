<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\ApartmentOffer
 *
 * @property int $id
 * @property array $description
 * @property int|null $age
 * @property int|null $rooms
 * @property array|null $rooms_categories
 * @property float|null $annual_expenses
 * @property float|null $expected_return_value
 * @property float|null $building_area
 * @property array|null $available_furniture
 * @property int $apartment_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Apartment $apartment
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentOffer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentOffer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentOffer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentOffer whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentOffer whereAnnualExpenses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentOffer whereApartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentOffer whereAvailableFurniture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentOffer whereBuildingArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentOffer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentOffer whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentOffer whereExpectedReturnValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentOffer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentOffer whereRooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentOffer whereRoomsCategories($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApartmentOffer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ApartmentOffer extends Model
{
    use HasTranslations;

    protected $table = "apartment_offer";

    public $translatable = ['rooms_categories', 'available_furniture'];

    protected $casts = ['rooms_categories' => 'array', 'available_furniture' => 'array'];

    protected $fillable = [
        'age', 'rooms', 'rooms_categories',
        'annual_expenses', 'expected_return_value', 'building_area',
        'available_furniture', 'apartment_id'
    ];

    protected $dates = ['end_date'];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}
