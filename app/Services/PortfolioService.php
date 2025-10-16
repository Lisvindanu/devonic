<?php

namespace App\Services;

use App\Models\Portfolio;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PortfolioService
{
    public function getAllPublished(int $perPage = 12): LengthAwarePaginator
    {
        return Portfolio::with(['service', 'images'])
            ->where('is_published', true)
            ->orderBy('order')
            ->orderBy('completed_at', 'desc')
            ->paginate($perPage);
    }

    public function getFeatured(int $limit = 4): Collection
    {
        return Portfolio::with(['service', 'images'])
            ->where('is_published', true)
            ->where('is_featured', true)
            ->orderBy('order')
            ->limit($limit)
            ->get();
    }

    public function getBySlug(string $slug): ?Portfolio
    {
        return Portfolio::with(['service', 'images'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->first();
    }

    public function getByService(int $serviceId, int $perPage = 12): LengthAwarePaginator
    {
        return Portfolio::with(['service', 'images'])
            ->where('is_published', true)
            ->where('service_id', $serviceId)
            ->orderBy('order')
            ->orderBy('completed_at', 'desc')
            ->paginate($perPage);
    }

    public function create(array $data): Portfolio
    {
        return Portfolio::create($data);
    }

    public function update(Portfolio $portfolio, array $data): Portfolio
    {
        $portfolio->update($data);
        return $portfolio->fresh(['service', 'images']);
    }

    public function delete(Portfolio $portfolio): bool
    {
        return $portfolio->delete();
    }
}
