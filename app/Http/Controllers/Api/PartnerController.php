<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\PartnerService;
use Illuminate\Http\JsonResponse;

class PartnerController extends Controller
{
    public function __construct(
        private PartnerService $partnerService
    ) {}

    public function index(): JsonResponse
    {
        $partners = $this->partnerService->getAllActive();
        return ResponseHelper::success($partners, 'Partners retrieved successfully');
    }
}
