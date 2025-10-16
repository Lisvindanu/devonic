<?php

namespace App\Services;

use App\Models\PaymentConfirmation;
use Illuminate\Database\Eloquent\Collection;

class PaymentConfirmationService
{
    public function create(array $data): PaymentConfirmation
    {
        return PaymentConfirmation::create($data);
    }

    public function getAll(): Collection
    {
        return PaymentConfirmation::with('package')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getByStatus(string $status): Collection
    {
        return PaymentConfirmation::with('package')
            ->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getPending(): Collection
    {
        return $this->getByStatus('pending');
    }

    public function verify(int $id, int $verifiedBy, ?string $adminNotes = null): bool
    {
        $payment = PaymentConfirmation::find($id);
        if (!$payment) {
            return false;
        }

        $payment->status = 'verified';
        $payment->verified_by = $verifiedBy;
        $payment->verified_at = now();
        if ($adminNotes) {
            $payment->admin_notes = $adminNotes;
        }

        return $payment->save();
    }

    public function reject(int $id, int $verifiedBy, string $reason): bool
    {
        $payment = PaymentConfirmation::find($id);
        if (!$payment) {
            return false;
        }

        $payment->status = 'rejected';
        $payment->verified_by = $verifiedBy;
        $payment->verified_at = now();
        $payment->admin_notes = $reason;

        return $payment->save();
    }
}
