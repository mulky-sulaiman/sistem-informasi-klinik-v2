<?php

namespace App\Models;

use App\Enums\AppointmentStatusEnum;
use App\Enums\PaymentStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'schedule_date',
        'patient_id',
        'clinic_id',
        'doctor_id',
        'height',
        'weight',
        'blood_pressure',
        'symptoms',
        'diagnostic',
        'doctor_fee',
        'discount',
        'amount',
        'status',
    ];

    protected $casts = [
        'schedule_date' => 'datetime',
        'height' => 'integer',
        'weight' => 'integer',
        'status' => AppointmentStatusEnum::class,
    ];

    protected static function boot()
    {
        parent::boot();
        static::updated(function ($appointment) {
            // Transaction Service
            if ($appointment->status == AppointmentStatusEnum::CONFIRMED) {
                $patient = $appointment->patient()->first();
                $doctor = $appointment->doctor()->first();
                // Insert into Transaction Table
                $transaction = Transaction::create([
                    'appointment_id' => $appointment->id,
                    'patient_name' => $patient->name,
                    'patient_phone' => $patient->phone,
                    'patient_age' => $patient->age,
                    'doctor_name' => $doctor->name,
                    'doctor_phone' => $doctor->phone,
                    'appointment_date' => $appointment->schedule_date,
                    'note' => $appointment->symptoms . '\n' . $appointment->diagnostic,
                    'status' => PaymentStatusEnum::UNPAID->value,
                    'paid_at' => null,
                ]);
                $treatments = $appointment->treatments()->get();
                $prescriptions = $appointment->prescriptions()->get();
                foreach ($treatments as $treatment) {
                    // Insert into Bill Table
                    $bill = Bill::create([
                        'transaction_id' => $transaction->id,
                        'item_name' => $treatment->name,
                        'item_description' => $treatment->description,
                        'quantity' => $treatment->quantity,
                        'price' => $treatment->price,
                        'discount' => $treatment->discount,
                        'amount' => $treatment->amount,
                    ]);
                }
                foreach ($prescriptions as $prescription) {
                    // Insert into Bill Table
                    $bill =  Bill::factory()->create([
                        'transaction_id' => $transaction->id,
                        'item_name' => $prescription->medicine()->first()->name,
                        'item_description' => $prescription->description,
                        'quantity' => $prescription->quantity,
                        'price' => $prescription->price,
                        'discount' => $prescription->discount,
                        'amount' => $prescription->amount
                    ]);
                }
            }
        });
    }


    public function clinic(): BelongsTo
    {
        return $this->belongsTo(Clinic::class, 'clinic_id');
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function treatments(): HasMany
    {
        return $this->hasMany(Treatment::class, 'appointment_id');
    }
    public function prescriptions(): HasMany
    {
        return $this->hasMany(Prescription::class, 'appointment_id');
    }
}
