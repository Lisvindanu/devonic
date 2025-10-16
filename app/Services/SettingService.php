<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class SettingService
{
    private const CACHE_KEY = 'app_settings';
    private const CACHE_TTL = 3600; // 1 hour

    public function get(string $key, $default = null)
    {
        $settings = $this->getAll();
        return $settings[$key] ?? $default;
    }

    public function getAll(): array
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            return Setting::all()
                ->pluck('value', 'key')
                ->toArray();
        });
    }

    public function getByGroup(?string $group = null): Collection
    {
        $query = Setting::query();

        if ($group) {
            $query->where('group', $group);
        }

        return $query->orderBy('group')
            ->orderBy('key')
            ->get();
    }

    public function set(string $key, $value, ?string $type = 'string', ?string $group = null, ?string $label = null): Setting
    {
        $setting = Setting::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type ?? 'string',
                'group' => $group,
                'label' => $label ?? $key,
            ]
        );

        $this->clearCache();

        return $setting;
    }

    public function update(int $id, array $data): bool
    {
        $setting = Setting::find($id);
        if (!$setting) {
            return false;
        }

        $result = $setting->update($data);

        if ($result) {
            $this->clearCache();
        }

        return $result;
    }

    public function delete(string $key): bool
    {
        $setting = Setting::where('key', $key)->first();
        if (!$setting) {
            return false;
        }

        $result = $setting->delete();

        if ($result) {
            $this->clearCache();
        }

        return $result;
    }

    public function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    public function getBankDetails(): array
    {
        return [
            'bank_name' => $this->get('bank_name'),
            'bank_account_number' => $this->get('bank_account_number'),
            'bank_account_name' => $this->get('bank_account_name'),
        ];
    }

    public function getContactInfo(): array
    {
        return [
            'email' => $this->get('contact_email'),
            'phone' => $this->get('contact_phone'),
            'whatsapp' => $this->get('contact_whatsapp'),
            'address' => $this->get('contact_address'),
        ];
    }

    public function getStats(): array
    {
        return [
            'projects_completed' => $this->get('stats_projects_completed', 0),
            'students_helped' => $this->get('stats_students_helped', 0),
            'years_experience' => $this->get('stats_years_experience', 0),
            'scholarships_funded' => $this->get('stats_scholarships_funded', 0),
        ];
    }
}
