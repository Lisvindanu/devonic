<?php

namespace App\Services;

use App\Models\TeamMember;
use Illuminate\Database\Eloquent\Collection;

class TeamMemberService
{
    public function getAllActive(): Collection
    {
        return TeamMember::where('is_active', true)
            ->orderBy('order')
            ->get();
    }

    public function getFeatured(int $limit = 4): Collection
    {
        return TeamMember::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('order')
            ->limit($limit)
            ->get();
    }

    public function getByType(string $type): Collection
    {
        return TeamMember::where('is_active', true)
            ->where('type', $type)
            ->orderBy('order')
            ->get();
    }

    public function getAll(): Collection
    {
        return TeamMember::orderBy('order')->get();
    }

    public function getById(int $id): ?TeamMember
    {
        return TeamMember::find($id);
    }

    public function create(array $data): TeamMember
    {
        return TeamMember::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $member = TeamMember::find($id);
        if (!$member) {
            return false;
        }

        return $member->update($data);
    }

    public function delete(int $id): bool
    {
        $member = TeamMember::find($id);
        if (!$member) {
            return false;
        }

        return $member->delete();
    }

    public function reorder(array $orderData): bool
    {
        foreach ($orderData as $item) {
            TeamMember::where('id', $item['id'])
                ->update(['order' => $item['order']]);
        }

        return true;
    }
}
