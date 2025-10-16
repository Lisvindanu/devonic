@extends('layouts.app')

@section('title', $portfolio->title)

@section('content')
<!-- Hero Section -->
<section class="py-32 bg-white">
    <div class="container mx-auto px-6 lg:px-8 max-w-4xl">
        <div class="mb-8">
            <a href="{{ route('portfolio') }}" class="text-sm font-medium text-gray-600 hover:text-black transition uppercase">
                ← Kembali ke Portfolio
            </a>
        </div>
        <h1 class="text-5xl md:text-7xl font-black tracking-tight mb-6">
            {{ $portfolio->title }}
        </h1>
        @if($portfolio->service)
        <p class="text-sm text-gray-600 uppercase tracking-wider mb-6">
            {{ $portfolio->service->name }}
        </p>
        @endif
        <p class="text-xl text-gray-600 leading-relaxed">
            {{ $portfolio->description }}
        </p>
    </div>
</section>

<!-- Featured Image -->
@if($portfolio->featured_image)
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6 lg:px-8 max-w-6xl">
        <div class="aspect-video bg-gray-100 overflow-hidden">
            <img src="{{ asset('storage/' . $portfolio->featured_image) }}" 
                 alt="{{ $portfolio->title }}" 
                 class="w-full h-full object-cover">
        </div>
    </div>
</section>
@endif

<!-- Gallery -->
@if(is_array($portfolio->images) && count($portfolio->images) > 0)
<section class="py-16 bg-white">
    <div class="container mx-auto px-6 lg:px-8 max-w-6xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($portfolio->images as $image)
            <div class="aspect-video bg-gray-100 overflow-hidden">
                <img src="{{ asset('storage/' . $image) }}" 
                     alt="{{ $portfolio->title }}" 
                     class="w-full h-full object-cover">
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Related Portfolio -->
@if($relatedPortfolios->count() > 0)
<section class="py-32 bg-gray-50">
    <div class="container mx-auto px-6 lg:px-8 max-w-6xl">
        <h2 class="text-4xl md:text-5xl font-black tracking-tight mb-12">
            PROYEK LAINNYA
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($relatedPortfolios as $related)
            <a href="{{ route('portfolio.detail', $related->slug) }}" class="group block">
                @if($related->featured_image)
                <div class="aspect-video bg-gray-100 overflow-hidden mb-4">
                    <img src="{{ asset('storage/' . $related->featured_image) }}" 
                         alt="{{ $related->title }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                </div>
                @endif
                <h3 class="text-xl font-bold group-hover:text-gray-600 transition">
                    {{ $related->title }}
                </h3>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
