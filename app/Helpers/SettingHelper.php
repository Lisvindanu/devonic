<?php

namespace App\Helpers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingHelper
{
    private const CACHE_KEY = 'app_settings';
    private const CACHE_TTL = 3600; // 1 hour

    public static function get(string $key, $default = null)
    {
        $settings = static::getAll();
        return $settings[$key] ?? $default;
    }

    public static function getAll(): array
    {
        return Cache::remember(static::CACHE_KEY, static::CACHE_TTL, function () {
            return Setting::all()->pluck('value', 'key')->toArray();
        });
    }

    public static function set(string $key, $value): void
    {
        Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        static::clearCache();
    }

    public static function clearCache(): void
    {
        Cache::forget(static::CACHE_KEY);
    }

    // Specific getters for common settings
    public static function getBankDetails(): array
    {
        return [
            'bank_name' => static::get('bank_name'),
            'bank_account_number' => static::get('bank_account_number'),
            'bank_account_name' => static::get('bank_account_name'),
        ];
    }

    public static function getContactInfo(): array
    {
        return [
            'whatsapp_number' => static::get('whatsapp_number'),
            'whatsapp_number_2' => static::get('whatsapp_number_2'),
            'email_contact' => static::get('email_contact'),
        ];
    }

    public static function getStats(): array
    {
        return [
            'total_students_helped' => (int) static::get('total_students_helped', 0),
            'total_funds_distributed' => (int) static::get('total_funds_distributed', 0),
            'total_projects_completed' => (int) static::get('total_projects_completed', 0),
        ];
    }
}
