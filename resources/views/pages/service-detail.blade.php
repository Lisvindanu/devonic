@extends('layouts.app')

@section('title', $service->name)

@section('content')
<!-- Hero Section -->
<section class="py-32 bg-white">
    <div class="container mx-auto px-6 lg:px-8 max-w-4xl">
        <div class="mb-8">
            <a href="{{ route('services') }}" class="text-sm font-medium text-gray-600 hover:text-black transition uppercase">
                ← Kembali ke Layanan
            </a>
        </div>
        <h1 class="text-5xl md:text-7xl font-black tracking-tight mb-6">
            {{ $service->name }}
        </h1>
        <p class="text-xl text-gray-600 leading-relaxed">
            {{ $service->description }}
        </p>
    </div>
</section>

<!-- Content Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6 lg:px-8 max-w-4xl">
        <div class="prose prose-lg max-w-none">
            {!! nl2br(e($service->description)) !!}
        </div>
    </div>
</section>

<!-- Related Services -->
@if($relatedServices->count() > 0)
<section class="py-32 bg-white">
    <div class="container mx-auto px-6 lg:px-8 max-w-6xl">
        <h2 class="text-4xl md:text-5xl font-black tracking-tight mb-12">
            LAYANAN LAINNYA
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($relatedServices as $related)
            <a href="{{ route('service.detail', $related->slug) }}" class="group block">
                <div class="border border-gray-200 p-6 hover:border-black transition duration-300">
                    <h3 class="text-xl font-bold mb-3 group-hover:text-gray-600 transition">
                        {{ $related->name }}
                    </h3>
                    <p class="text-gray-600 text-sm">
                        {{ Str::limit($related->description, 100) }}
                    </p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA -->
<section class="py-32 bg-black text-white">
    <div class="container mx-auto px-6 lg:px-8 max-w-4xl text-center">
        <h2 class="text-4xl md:text-6xl font-black tracking-tight mb-8">
            TERTARIK DENGAN<br>LAYANAN INI?
        </h2>
        <a href="{{ route('contact') }}"
           class="inline-block bg-white text-black px-12 py-5 text-sm font-medium hover:bg-gray-100 transition">
            HUBUNGI KAMI
        </a>
    </div>
</section>
@endsection
