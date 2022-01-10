<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'real_estate_id', ];

    public function scopeMine($query)
    {
        return $query->where('customer_id', Auth::guard('customer')->id());
    }

    public function realEstate()
    {
        return $this->belongsTo(RealEstate::class,'real_estate_id');
    }

}
