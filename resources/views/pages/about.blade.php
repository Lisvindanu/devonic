@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<!-- Hero Section -->
<section class="py-32 bg-white">
    <div class="container mx-auto px-6 lg:px-8 max-w-6xl">
        <h1 class="text-6xl md:text-8xl font-black tracking-tight mb-8">
            TENTANG KAMI
        </h1>
        <p class="text-2xl md:text-3xl text-gray-600 max-w-3xl leading-relaxed">
            {{ $settings['company_description']->value ?? 'Devonic adalah digital agency yang fokus membantu mahasiswa dan peneliti dalam mengembangkan solusi teknologi untuk kebutuhan akademis dan penelitian.' }}
        </p>
    </div>
</section>

<!-- About Content -->
@if($aboutContents->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6 lg:px-8 max-w-4xl">
        @foreach($aboutContents as $content)
        <div class="mb-16 last:mb-0">
            <h2 class="text-3xl md:text-4xl font-black mb-6">
                {{ $content->title }}
            </h2>
            <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                {!! nl2br(e($content->content)) !!}
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif

<!-- Team Section -->
@if($teamMembers->count() > 0)
<section class="py-32 bg-white">
    <div class="container mx-auto px-6 lg:px-8 max-w-6xl">
        <h2 class="text-5xl md:text-7xl font-black tracking-tight mb-16">
            TIM KAMI
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            @foreach($teamMembers as $member)
            <div>
                @if($member->photo)
                <div class="aspect-square bg-gray-100 mb-6 overflow-hidden">
                    <img src="{{ asset('storage/' . $member->photo) }}" 
                         alt="{{ $member->name }}" 
                         class="w-full h-full object-cover grayscale hover:grayscale-0 transition duration-300">
                </div>
                @endif
                <h3 class="text-2xl font-bold mb-2">
                    {{ $member->name }}
                </h3>
                <p class="text-sm text-gray-600 uppercase tracking-wider mb-3">
                    {{ $member->position }}
                </p>
                @if($member->bio)
                <p class="text-gray-600 text-sm leading-relaxed">
                    {{ $member->bio }}
                </p>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA -->
<section class="py-32 bg-black text-white">
    <div class="container mx-auto px-6 lg:px-8 max-w-4xl text-center">
        <h2 class="text-5xl md:text-7xl font-black tracking-tight mb-8">
            MARI BEKERJA<br>BERSAMA
        </h2>
        <p class="text-xl text-gray-400 mb-12 max-w-2xl mx-auto">
            Kami siap membantu mewujudkan ide digital Anda
        </p>
        <a href="{{ route('contact') }}"
           class="inline-block bg-white text-black px-12 py-5 text-sm font-medium hover:bg-gray-100 transition">
            HUBUNGI KAMI
        </a>
    </div>
</section>
@endsection
