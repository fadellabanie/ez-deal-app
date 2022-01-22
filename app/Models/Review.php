<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'real_estate_id',
        'rate',
        'note',
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
