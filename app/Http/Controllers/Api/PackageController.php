<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\PackageService;
use Illuminate\Http\JsonResponse;

class PackageController extends Controller
{
    public function __construct(
        private PackageService $packageService
    ) {}

    public function index(): JsonResponse
    {
        $packages = $this->packageService->getAllActive();
        return ResponseHelper::success($packages, 'Packages retrieved successfully');
    }

    public function category(string $category): JsonResponse
    {
        $packages = $this->packageService->getByCategory($category);
        return ResponseHelper::success($packages, "Packages for {$category} retrieved successfully");
    }

    public function featured(): JsonResponse
    {
        $packages = $this->packageService->getFeatured();
        return ResponseHelper::success($packages, 'Featured packages retrieved successfully');
    }

    public function show(string $slug): JsonResponse
    {
        $package = $this->packageService->getBySlug($slug);

        if (!$package) {
            return ResponseHelper::error('Package not found', 404);
        }

        return ResponseHelper::success($package, 'Package retrieved successfully');
    }
}
