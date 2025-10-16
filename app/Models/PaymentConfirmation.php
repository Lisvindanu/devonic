<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentConfirmation extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'package_id',
        'amount',
        'transfer_date',
        'transfer_time',
        'bank_account',
        'sender_bank',
        'sender_account_name',
        'proof_image',
        'message',
        'status',
        'verified_by',
        'verified_at',
        'admin_notes',
    ];

    protected $casts = [
        'transfer_date' => 'date',
        'verified_at' => 'datetime',
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
