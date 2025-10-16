<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\PaymentConfirmationService;
use App\Utils\ImageUploader;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentConfirmationController extends Controller
{
    public function __construct(
        private PaymentConfirmationService $paymentConfirmationService
    ) {}

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'package_id' => 'required|exists:packages,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'amount' => 'required|integer|min:0',
            'transfer_date' => 'required|date',
            'transfer_time' => 'nullable|string',
            'sender_bank' => 'required|string|max:255',
            'sender_account_name' => 'required|string|max:255',
            'bank_account' => 'nullable|string|max:255',
            'proof_image' => 'required|image|max:2048', // 2MB max
            'message' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return ResponseHelper::error('Validation failed', 422, $validator->errors());
        }

        $data = $validator->validated();

        // Upload proof image
        if ($request->hasFile('proof_image')) {
            $data['proof_image'] = ImageUploader::upload($request->file('proof_image'), 'payment-proofs');
        }

        $payment = $this->paymentConfirmationService->create($data);

        return ResponseHelper::success($payment, 'Payment confirmation submitted successfully', 201);
    }
}
