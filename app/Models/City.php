<?php

namespace App\Models;

use App\Services\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class City extends Model
{  
    use HasFactory,Translatable,LogsActivity;

    protected $translatedAttributes = [
        'name'
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['*']);
    }
    protected $fillable = [
        'country_id',
        'ar_name',
        'en_name',
        'icon',
        'status',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
    
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

}
