<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'province',
        'department',
        'address',
        'profession',
        'description',
        'avatar',
        'availability',
        'rating',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
