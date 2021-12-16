<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class RealEstate extends Model
{
    public $table = 'realestates';

    use HasFactory;

    const SELL = 1;
    const RENT = 2;
    const INVESTMENT = 3;

    protected $fillable = [
        'owner_id', 'realestate_type_id',
        'city_id', 'country_id',
        'name', 'space',
        'room', 'wc',
        'guests', 'bed',
        'note', 'number_of_views',
        'status', 'lat',
        'lng', 'address',
    ];
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
    public function scopeMine($query)
    {
        return $query->where('owner_id', Auth::id());
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
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'realestate_attributes', 'realestate_id', 'attribute_id')
            ->withPivot('number', 'status')
            ->withTimestamps();
    }
    public function days()
    {
        return $this->belongsToMany(Day::class, 'realestate_price', 'realestate_id', 'day_id')
            ->withPivot('price')
            ->withTimestamps();
    }
}
