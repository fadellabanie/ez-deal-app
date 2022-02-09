<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id','address',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    } 
    public function scopeMine($query)
    {
        return $query->where('customer_id', Auth::id());
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}

