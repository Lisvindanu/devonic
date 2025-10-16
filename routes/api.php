<?php

use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\PartnerController;
use App\Http\Controllers\Api\PaymentConfirmationController;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\TestimonialController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Services
Route::prefix('services')->group(function () {
    Route::get('/', [ServiceController::class, 'index']);
    Route::get('/featured', [ServiceController::class, 'featured']);
    Route::get('/{slug}', [ServiceController::class, 'show']);
});

// Packages
Route::prefix('packages')->group(function () {
    Route::get('/', [PackageController::class, 'index']);
    Route::get('/featured', [PackageController::class, 'featured']);
    Route::get('/category/{category}', [PackageController::class, 'category']);
    Route::get('/{slug}', [PackageController::class, 'show']);
});

// Portfolios
Route::prefix('portfolios')->group(function () {
    Route::get('/', [PortfolioController::class, 'index']);
    Route::get('/featured', [PortfolioController::class, 'featured']);
    Route::get('/service/{serviceSlug}', [PortfolioController::class, 'byService']);
    Route::get('/{slug}', [PortfolioController::class, 'show']);
});

// Partners
Route::get('/partners', [PartnerController::class, 'index']);

// Testimonials
Route::prefix('testimonials')->group(function () {
    Route::get('/', [TestimonialController::class, 'index']);
    Route::get('/featured', [TestimonialController::class, 'featured']);
});

// About
Route::prefix('about')->group(function () {
    Route::get('/', [AboutController::class, 'index']);
    Route::get('/team', [AboutController::class, 'team']);
});

// Settings
Route::prefix('settings')->group(function () {
    Route::get('/general', [SettingController::class, 'general']);
    Route::get('/contact', [SettingController::class, 'contact']);
    Route::get('/bank', [SettingController::class, 'bank']);
    Route::get('/stats', [SettingController::class, 'stats']);
});

// Contact Inquiry (POST)
Route::post('/contact', [ContactController::class, 'store']);

// Payment Confirmation (POST)
Route::post('/payment-confirmations', [PaymentConfirmationController::class, 'store']);
