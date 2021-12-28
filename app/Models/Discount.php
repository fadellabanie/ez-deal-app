<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discount extends Model
{
    use HasFactory;
    const PAGINATE = 25;

    protected $fillable = [
        'owner_id',
        'name',
        'code',
        'weekly_discount',
        'monthly_discount',
        'status',
    ];

    public function scopeMine($query)
    {
        return $query->where('owner_id', Auth::guard('owner')->id());
    }
    
    public function realestates()
    {
        return $this->belongsToMany(RealEstate::class, 'discount_realestate', 'discount_id', 'realestate_id')
            ->withTimestamps();
    }

}
