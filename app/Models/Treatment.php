<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = [
        'treatment_category_id',
        'appointment_id',
        'name',
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

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(TreatmentCategory::class, 'treatment_category_id');
    }
}
