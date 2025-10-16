<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $settings['company_description']->value ?? 'Devonic - Digital Agency for Academic' }}">
    <meta name="keywords" content="{{ $settings['meta_keywords']->value ?? '' }}">
    <title>{{ $settings['company_name']->value ?? 'Devonic' }} - @yield('title', $settings['company_tagline']->value ?? 'Empowering Students, Building Future')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    @if(isset($settings['google_analytics_id']) && $settings['google_analytics_id']->value)
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $settings['google_analytics_id']->value }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $settings['google_analytics_id']->value }}');
    </script>
    @endif

    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }
    </style>
</head>
<body class="bg-white text-black antialiased">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <nav class="container mx-auto px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div>
                    <a href="/" class="text-2xl font-bold tracking-tight text-black hover:text-gray-700 transition">
                        DEVONIC
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-10">
                    <a href="{{ route('about') }}" class="text-sm font-medium text-gray-600 hover:text-black transition">TENTANG</a>
                    <a href="{{ route('services') }}" class="text-sm font-medium text-gray-600 hover:text-black transition">LAYANAN</a>
                    <a href="{{ route('packages') }}" class="text-sm font-medium text-gray-600 hover:text-black transition">PAKET</a>
                    <a href="{{ route('portfolio') }}" class="text-sm font-medium text-gray-600 hover:text-black transition">PORTFOLIO</a>
                    <a href="{{ route('contact') }}" class="text-sm font-medium text-gray-600 hover:text-black transition">KONTAK</a>
                    <a href="{{ route('payment.confirmation') }}" class="text-sm font-medium text-gray-600 hover:text-black transition">KONFIRMASI</a>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="{{ isset($settings['contact_whatsapp']) ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $settings['contact_whatsapp']->value) : '#contact' }}"
                       class="hidden md:inline-block bg-black text-white px-6 py-3 text-sm font-medium hover:bg-gray-800 transition">
                        KONSULTASI
                    </a>
                    <button id="mobile-menu-button" class="md:hidden text-black">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden border-t border-gray-200">
                <div class="py-4 space-y-3">
                    <a href="{{ route('about') }}" class="block text-sm font-medium text-gray-600 hover:text-black transition py-2">TENTANG</a>
                    <a href="{{ route('services') }}" class="block text-sm font-medium text-gray-600 hover:text-black transition py-2">LAYANAN</a>
                    <a href="{{ route('packages') }}" class="block text-sm font-medium text-gray-600 hover:text-black transition py-2">PAKET</a>
                    <a href="{{ route('portfolio') }}" class="block text-sm font-medium text-gray-600 hover:text-black transition py-2">PORTFOLIO</a>
                    <a href="{{ route('contact') }}" class="block text-sm font-medium text-gray-600 hover:text-black transition py-2">KONTAK</a>
                    <a href="{{ route('payment.confirmation') }}" class="block text-sm font-medium text-gray-600 hover:text-black transition py-2">KONFIRMASI</a>
                    <a href="{{ isset($settings['contact_whatsapp']) ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $settings['contact_whatsapp']->value) : route('contact') }}"
                       class="block bg-black text-white px-6 py-3 text-sm font-medium text-center hover:bg-gray-800 transition mt-4">
                        KONSULTASI
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-black text-white py-16">
        <div class="container mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
                <!-- Company Info -->
                <div>
                    <h3 class="text-2xl font-bold mb-4">DEVONIC</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        {{ $settings['company_tagline']->value ?? 'Empowering Students, Building Future' }}
                    </p>
                </div>

                <!-- Links -->
                <div>
                    <h4 class="text-sm font-semibold mb-4 uppercase tracking-wider">Navigasi</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white transition text-sm">Tentang</a></li>
                        <li><a href="{{ route('services') }}" class="text-gray-400 hover:text-white transition text-sm">Layanan</a></li>
                        <li><a href="{{ route('packages') }}" class="text-gray-400 hover:text-white transition text-sm">Paket</a></li>
                        <li><a href="{{ route('portfolio') }}" class="text-gray-400 hover:text-white transition text-sm">Portfolio</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-white transition text-sm">Kontak</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-sm font-semibold mb-4 uppercase tracking-wider">Kontak</h4>
                    <ul class="space-y-3 text-gray-400 text-sm">
                        @if(isset($settings['contact_email']))
                        <li>
                            <a href="mailto:{{ $settings['contact_email']->value }}" class="hover:text-white transition">
                                {{ $settings['contact_email']->value }}
                            </a>
                        </li>
                        @endif
                        @if(isset($settings['contact_phone']))
                        <li>{{ $settings['contact_phone']->value }}</li>
                        @endif
                    </ul>
                    <div class="flex space-x-4 mt-6">
                        @if(isset($settings['social_instagram']) && $settings['social_instagram']->value)
                        <a href="{{ $settings['social_instagram']->value }}" class="text-gray-400 hover:text-white transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        @endif
                        @if(isset($settings['social_linkedin']) && $settings['social_linkedin']->value)
                        <a href="{{ $settings['social_linkedin']->value }}" class="text-gray-400 hover:text-white transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-500 text-xs">&copy; {{ date('Y') }} DEVONIC. All rights reserved.</p>
                <p class="text-gray-500 text-xs mt-2 md:mt-0">Digital Agency for Academic</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    // Close mobile menu if open
                    document.getElementById('mobile-menu')?.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>
