<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    use HasFactory;

    protected $fillable = [
        'realestate_id', 'from', 'to', 'status'
    ];

    public function realEstate()
    {
        return $this->belongsTo(RealEstate::class);
    }
}
