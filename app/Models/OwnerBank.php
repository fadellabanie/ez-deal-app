<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnerBank extends Model
{
    use HasFactory;
    protected $fillable = [
        'owner_id', 'iban', 'status',
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }
}