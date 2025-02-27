<?php

namespace App\Models;

use Filament\Models\Contracts\HasName;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements HasName
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use HasRoles;

    protected $primaryKey = 'pk_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'full_name', 'uk_NIC', 'email', 'name', 'uk_password', 'phone_number', 'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'uk_password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['uk_password'] = Hash::make($value);
    }

    // get full name - Ensure Filament retrieves a valid name
    public function getFilamentName(): string
    {
        return $this->full_name;
    }

    public function getAuthPassword()
    {
        return $this->uk_password;
    }

    public function vehicles()
    {
        return $this->morphOne(Vehicle::class, 'owner', 'fk_owner_model', 'fk_owner_id');
    }

    public function staff()
    {
        return $this->hasOne(Staff::class, 'fk_user_id');
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'fk_user_id');
    }
}
