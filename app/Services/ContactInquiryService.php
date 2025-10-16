<?php

namespace App\Services;

use App\Models\ContactInquiry;
use Illuminate\Database\Eloquent\Collection;

class ContactInquiryService
{
    public function create(array $data): ContactInquiry
    {
        return ContactInquiry::create($data);
    }

    public function getAll(): Collection
    {
        return ContactInquiry::with(['service', 'package'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getUnread(): Collection
    {
        return ContactInquiry::with(['service', 'package'])
            ->where('is_read', false)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getByStatus(string $status): Collection
    {
        return ContactInquiry::with(['service', 'package'])
            ->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function markAsRead(int $id): bool
    {
        $inquiry = ContactInquiry::find($id);
        if (!$inquiry) {
            return false;
        }

        $inquiry->is_read = true;
        return $inquiry->save();
    }

    public function updateStatus(int $id, string $status, ?string $notes = null): bool
    {
        $inquiry = ContactInquiry::find($id);
        if (!$inquiry) {
            return false;
        }

        $inquiry->status = $status;
        if ($notes) {
            $inquiry->notes = $notes;
        }
        return $inquiry->save();
    }
}
