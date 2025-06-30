<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    const ROLE_CLIENT = 'client';
    const ROLE_PROFESSIONAL = 'professional';

    public static $roles = [
        self::ROLE_CLIENT,
        self::ROLE_PROFESSIONAL,
    ];

    protected $fillable = [
        'email',
        'password',
        'role',
        'is_premium',
    ];

    protected $hidden = ['password', 'remember_token'];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function appointmentsAsClient()
    {
        return $this->hasMany(Appointment::class, 'client_id');
    }

    public function appointmentsAsProfessional()
    {
        return $this->hasMany(Appointment::class, 'professional_id');
    }
}
