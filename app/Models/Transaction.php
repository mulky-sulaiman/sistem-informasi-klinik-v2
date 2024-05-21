<?php

namespace App\Models;

use App\Enums\PaymentStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'patient_name',
        'patient_phone',
        'patient_age',
        'doctor_name',
        'doctor_phone',
        'appointment_date',
        'note',
        'status',
        'paid_at',
    ];

    protected $casts = [
        'status' => PaymentStatusEnum::class,
        'paid_at' => 'datetime',
    ];

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }
}
