<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'code', 'prefix','first_name', 'last_name', 'email', 'verified_at', 'password', 'country_code', 'mobile', 'gender', 'birthday',
        'avatar', 'status', 'is_dark', 'remember_token', 'device_token', 'block_date', 'suspend'
    ];
    
    public function fullName(): Attribute
    {
        return new Attribute(
            get: fn ($value, $attributes) => $attributes['prefix'] . '.' . $attributes['first_name'] . ' ' . $attributes['last_name'],
            //set: fn($value,$attributes) => $attributes['prefix'].'.'.$attributes['first_name'].' '.$attributes['last_name']
        );
    }
}
