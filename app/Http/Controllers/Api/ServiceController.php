<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\ServiceService;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    public function __construct(
        private ServiceService $serviceService
    ) {}

    public function index(): JsonResponse
    {
        $services = $this->serviceService->getAllActive();
        return ResponseHelper::success($services, 'Services retrieved successfully');
    }

    public function featured(): JsonResponse
    {
        $services = $this->serviceService->getFeatured();
        return ResponseHelper::success($services, 'Featured services retrieved successfully');
    }

    public function show(string $slug): JsonResponse
    {
        $service = $this->serviceService->getBySlug($slug);

        if (!$service) {
            return ResponseHelper::error('Service not found', 404);
        }

        return ResponseHelper::success($service, 'Service retrieved successfully');
    }
}
