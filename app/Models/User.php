<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'full_name', 'uk_NIC', 'email', 'uk_password', 'phone_number', 'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function vehicles()
    {
        return $this->morphOne(Vehicle::class, 'owner', 'fk_owner_model', 'fk_owner_id');
    }

    public function staff()
    {
        return $this->hasOne(Staff::class, 'fk_user_id');
    }

    public function students()
    {
        return $this->hasOne(Staff::class, 'fk_user_id');
    }
}
