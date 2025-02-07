<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'address',
        'uk_NIC',
        'phone_number',
    ];

    public function vehicles()
    {
        return $this->morphOne(Vehicle::class, 'owner', 'fk_owner_model', 'fk_owner_id');
    }

    public function reasons()
    {
        return $this->hasMany(Reason::class, 'fk_guest_id');
    }
}
