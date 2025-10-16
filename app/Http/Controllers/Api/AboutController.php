<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\AboutContentService;
use App\Services\TeamMemberService;
use Illuminate\Http\JsonResponse;

class AboutController extends Controller
{
    public function __construct(
        private AboutContentService $aboutContentService,
        private TeamMemberService $teamMemberService
    ) {}

    public function index(): JsonResponse
    {
        $content = $this->aboutContentService->getAllPublished();
        $teamMembers = $this->teamMemberService->getAllActive();

        return ResponseHelper::success([
            'content' => $content,
            'team_members' => $teamMembers,
        ], 'About page content retrieved successfully');
    }

    public function team(): JsonResponse
    {
        $teamMembers = $this->teamMemberService->getAllActive();
        return ResponseHelper::success($teamMembers, 'Team members retrieved successfully');
    }
}
