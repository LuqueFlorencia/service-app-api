<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subcategory_id',
        'name',
        'description',
        'price',
    ];

    public function professional()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
