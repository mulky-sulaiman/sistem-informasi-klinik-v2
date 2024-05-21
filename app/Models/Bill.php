<?php

namespace App\Models;

use App\Enums\PaymentStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'item_name',
        'item_description',
        'quantity',
        'price',
        'discount',
        'amount',
        'status',
        'paid_at',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'integer',
        'discount' => 'integer',
        'amount' => 'integer',
    ];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}
