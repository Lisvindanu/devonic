<?php

namespace App\Services;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;

class ServiceService
{
    public function getAllActive(): Collection
    {
        return Service::where('is_active', true)
            ->orderBy('order')
            ->get();
    }

    public function getFeatured(int $limit = 3): Collection
    {
        return Service::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('order')
            ->limit($limit)
            ->get();
    }

    public function getBySlug(string $slug): ?Service
    {
        return Service::where('slug', $slug)
            ->where('is_active', true)
            ->first();
    }

    public function create(array $data): Service
    {
        return Service::create($data);
    }

    public function update(Service $service, array $data): Service
    {
        $service->update($data);
        return $service->fresh();
    }

    public function delete(Service $service): bool
    {
        return $service->delete();
    }
}
