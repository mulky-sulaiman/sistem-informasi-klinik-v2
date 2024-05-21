<?php

namespace App\Models;

use BinaryCats\Sku\HasSku;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Medicine extends Model
{
    use HasFactory, HasSku;

    protected $fillable = [
        'clinic_id',
        'medicine_category_id',
        'sku',
        'name',
        'description',
        'stock',
        'price',
        'is_in_stock',
    ];

    protected $casts = [
        'stock' => 'integer',
        'price' => 'integer',
        'is_in_stock' => 'boolean',
    ];


    public function category(): BelongsTo
    {
        return $this->belongsTo(MedicineCategory::class, 'medicine_category_id');
    }

    public function clinic(): BelongsTo
    {
        return $this->belongsTo(Clinic::class, 'clinic_id');
    }

    public function prescriptions(): HasMany
    {
        return $this->hasMany(Prescription::class, 'medicine_id');
    }
}
