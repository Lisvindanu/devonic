@extends('layouts.app')

@section('title', 'Paket')

@section('content')
<!-- Hero Section -->
<section class="py-32 bg-white">
    <div class="container mx-auto px-6 lg:px-8 max-w-6xl">
        <h1 class="text-6xl md:text-8xl font-black tracking-tight mb-8">
            PAKET
        </h1>
        <p class="text-2xl md:text-3xl text-gray-600 max-w-3xl">
            Pilih paket yang sesuai dengan kebutuhan dan budget Anda
        </p>
    </div>
</section>

<!-- Packages List -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6 lg:px-8 max-w-6xl">
        <div class="space-y-6">
            @foreach($packages as $package)
            <div class="group border-2 {{ $package->is_featured ? 'border-black bg-black text-white' : 'border-gray-200 hover:border-black bg-white' }} p-10 transition duration-300">
                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-8">
                    <div class="flex-1">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="text-xs {{ $package->is_featured ? 'text-gray-400' : 'text-gray-500' }} uppercase tracking-wider">
                                {{ $package->category }}
                            </div>
                            @if($package->is_featured)
                            <span class="bg-white text-black text-xs px-3 py-1 font-bold">POPULER</span>
                            @endif
                        </div>
                        <h3 class="text-4xl font-black mb-4">
                            {{ $package->name }}
                        </h3>
                        <p class="{{ $package->is_featured ? 'text-gray-300' : 'text-gray-600' }} text-lg leading-relaxed mb-6">
                            {{ $package->description }}
                        </p>
                        @if(is_array($package->features) && count($package->features) > 0)
                        <ul class="space-y-2">
                            @foreach($package->features as $feature)
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0 {{ $package->is_featured ? 'text-white' : 'text-black' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm">{{ $feature }}</span>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                    <div class="text-left lg:text-right lg:min-w-[200px]">
                        <div class="text-5xl font-black mb-6">
                            @if($package->price > 0)
                                Rp {{ number_format($package->price / 1000000, 0) }}jt
                            @else
                                GRATIS
                            @endif
                        </div>
                        @if($package->original_price && $package->original_price > $package->price)
                        <div class="text-lg {{ $package->is_featured ? 'text-gray-400' : 'text-gray-500' }} line-through mb-6">
                            Rp {{ number_format($package->original_price / 1000000, 0) }}jt
                        </div>
                        @endif
                        <a href="{{ isset($settings['contact_whatsapp']) ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $settings['contact_whatsapp']->value) . '?text=Halo, saya tertarik dengan paket ' . urlencode($package->name) : route('contact') }}"
                           class="inline-block {{ $package->is_featured ? 'bg-white text-black hover:bg-gray-100' : 'bg-black text-white hover:bg-gray-800' }} px-8 py-4 text-sm font-medium transition w-full lg:w-auto text-center">
                            PILIH PAKET
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
