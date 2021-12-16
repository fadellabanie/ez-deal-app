<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\Translatable;

class Video extends Model
{
    use HasFactory,Translatable;

    protected $translatedAttributes = [
        'name'
    ];
    protected $fillable = [ 
        'ar_name',
        'en_name',
        'url',
    ];

}
