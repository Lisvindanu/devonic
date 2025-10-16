<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Package;
use App\Models\Partner;
use App\Models\Testimonial;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'services' => Service::where('is_active', true)
                ->where('is_featured', true)
                ->orderBy('order')
                ->take(4)
                ->get(),
            'packages' => Package::where('is_active', true)
                ->where('is_featured', true)
                ->orderBy('order')
                ->take(6)
                ->get(),
            'partners' => Partner::where('is_active', true)
                ->orderBy('order')
                ->get(),
            'testimonials' => Testimonial::where('is_published', true)
                ->where('is_featured', true)
                ->orderBy('order')
                ->take(6)
                ->get(),
            'settings' => Setting::all()->keyBy('key'),
        ];

        return view('home', $data);
    }
}
