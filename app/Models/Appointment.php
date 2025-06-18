<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    const STATUS_PENDING = 'pendiente';
    const STATUS_CONFIRMED = 'confirmado';
    const STATUS_CANCELLED = 'cancelado';

    public static $statuses = [
        self::STATUS_PENDING,
        self::STATUS_CONFIRMED,
        self::STATUS_CANCELLED,
    ];

    protected $fillable = [
        'client_id',
        'professional_id',
        'service_id',
        'date',
        'time',
        'location',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function professional()
    {
        return $this->belongsTo(User::class, 'professional_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
