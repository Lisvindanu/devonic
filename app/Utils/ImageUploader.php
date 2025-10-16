<?php

namespace App\Utils;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploader
{
    public static function upload(UploadedFile $file, string $directory = 'images'): string
    {
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs($directory, $filename, 'public');

        return Storage::url($path);
    }

    public static function delete(string $path): bool
    {
        $relativePath = str_replace('/storage/', '', $path);
        return Storage::disk('public')->delete($relativePath);
    }

    public static function uploadMultiple(array $files, string $directory = 'images'): array
    {
        $paths = [];

        foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                $paths[] = static::upload($file, $directory);
            }
        }

        return $paths;
    }
}
