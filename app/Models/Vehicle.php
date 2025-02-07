<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'fk_owner_model',
        'fk_owner_id',
        'type',
        'uk_vehicle_number',
    ];

    public function owner()
    {
        return $this->morphTo();
    }

    public function accessLogs()
    {
        return $this->hasMany(AccessLog::class, 'fk_vehicle_id');
    }
}
