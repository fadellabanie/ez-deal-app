<?php

namespace App\Models;

use App\Services\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entertainment extends Model
{
    use HasFactory, Translatable;

    const TYPE_ENTERTAINMENT_PLACES = 'entertainment-places';
    const TYPE_RSTAURANTS = 'restaurants';
    const TYPE_CAMPS = 'camps';

    protected $fillable = [
        'ar_title', 'en_title', 'address', 'lat', 'lng', 'image',
        'type', 'from', 'to', 'mobile', 'rate',
    ];

    protected $translatedAttributes = [
        'title'
    ];
}
