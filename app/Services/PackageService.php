<?php

namespace App\Services;

use App\Models\Package;
use Illuminate\Database\Eloquent\Collection;

class PackageService
{
    public function getAllActive(): Collection
    {
        return Package::where('is_active', true)
            ->orderBy('order')
            ->get();
    }

    public function getByCategory(string $category): Collection
    {
        return Package::where('is_active', true)
            ->where('category', $category)
            ->orderBy('order')
            ->get();
    }

    public function getFeatured(int $limit = 4): Collection
    {
        return Package::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('order')
            ->limit($limit)
            ->get();
    }

    public function getBySlug(string $slug): ?Package
    {
        return Package::where('slug', $slug)
            ->where('is_active', true)
            ->first();
    }

    public function create(array $data): Package
    {
        return Package::create($data);
    }

    public function update(Package $package, array $data): Package
    {
        $package->update($data);
        return $package->fresh();
    }

    public function delete(Package $package): bool
    {
        return $package->delete();
    }
}
