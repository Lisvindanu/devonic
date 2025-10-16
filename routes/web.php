<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Pages
Route::get('/tentang', [PageController::class, 'about'])->name('about');
Route::get('/layanan', [PageController::class, 'services'])->name('services');
Route::get('/layanan/{slug}', [PageController::class, 'serviceDetail'])->name('service.detail');
Route::get('/paket', [PageController::class, 'packages'])->name('packages');
Route::get('/portfolio', [PageController::class, 'portfolio'])->name('portfolio');
Route::get('/portfolio/{slug}', [PageController::class, 'portfolioDetail'])->name('portfolio.detail');
Route::get('/kontak', [PageController::class, 'contact'])->name('contact');
Route::post('/kontak', [PageController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/konfirmasi-pembayaran', [PageController::class, 'paymentConfirmation'])->name('payment.confirmation');
Route::post('/konfirmasi-pembayaran', [PageController::class, 'paymentConfirmationSubmit'])->name('payment.confirmation.submit');
