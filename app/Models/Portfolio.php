<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Portfolio extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'client_name',
        'service_id',
        'description',
        'challenge',
        'solution',
        'result',
        'project_url',
        'thumbnail',
        'completed_at',
        'is_featured',
        'is_published',
        'order',
    ];

    protected $casts = [
        'completed_at' => 'date',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(PortfolioImage::class);
    }
}
