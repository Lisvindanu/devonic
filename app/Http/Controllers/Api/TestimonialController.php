<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\TestimonialService;
use Illuminate\Http\JsonResponse;

class TestimonialController extends Controller
{
    public function __construct(
        private TestimonialService $testimonialService
    ) {}

    public function index(): JsonResponse
    {
        $testimonials = $this->testimonialService->getAllPublished();
        return ResponseHelper::success($testimonials, 'Testimonials retrieved successfully');
    }

    public function featured(): JsonResponse
    {
        $testimonials = $this->testimonialService->getFeatured();
        return ResponseHelper::success($testimonials, 'Featured testimonials retrieved successfully');
    }
}
