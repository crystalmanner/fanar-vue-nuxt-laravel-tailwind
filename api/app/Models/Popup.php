<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Popup
 *
 * @property int $id
 * @property string $image
 * @property string $page
 * @property string $link
 * @property int $seconds
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Popup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Popup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Popup query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Popup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Popup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Popup whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Popup whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Popup wherePage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Popup whereSeconds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Popup whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Popup whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Popup extends Model
{
    protected $fillable = ['title', 'image', 'page', 'link', 'seconds', 'status'];

    const STATUS_ACTIVE = 'active';
    const STATUS_NOT_ACTIVE = 'not_active';

    const STATUSES = [
        'Active' => self::STATUS_ACTIVE,
        'Not Active' => self::STATUS_NOT_ACTIVE
    ];

    const PAGES = [
        'Home' => 'home',
        'About Us' => 'about_us',
        'Real Estae List' => 'real_estae_list',
        'Real Estae Details' => 'real_estate_deails',
        'Services' => 'services',
        'Articles' => 'articles',
        'Article Details' => 'article_details',
        'Contact Us' => 'contact_us',
    ];

    protected $attributes = [
        "status" => self::STATUS_ACTIVE
    ];
}
