<?php

namespace App\Models;

use App\Services\Translatable;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RealEstate extends Model
{
    public $table = 'realestates';

    use HasFactory, Translatable;

    const STATUS_SHOW = 1;
    const STATUS_HIDEN = 2;

    const GUEST_TYPE_FAMILY = 1;
    const GUEST_TYPE_MENS = 2;


    const PAGINATE = 25;
    const SELL = 1;
    const RENT = 2;
    const INVESTMENT = 3;
    protected $translatedAttributes = [
        'name'
    ];
    protected $fillable = [
        'code',  'owner_id', 'realestate_type_id',
        'city_id', 'country_id', 'price','rate',
        'ar_name', 'en_name', 'guest_count', 'is_sleep', 'wc_count', 'wc_prepared', 'space', 'description',
        'guest_type',  'leave_time', 'enter_time',
        'note', 'number_of_views', 'status', 'lat', 'bed_room',
        'living_room',  'lng', 'address', 'large_bed_count',
        'kitchen_count', 'smail_bed_count', 'kitchen_prepared',
        'image', 'is_reserved', 'is_overnight', 'is_active'
    ];

    public $with = ['city', 'country', 'realestateType', 'medias', 'attributes', 'prices'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    public function scopeNotActive($query)
    {
        return $query->where('is_active', false);
    }
    public function scopeReserved($query)
    {
        return $query->where('is_reserved', true);
    }
    public function scopeNotReserved($query)
    {
        return $query->where('is_reserved', false);
    }
    public function scopeMine($query)
    {
        return $query->where('owner_id', Auth::guard('owner')->id());
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }
    public function realestateType()
    {
        return $this->belongsTo(RealestateType::class, 'realestate_type_id');
    }
    public function medias()
    {
        return $this->hasMany(RealestateMedia::class, 'realestate_id');
    }
    public function reservations()
    {
        return $this->hasMany(Reservations::class, 'realestate_id');
    }
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'realestate_attributes', 'realestate_id', 'attribute_id')
            // ->withPivot('number', 'status')
            ->withTimestamps();
    }
    public function prices()
    {
        return $this->belongsToMany(Day::class, 'realestate_price', 'realestate_id', 'day_id')
            ->withPivot('price')
            ->withTimestamps();
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class, 'coupon_realestate', 'realestate_id', 'coupon_id')
            ->withTimestamps();
    }
}
