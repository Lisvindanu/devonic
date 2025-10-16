<?php

namespace App\Services;

use App\Models\AboutContent;
use Illuminate\Database\Eloquent\Collection;

class AboutContentService
{
    public function getAllPublished(): Collection
    {
        return AboutContent::where('is_published', true)
            ->orderBy('order')
            ->get();
    }

    public function getBySection(string $section): Collection
    {
        return AboutContent::where('section', $section)
            ->where('is_published', true)
            ->orderBy('order')
            ->get();
    }

    public function getAll(): Collection
    {
        return AboutContent::orderBy('section')
            ->orderBy('order')
            ->get();
    }

    public function getById(int $id): ?AboutContent
    {
        return AboutContent::find($id);
    }

    public function create(array $data): AboutContent
    {
        return AboutContent::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $content = AboutContent::find($id);
        if (!$content) {
            return false;
        }

        return $content->update($data);
    }

    public function delete(int $id): bool
    {
        $content = AboutContent::find($id);
        if (!$content) {
            return false;
        }

        return $content->delete();
    }

    public function reorder(string $section, array $orderData): bool
    {
        foreach ($orderData as $item) {
            AboutContent::where('id', $item['id'])
                ->where('section', $section)
                ->update(['order' => $item['order']]);
        }

        return true;
    }
}
