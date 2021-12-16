<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    const CUSTOMERS = 'customers';
    const OWNERS = 'owners';
    const ADMIN = 'admin';

    protected $fillable = [
        'code', 'role_id','first_name', 'last_name', 'email', 'email_verified_at', 'password', 'country_code', 'mobile', 'gender', 'birthday', 'type',
        'avatar', 'status', 'is_dark', 'remember_token', 'device_token', 'block_date', 'suspend'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getUserAvatarAttribute()
    {
        if ($this->avatar && File::exists($this->avatar)) {
            return asset($this->avatar);
        }
        return asset('default_avatar.png');
    }
}
