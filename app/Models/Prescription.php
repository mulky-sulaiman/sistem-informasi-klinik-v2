<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine_id',
        'appointment_id',
        'description',
        'quantity',
        'price',
        'discount',
        'amount',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'integer',
        'discount' => 'integer',
        'amount' => 'integer',
    ];

    public function medicine(): BelongsTo
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }
}
