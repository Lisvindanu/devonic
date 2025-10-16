@extends('layouts.app')

@section('title', 'Kontak')

@section('content')
<!-- Hero Section -->
<section class="py-32 bg-white">
    <div class="container mx-auto px-6 lg:px-8 max-w-6xl">
        <h1 class="text-6xl md:text-8xl font-black tracking-tight mb-8">
            KONTAK
        </h1>
        <p class="text-2xl md:text-3xl text-gray-600 max-w-3xl">
            Jangan ragu untuk menghubungi kami. Kami siap membantu Anda.
        </p>
    </div>
</section>

<!-- Contact Form -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6 lg:px-8 max-w-4xl">
        @if(session('success'))
        <div class="bg-black text-white p-6 mb-8">
            <p class="font-medium">{{ session('success') }}</p>
        </div>
        @endif

        @if($errors->any())
        <div class="bg-red-50 border-2 border-red-200 p-6 mb-8">
            <ul class="list-disc list-inside text-red-600">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('contact.submit') }}" method="POST" class="bg-white border-2 border-gray-200 p-8 md:p-12">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="name" class="block text-xs font-semibold uppercase tracking-wider mb-2">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                           class="w-full border-2 border-gray-200 px-4 py-3 focus:border-black focus:outline-none transition">
                </div>
                <div>
                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                           class="w-full border-2 border-gray-200 px-4 py-3 focus:border-black focus:outline-none transition">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="phone" class="block text-xs font-semibold uppercase tracking-wider mb-2">Nomor Telepon</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                           class="w-full border-2 border-gray-200 px-4 py-3 focus:border-black focus:outline-none transition">
                </div>
                <div>
                    <label for="subject" class="block text-xs font-semibold uppercase tracking-wider mb-2">Subjek</label>
                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required
                           class="w-full border-2 border-gray-200 px-4 py-3 focus:border-black focus:outline-none transition">
                </div>
            </div>
            <div class="mb-6">
                <label for="message" class="block text-xs font-semibold uppercase tracking-wider mb-2">Pesan</label>
                <textarea id="message" name="message" rows="6" required
                          class="w-full border-2 border-gray-200 px-4 py-3 focus:border-black focus:outline-none transition">{{ old('message') }}</textarea>
            </div>
            <button type="submit"
                    class="w-full bg-black text-white px-8 py-4 text-sm font-medium hover:bg-gray-800 transition">
                KIRIM PESAN
            </button>
        </form>
    </div>
</section>

<!-- Contact Info -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6 lg:px-8 max-w-6xl">
        <h2 class="text-4xl md:text-5xl font-black tracking-tight mb-12">
            HUBUNGI KAMI
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-20">
            @if(isset($settings['contact_email']))
            <div>
                <h3 class="text-xs font-semibold uppercase tracking-wider mb-4 text-gray-500">Email</h3>
                <a href="mailto:{{ $settings['contact_email']->value }}" class="text-2xl font-bold hover:text-gray-600 transition">
                    {{ $settings['contact_email']->value }}
                </a>
            </div>
            @endif

            @if(isset($settings['contact_whatsapp']))
            <div>
                <h3 class="text-xs font-semibold uppercase tracking-wider mb-4 text-gray-500">WhatsApp</h3>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['contact_whatsapp']->value) }}" class="text-2xl font-bold hover:text-gray-600 transition">
                    {{ $settings['contact_whatsapp']->value }}
                </a>
            </div>
            @endif

            @if(isset($settings['contact_phone']))
            <div>
                <h3 class="text-xs font-semibold uppercase tracking-wider mb-4 text-gray-500">Telepon</h3>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings['contact_phone']->value) }}" class="text-2xl font-bold hover:text-gray-600 transition">
                    {{ $settings['contact_phone']->value }}
                </a>
            </div>
            @endif
        </div>

        @if(isset($settings['contact_address']))
        <div class="border-t border-gray-200 pt-12">
            <h3 class="text-xs font-semibold uppercase tracking-wider mb-4 text-gray-500">Alamat</h3>
            <p class="text-lg text-gray-700">
                {{ $settings['contact_address']->value }}
            </p>
        </div>
        @endif
    </div>
</section>

<!-- Social Media -->
<section class="py-32 bg-white">
    <div class="container mx-auto px-6 lg:px-8 max-w-6xl">
        <h2 class="text-4xl md:text-5xl font-black tracking-tight mb-12">
            IKUTI KAMI
        </h2>
        <div class="flex flex-wrap gap-4">
            @if(isset($settings['social_instagram']) && $settings['social_instagram']->value)
            <a href="{{ $settings['social_instagram']->value }}" target="_blank" class="inline-block border-2 border-black px-8 py-4 text-sm font-medium hover:bg-black hover:text-white transition">
                INSTAGRAM
            </a>
            @endif
            @if(isset($settings['social_linkedin']) && $settings['social_linkedin']->value)
            <a href="{{ $settings['social_linkedin']->value }}" target="_blank" class="inline-block border-2 border-black px-8 py-4 text-sm font-medium hover:bg-black hover:text-white transition">
                LINKEDIN
            </a>
            @endif
            @if(isset($settings['social_facebook']) && $settings['social_facebook']->value)
            <a href="{{ $settings['social_facebook']->value }}" target="_blank" class="inline-block border-2 border-black px-8 py-4 text-sm font-medium hover:bg-black hover:text-white transition">
                FACEBOOK
            </a>
            @endif
            @if(isset($settings['social_youtube']) && $settings['social_youtube']->value)
            <a href="{{ $settings['social_youtube']->value }}" target="_blank" class="inline-block border-2 border-black px-8 py-4 text-sm font-medium hover:bg-black hover:text-white transition">
                YOUTUBE
            </a>
            @endif
        </div>
    </div>
</section>
@endsection
