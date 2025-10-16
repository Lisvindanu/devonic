@extends('layouts.app')

@section('title', 'Portfolio')

@section('content')
<!-- Hero Section -->
<section class="py-32 bg-white">
    <div class="container mx-auto px-6 lg:px-8 max-w-6xl">
        <h1 class="text-6xl md:text-8xl font-black tracking-tight mb-8">
            PORTFOLIO
        </h1>
        <p class="text-2xl md:text-3xl text-gray-600 max-w-3xl">
            Proyek-proyek yang telah kami kerjakan untuk klien kami
        </p>
    </div>
</section>

<!-- Portfolio Grid -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6 lg:px-8 max-w-7xl">
        @if($portfolios->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($portfolios as $portfolio)
            <a href="{{ route('portfolio.detail', $portfolio->slug) }}" class="group block">
                <div class="bg-white border border-gray-200 overflow-hidden hover:border-black transition duration-300">
                    @if($portfolio->featured_image)
                    <div class="aspect-video bg-gray-100 overflow-hidden">
                        <img src="{{ asset('storage/' . $portfolio->featured_image) }}" 
                             alt="{{ $portfolio->title }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    </div>
                    @endif
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 group-hover:text-gray-600 transition">
                            {{ $portfolio->title }}
                        </h3>
                        <p class="text-sm text-gray-600 mb-3">
                            {{ Str::limit($portfolio->description, 100) }}
                        </p>
                        @if($portfolio->service)
                        <span class="text-xs text-gray-500 uppercase tracking-wider">
                            {{ $portfolio->service->name }}
                        </span>
                        @endif
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-16">
            {{ $portfolios->links() }}
        </div>
        @else
        <div class="text-center py-16">
            <p class="text-xl text-gray-600">Belum ada portfolio yang ditampilkan</p>
        </div>
        @endif
    </div>
</section>
@endsection
