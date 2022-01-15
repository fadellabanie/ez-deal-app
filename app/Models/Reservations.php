<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    use HasFactory;
    const Witing_Reserve = 'witting_reserve';
    const Reserve = 'reserve';
    const Finished = 'finished';

    protected $fillable = [
        'realestate_id', 'from', 'to', 'diff_in_days', 'status'
    ];
    public function scopeReserved($query)
    {
        return $query->where('status', self::Reserve);
    }
    public function scopeNotReserved($query)
    {
        return $query->where('status', self::Finished)->where('to', '<', now());
    }
    public function realestate()
    {
        return $this->belongsTo(RealEstate::class);
    }
}
