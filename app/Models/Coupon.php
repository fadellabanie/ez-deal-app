<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;

    const PAGINATE = 25;

    protected $fillable = [
        'owner_id',
        'name',
        'code',
        'discount',
        'from',
        'to',
        'number_of_use',
        'status',
    ];

    public function scopeMine($query)
    {
        return $query->where('owner_id', Auth::guard('owner')->id());
    }
    
    public function realestates()
    {
        return $this->belongsToMany(RealEstate::class, 'coupon_realestate', 'coupon_id', 'realestate_id')
            ->withTimestamps();
    }
}
