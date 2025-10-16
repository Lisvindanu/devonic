<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactInquiry extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'service_id',
        'package_id',
        'message',
        'status',
        'notes',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}
