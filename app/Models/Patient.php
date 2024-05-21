<?php

namespace App\Models;

use App\Enums\BloodTypeEnum;
use App\Enums\GenderEnum;
use App\Enums\MaritalStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'name',
        'birth_date',
        'gender',
        'marital_status',
        'blood_type',
        'bio',
        'address',
        'province_id',
        'regency_id',
        'district_id',
        'village_id',
    ];

    protected $casts = [
        'birth_date' => 'datetime',
        'gender' => GenderEnum::class,
        'marital_status' => MaritalStatusEnum::class,
        'blood_type' => BloodTypeEnum::class,
        'province_id' => 'string',
        'regency_id' => 'string',
        'district_id' => 'string',
        'village_id' => 'string',
    ];

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }
}
