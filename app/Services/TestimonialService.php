<?php

namespace App\Services;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Collection;

class TestimonialService
{
    public function getAllPublished(): Collection
    {
        return Testimonial::where('is_published', true)
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getFeatured(int $limit = 6): Collection
    {
        return Testimonial::where('is_published', true)
            ->where('is_featured', true)
            ->orderBy('order')
            ->limit($limit)
            ->get();
    }

    public function getAll(): Collection
    {
        return Testimonial::orderBy('order')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getById(int $id): ?Testimonial
    {
        return Testimonial::find($id);
    }

    public function create(array $data): Testimonial
    {
        return Testimonial::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $testimonial = Testimonial::find($id);
        if (!$testimonial) {
            return false;
        }

        return $testimonial->update($data);
    }

    public function delete(int $id): bool
    {
        $testimonial = Testimonial::find($id);
        if (!$testimonial) {
            return false;
        }

        return $testimonial->delete();
    }

    public function togglePublished(int $id): bool
    {
        $testimonial = Testimonial::find($id);
        if (!$testimonial) {
            return false;
        }

        $testimonial->is_published = !$testimonial->is_published;
        return $testimonial->save();
    }
}
