@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<!-- Hero Section -->
<section id="home" class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">
                {{ $settings['company_tagline']->value ?? 'Empowering Students, Building Future' }}
            </h1>
            <p class="text-xl mb-8 text-blue-100">
                {{ $settings['company_description']->value ?? 'Devonic adalah digital agency yang fokus membantu mahasiswa dan peneliti dalam mengembangkan solusi teknologi untuk kebutuhan akademis dan penelitian.' }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#packages" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                    Lihat Paket
                </a>
                <a href="{{ isset($settings['contact_whatsapp']) ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $settings['contact_whatsapp']->value) : '#contact' }}"
                   class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition">
                    Konsultasi Gratis
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Layanan Kami</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Kami menyediakan berbagai layanan digital yang dirancang khusus untuk kebutuhan akademis dan bisnis Anda</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
            <div class="bg-gray-50 rounded-lg p-6 hover:shadow-lg transition">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">{{ $service->name }}</h3>
                <p class="text-gray-600">{{ Str::limit($service->description, 150) }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Packages Section -->
<section id="packages" class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Paket Layanan</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Pilih paket yang sesuai dengan kebutuhan dan budget Anda</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($packages as $package)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition {{ $package->is_featured ? 'ring-2 ring-blue-500' : '' }}">
                @if($package->is_featured)
                <div class="bg-blue-500 text-white text-center py-2 text-sm font-semibold">
                    PALING POPULER
                </div>
                @endif
                <div class="p-6">
                    <div class="text-sm text-gray-500 mb-2">{{ $package->category }}</div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">{{ $package->name }}</h3>
                    <p class="text-gray-600 mb-6">{{ Str::limit($package->description, 100) }}</p>

                    <div class="mb-6">
                        <div class="text-3xl font-bold text-blue-600">
                            @if($package->price > 0)
                                Rp {{ number_format($package->price, 0, ',', '.') }}
                            @else
                                Gratis
                            @endif
                        </div>
                        @if($package->original_price && $package->original_price > $package->price)
                        <div class="text-sm text-gray-500 line-through">
                            Rp {{ number_format($package->original_price, 0, ',', '.') }}
                        </div>
                        @endif
                    </div>

                    <ul class="space-y-3 mb-6">
                        @if(is_array($package->features))
                            @foreach(array_slice($package->features, 0, 5) as $feature)
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-gray-600">{{ $feature }}</span>
                            </li>
                            @endforeach
                        @endif
                    </ul>

                    <a href="{{ isset($settings['contact_whatsapp']) ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $settings['contact_whatsapp']->value) . '?text=Halo, saya tertarik dengan paket ' . urlencode($package->name) : '#contact' }}"
                       class="block w-full text-center bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                        Pilih Paket
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Partners Section -->
@if($partners->count() > 0)
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Dipercaya Oleh</h2>
            <p class="text-gray-600">Partner dan klien yang telah mempercayai kami</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach($partners as $partner)
            <div class="flex items-center justify-center p-4 grayscale hover:grayscale-0 transition">
                @if($partner->logo)
                <img src="{{ asset($partner->logo) }}" alt="{{ $partner->name }}" class="max-h-16 w-auto object-contain">
                @else
                <div class="text-gray-400 text-center">{{ $partner->name }}</div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Testimonials Section -->
<section id="testimonials" class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Testimoni</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Apa kata mereka yang telah menggunakan layanan kami</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($testimonials as $testimonial)
            <div class="bg-white rounded-lg p-6 shadow-md">
                <div class="flex items-center mb-4">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $testimonial->rating)
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        @else
                        <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        @endif
                    @endfor
                </div>
                <p class="text-gray-600 mb-4 italic">"{{ $testimonial->content }}"</p>
                <div class="border-t pt-4">
                    <p class="font-semibold text-gray-800">{{ $testimonial->name }}</p>
                    <p class="text-sm text-gray-500">{{ $testimonial->role }}</p>
                    <p class="text-sm text-gray-500">{{ $testimonial->company }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-blue-600 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">Siap Memulai Proyek Anda?</h2>
        <p class="text-xl mb-8 text-blue-100 max-w-2xl mx-auto">
            Konsultasikan kebutuhan digital Anda dengan tim kami. Gratis dan tanpa komitmen!
        </p>
        <a href="{{ isset($settings['contact_whatsapp']) ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $settings['contact_whatsapp']->value) : '#contact' }}"
           class="inline-block bg-white text-blue-600 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-gray-100 transition">
            Hubungi Kami Sekarang
        </a>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Hubungi Kami</h2>
            <p class="text-gray-600">Jangan ragu untuk menghubungi kami melalui channel berikut</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
            @if(isset($settings['contact_email']))
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Email</h3>
                <a href="mailto:{{ $settings['contact_email']->value }}" class="text-blue-600 hover:underline">
                    {{ $settings['contact_email']->value }}
                </a>
            </div>
            @endif

            @if(isset($settings['contact_whatsapp']))
            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">WhatsApp</h3>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['contact_whatsapp']->value) }}" class="text-blue-600 hover:underline">
                    {{ $settings['contact_whatsapp']->value }}
                </a>
            </div>
            @endif

            @if(isset($settings['contact_phone']))
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Telepon</h3>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings['contact_phone']->value) }}" class="text-blue-600 hover:underline">
                    {{ $settings['contact_phone']->value }}
                </a>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
