<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\PortfolioService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function __construct(
        private PortfolioService $portfolioService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->get('per_page', 12);
        $portfolios = $this->portfolioService->getAllPublished($perPage);

        return ResponseHelper::paginated($portfolios, 'Portfolios retrieved successfully');
    }

    public function featured(): JsonResponse
    {
        $portfolios = $this->portfolioService->getFeatured();
        return ResponseHelper::success($portfolios, 'Featured portfolios retrieved successfully');
    }

    public function byService(string $serviceSlug, Request $request): JsonResponse
    {
        $perPage = $request->get('per_page', 12);
        $portfolios = $this->portfolioService->getByService($serviceSlug, $perPage);

        return ResponseHelper::paginated($portfolios, "Portfolios for service '{$serviceSlug}' retrieved successfully");
    }

    public function show(string $slug): JsonResponse
    {
        $portfolio = $this->portfolioService->getBySlug($slug);

        if (!$portfolio) {
            return ResponseHelper::error('Portfolio not found', 404);
        }

        return ResponseHelper::success($portfolio, 'Portfolio retrieved successfully');
    }
}
