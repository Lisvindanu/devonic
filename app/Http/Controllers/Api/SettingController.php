<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\SettingService;
use Illuminate\Http\JsonResponse;

class SettingController extends Controller
{
    public function __construct(
        private SettingService $settingService
    ) {}

    public function general(): JsonResponse
    {
        $settings = [
            'site_name' => $this->settingService->get('site_name', 'Devonic'),
            'site_tagline' => $this->settingService->get('site_tagline'),
            'site_description' => $this->settingService->get('site_description'),
            'contact_info' => $this->settingService->getContactInfo(),
        ];

        return ResponseHelper::success($settings, 'General settings retrieved successfully');
    }

    public function contact(): JsonResponse
    {
        $contact = $this->settingService->getContactInfo();
        return ResponseHelper::success($contact, 'Contact information retrieved successfully');
    }

    public function bank(): JsonResponse
    {
        $bank = $this->settingService->getBankDetails();
        return ResponseHelper::success($bank, 'Bank details retrieved successfully');
    }

    public function stats(): JsonResponse
    {
        $stats = $this->settingService->getStats();
        return ResponseHelper::success($stats, 'Statistics retrieved successfully');
    }
}
