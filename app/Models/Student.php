<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Define the fillable fields (columns you want to mass-assign)
    protected $fillable = [
        'university_registration_no',
        'fk_user_id',
    ];

    // Define the relationship with the User model (one-to-one relationship)
    public function user()
    {
        return $this->belongsTo(User::class, 'fk_user_id');
    }
}
