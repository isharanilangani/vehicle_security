<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    use HasFactory;

    // Define the fillable fields (columns you want to mass-assign)
    protected $fillable = [
        'reason',
        'fk_guest_id',
    ];

    public function guest()
    {
        return $this->belongsTo(Guest::class, 'fk_guest_id');
    }
}
