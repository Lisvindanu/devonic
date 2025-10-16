<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'category',
        'price_min',
        'price_max',
        'description',
        'features',
        'target_beneficiaries',
        'service_type',
        'is_active',
        'is_featured',
        'order',
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function contactInquiries(): HasMany
    {
        return $this->hasMany(ContactInquiry::class);
    }

    public function paymentConfirmations(): HasMany
    {
        return $this->hasMany(PaymentConfirmation::class);
    }
}
