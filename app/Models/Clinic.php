<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Clinic extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'address',
        'province_id',
        'regency_id',
        'district_id',
        'village_id',
    ];

    protected $casts = [
        'province_id' => 'string',
        'regency_id' => 'string',
        'district_id' => 'string',
        'village_id' => 'string',
    ];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function regency(): BelongsTo
    {
        return $this->belongsTo(Regency::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function village(): BelongsTo
    {
        return $this->belongsTo(Village::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'clinic_members')->withTimestamps();
    }

    public function medicines(): HasMany
    {
        return $this->hasMany(Medicine::class, 'clinic_id');
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'clinic_id');
    }
}
