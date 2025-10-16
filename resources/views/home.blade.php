@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<!-- Hero Section -->
<section class="min-h-screen flex items-center justify-center bg-white px-6 lg:px-8">
    <div class="container mx-auto max-w-6xl text-center">
        <div class="mb-12">
            <img src="{{ asset('assets/DEVONIC LOGO ICON (1).png') }}" alt="Devonic Logo" class="w-32 h-32 mx-auto mb-8 object-contain">
        </div>
        <h1 class="text-6xl md:text-8xl lg:text-9xl font-black tracking-tight mb-8 leading-none">
            DEVONIC
        </h1>
        <p class="text-xl md:text-2xl lg:text-3xl text-gray-600 max-w-3xl mx-auto mb-12 leading-relaxed">
            {{ $settings['company_tagline']->value ?? 'Empowering Students, Building Future' }}
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#services" class="inline-block bg-black text-white px-8 py-4 text-sm font-medium hover:bg-gray-800 transition">
                LIHAT LAYANAN
            </a>
            <a href="{{ isset($settings['contact_whatsapp']) ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $settings['contact_whatsapp']->value) : '#contact' }}"
               class="inline-block border-2 border-black text-black px-8 py-4 text-sm font-medium hover:bg-black hover:text-white transition">
                KONSULTASI
            </a>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="py-32 bg-gray-50">
    <div class="container mx-auto px-6 lg:px-8 max-w-6xl">
        <div class="mb-20">
            <h2 class="text-5xl md:text-7xl font-black tracking-tight mb-6">
                LAYANAN
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl">
                Solusi digital yang dirancang khusus untuk kebutuhan akademis dan penelitian
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
            @foreach($services as $service)
            <div class="group border border-gray-200 p-8 hover:border-black transition duration-300">
                <h3 class="text-2xl font-bold mb-4 group-hover:text-gray-600 transition">
                    {{ $service->name }}
                </h3>
                <p class="text-gray-600 leading-relaxed mb-6">
                    {{ Str::limit($service->description, 150) }}
                </p>
                <a href="{{ route('service.detail', $service->slug) }}" class="inline-block border-2 border-black text-black px-6 py-2 text-sm font-medium hover:bg-black hover:text-white transition">
                    LIHAT DETAIL
                </a>
            </div>
            @endforeach
        </div>

        <div class="text-center">
            <a href="{{ route('services') }}" class="inline-block border-2 border-black text-black px-8 py-4 text-sm font-medium hover:bg-black hover:text-white transition">
                LIHAT SEMUA LAYANAN
            </a>
        </div>
    </div>
</section>

<!-- Packages Section -->
<section id="packages" class="py-32 bg-white">
    <div class="container mx-auto px-6 lg:px-8 max-w-6xl">
        <div class="mb-20">
            <h2 class="text-5xl md:text-7xl font-black tracking-tight mb-6">
                PAKET
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl">
                Pilih paket yang sesuai dengan kebutuhan Anda
            </p>
        </div>

        <div class="space-y-6">
            @foreach($packages as $package)
            <div class="group border-2 {{ $package->is_featured ? 'border-black bg-black text-white' : 'border-gray-200 hover:border-black' }} p-8 transition duration-300">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div class="flex-1">
                        <div class="text-xs {{ $package->is_featured ? 'text-gray-400' : 'text-gray-500' }} mb-2 uppercase tracking-wider">
                            {{ $package->category }}
                        </div>
                        <h3 class="text-3xl font-bold mb-3">
                            {{ $package->name }}
                        </h3>
                        <p class="{{ $package->is_featured ? 'text-gray-300' : 'text-gray-600' }}">
                            {{ Str::limit($package->description, 120) }}
                        </p>
                    </div>
                    <div class="text-right">
                        <div class="text-4xl font-black mb-4">
                            @if($package->price > 0)
                                Rp {{ number_format($package->price / 1000000, 0) }}jt
                            @else
                                GRATIS
                            @endif
                        </div>
                        <a href="{{ isset($settings['contact_whatsapp']) ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $settings['contact_whatsapp']->value) . '?text=Halo, saya tertarik dengan paket ' . urlencode($package->name) : '#contact' }}"
                           class="inline-block {{ $package->is_featured ? 'bg-white text-black hover:bg-gray-100' : 'bg-black text-white hover:bg-gray-800' }} px-8 py-3 text-sm font-medium transition">
                            PILIH PAKET
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Partners Section -->
@if($partners->count() > 0)
<section class="py-32 bg-gray-50">
    <div class="container mx-auto px-6 lg:px-8 max-w-6xl">
        <div class="mb-20 text-center">
            <h2 class="text-5xl md:text-7xl font-black tracking-tight mb-6">
                KLIEN
            </h2>
            <p class="text-xl text-gray-600">
                Partner yang telah mempercayai kami
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-12">
            @foreach($partners as $partner)
            <div class="flex items-center justify-center grayscale hover:grayscale-0 transition duration-300 opacity-50 hover:opacity-100">
                @if($partner->logo)
                <img src="{{ asset($partner->logo) }}" alt="{{ $partner->name }}" class="max-h-12 w-auto object-contain">
                @else
                <div class="text-xs font-medium text-gray-400">{{ $partner->name }}</div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Testimonials Section -->
<section id="testimonials" class="py-32 bg-white">
    <div class="container mx-auto px-6 lg:px-8 max-w-6xl">
        <div class="mb-20">
            <h2 class="text-5xl md:text-7xl font-black tracking-tight mb-6">
                TESTIMONI
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl">
                Apa kata mereka yang telah menggunakan layanan kami
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($testimonials as $testimonial)
            <div class="border border-gray-200 p-8 hover:border-black transition duration-300">
                <div class="flex mb-4">
                    @for($i = 1; $i <= $testimonial->rating; $i++)
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    @endfor
                </div>
                <p class="text-gray-700 mb-6 leading-relaxed italic">
                    "{{ $testimonial->content }}"
                </p>
                <div>
                    <p class="font-bold text-black">{{ $testimonial->name }}</p>
                    <p class="text-sm text-gray-600">{{ $testimonial->role }}</p>
                    <p class="text-sm text-gray-500">{{ $testimonial->company }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-32 bg-black text-white">
    <div class="container mx-auto px-6 lg:px-8 max-w-4xl text-center">
        <h2 class="text-5xl md:text-7xl font-black tracking-tight mb-8">
            SIAP MEMULAI<br>PROYEK ANDA?
        </h2>
        <p class="text-xl text-gray-400 mb-12 max-w-2xl mx-auto">
            Konsultasikan kebutuhan digital Anda dengan tim kami. Gratis dan tanpa komitmen.
        </p>
        <a href="{{ isset($settings['contact_whatsapp']) ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $settings['contact_whatsapp']->value) : '#contact' }}"
           class="inline-block bg-white text-black px-12 py-5 text-sm font-medium hover:bg-gray-100 transition">
            HUBUNGI KAMI SEKARANG
        </a>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-32 bg-white">
    <div class="container mx-auto px-6 lg:px-8 max-w-6xl">
        <div class="mb-20">
            <h2 class="text-5xl md:text-7xl font-black tracking-tight mb-6">
                KONTAK
            </h2>
            <p class="text-xl text-gray-600">
                Jangan ragu untuk menghubungi kami
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            @if(isset($settings['contact_email']))
            <div>
                <h3 class="text-xs font-semibold uppercase tracking-wider mb-3 text-gray-500">Email</h3>
                <a href="mailto:{{ $settings['contact_email']->value }}" class="text-xl font-medium hover:text-gray-600 transition">
                    {{ $settings['contact_email']->value }}
                </a>
            </div>
            @endif

            @if(isset($settings['contact_whatsapp']))
            <div>
                <h3 class="text-xs font-semibold uppercase tracking-wider mb-3 text-gray-500">WhatsApp</h3>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['contact_whatsapp']->value) }}" class="text-xl font-medium hover:text-gray-600 transition">
                    {{ $settings['contact_whatsapp']->value }}
                </a>
            </div>
            @endif

            @if(isset($settings['contact_phone']))
            <div>
                <h3 class="text-xs font-semibold uppercase tracking-wider mb-3 text-gray-500">Telepon</h3>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings['contact_phone']->value) }}" class="text-xl font-medium hover:text-gray-600 transition">
                    {{ $settings['contact_phone']->value }}
                </a>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
