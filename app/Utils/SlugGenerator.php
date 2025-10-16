<?php

namespace App\Utils;

use Illuminate\Support\Str;

class SlugGenerator
{
    public static function generate(string $text, string $model, ?int $ignoreId = null): string
    {
        $slug = Str::slug($text);
        $originalSlug = $slug;
        $count = 1;

        while (static::slugExists($slug, $model, $ignoreId)) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    private static function slugExists(string $slug, string $model, ?int $ignoreId = null): bool
    {
        $query = $model::where('slug', $slug);

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->exists();
    }
}
