<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    use HasFactory;

    // Define the fillable fields (columns you want to mass-assign)
    protected $fillable = [
        'status',
        'time',
        'fk_vehicle_id',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'fk_vehicle_id');
    }
}
