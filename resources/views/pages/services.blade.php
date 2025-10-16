@extends('layouts.app')

@section('title', 'Layanan')

@section('content')
<!-- Hero Section -->
<section class="py-32 bg-white">
    <div class="container mx-auto px-6 lg:px-8 max-w-6xl">
        <h1 class="text-6xl md:text-8xl font-black tracking-tight mb-8">
            LAYANAN
        </h1>
        <p class="text-2xl md:text-3xl text-gray-600 max-w-3xl">
            Solusi digital yang dirancang khusus untuk kebutuhan akademis dan penelitian Anda
        </p>
    </div>
</section>

<!-- Services Grid -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6 lg:px-8 max-w-6xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($services as $service)
            <a href="{{ route('service.detail', $service->slug) }}" class="group block">
                <div class="border-2 border-gray-200 p-8 hover:border-black transition duration-300 bg-white">
                    <h3 class="text-3xl font-bold mb-4 group-hover:text-gray-600 transition">
                        {{ $service->name }}
                    </h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        {{ Str::limit($service->description, 200) }}
                    </p>
                    <span class="text-sm font-medium uppercase tracking-wider group-hover:underline">
                        Selengkapnya →
                    </span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-32 bg-black text-white">
    <div class="container mx-auto px-6 lg:px-8 max-w-4xl text-center">
        <h2 class="text-5xl md:text-7xl font-black tracking-tight mb-8">
            BUTUH LAYANAN<br>KHUSUS?
        </h2>
        <p class="text-xl text-gray-400 mb-12 max-w-2xl mx-auto">
            Kami siap membantu Anda dengan solusi custom yang sesuai kebutuhan
        </p>
        <a href="{{ route('contact') }}"
           class="inline-block bg-white text-black px-12 py-5 text-sm font-medium hover:bg-gray-100 transition">
            HUBUNGI KAMI
        </a>
    </div>
</section>
@endsection
