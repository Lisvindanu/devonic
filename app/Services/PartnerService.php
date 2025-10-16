<?php

namespace App\Services;

use App\Models\Partner;
use Illuminate\Database\Eloquent\Collection;

class PartnerService
{
    public function getAllActive(): Collection
    {
        return Partner::where('is_active', true)
            ->orderBy('order')
            ->get();
    }

    public function getAll(): Collection
    {
        return Partner::orderBy('order')->get();
    }

    public function create(array $data): Partner
    {
        return Partner::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $partner = Partner::find($id);
        if (!$partner) {
            return false;
        }

        return $partner->update($data);
    }

    public function delete(int $id): bool
    {
        $partner = Partner::find($id);
        if (!$partner) {
            return false;
        }

        return $partner->delete();
    }

    public function reorder(array $orderData): bool
    {
        foreach ($orderData as $item) {
            Partner::where('id', $item['id'])
                ->update(['order' => $item['order']]);
        }

        return true;
    }
}
