<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\ContactInquiryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function __construct(
        private ContactInquiryService $contactInquiryService
    ) {}

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'service_id' => 'nullable|exists:services,id',
            'package_id' => 'nullable|exists:packages,id',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return ResponseHelper::error('Validation failed', 422, $validator->errors());
        }

        $contact = $this->contactInquiryService->create($validator->validated());

        return ResponseHelper::success($contact, 'Contact inquiry submitted successfully', 201);
    }
}
