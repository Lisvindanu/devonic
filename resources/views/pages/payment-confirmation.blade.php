@extends('layouts.app')

@section('title', 'Konfirmasi Pembayaran')

@section('content')
<!-- Hero Section -->
<section class="py-32 bg-white">
    <div class="container mx-auto px-6 lg:px-8 max-w-6xl">
        <h1 class="text-6xl md:text-8xl font-black tracking-tight mb-8">
            KONFIRMASI<br>PEMBAYARAN
        </h1>
        <p class="text-2xl md:text-3xl text-gray-600 max-w-3xl">
            Kirimkan bukti pembayaran Anda untuk verifikasi
        </p>
    </div>
</section>

<!-- Payment Confirmation Form -->
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

        <form action="{{ route('payment.confirmation.submit') }}" method="POST" enctype="multipart/form-data" class="bg-white border-2 border-gray-200 p-8 md:p-12">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="customer_name" class="block text-xs font-semibold uppercase tracking-wider mb-2">Nama Lengkap</label>
                    <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required
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
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required
                           class="w-full border-2 border-gray-200 px-4 py-3 focus:border-black focus:outline-none transition">
                </div>
                <div>
                    <label for="package_id" class="block text-xs font-semibold uppercase tracking-wider mb-2">Paket (Opsional)</label>
                    <select id="package_id" name="package_id"
                            class="w-full border-2 border-gray-200 px-4 py-3 focus:border-black focus:outline-none transition">
                        <option value="">Pilih Paket</option>
                        @foreach($packages as $package)
                        <option value="{{ $package->id }}" {{ old('package_id') == $package->id ? 'selected' : '' }}>
                            {{ $package->name }} - Rp {{ number_format($package->price, 0, ',', '.') }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="amount" class="block text-xs font-semibold uppercase tracking-wider mb-2">Jumlah Pembayaran (Rp)</label>
                    <input type="number" id="amount" name="amount" value="{{ old('amount') }}" required min="0"
                           class="w-full border-2 border-gray-200 px-4 py-3 focus:border-black focus:outline-none transition">
                </div>
                <div>
                    <label for="payment_method" class="block text-xs font-semibold uppercase tracking-wider mb-2">Metode Pembayaran</label>
                    <select id="payment_method" name="payment_method" required
                            class="w-full border-2 border-gray-200 px-4 py-3 focus:border-black focus:outline-none transition">
                        <option value="">Pilih Metode Pembayaran</option>
                        <option value="Transfer Bank" {{ old('payment_method') == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                        <option value="E-Wallet" {{ old('payment_method') == 'E-Wallet' ? 'selected' : '' }}>E-Wallet (GoPay/OVO/Dana)</option>
                        <option value="Virtual Account" {{ old('payment_method') == 'Virtual Account' ? 'selected' : '' }}>Virtual Account</option>
                        <option value="QRIS" {{ old('payment_method') == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                    </select>
                </div>
            </div>
            <div class="mb-6">
                <label for="payment_proof" class="block text-xs font-semibold uppercase tracking-wider mb-2">Bukti Pembayaran (JPG, PNG - Max 2MB)</label>
                <input type="file" id="payment_proof" name="payment_proof" accept="image/jpeg,image/jpg,image/png" required
                       class="w-full border-2 border-gray-200 px-4 py-3 focus:border-black focus:outline-none transition">
            </div>
            <div class="mb-6">
                <label for="notes" class="block text-xs font-semibold uppercase tracking-wider mb-2">Catatan (Opsional)</label>
                <textarea id="notes" name="notes" rows="4"
                          class="w-full border-2 border-gray-200 px-4 py-3 focus:border-black focus:outline-none transition">{{ old('notes') }}</textarea>
            </div>
            <button type="submit"
                    class="w-full bg-black text-white px-8 py-4 text-sm font-medium hover:bg-gray-800 transition">
                KIRIM KONFIRMASI
            </button>
        </form>
    </div>
</section>

<!-- Payment Info -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6 lg:px-8 max-w-6xl">
        <h2 class="text-4xl md:text-5xl font-black tracking-tight mb-12">
            INFORMASI PEMBAYARAN
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            @if(isset($settings['payment_bank_name']) && $settings['payment_bank_name']->value)
            <div class="border-2 border-gray-200 p-8">
                <h3 class="text-xs font-semibold uppercase tracking-wider mb-4 text-gray-500">Transfer Bank</h3>
                <p class="text-2xl font-bold mb-2">{{ $settings['payment_bank_name']->value ?? '' }}</p>
                <p class="text-xl mb-1">{{ $settings['payment_account_number']->value ?? '' }}</p>
                <p class="text-sm text-gray-600">a.n. {{ $settings['payment_account_name']->value ?? '' }}</p>
            </div>
            @endif
            @if(isset($settings['payment_ewallet']) && $settings['payment_ewallet']->value)
            <div class="border-2 border-gray-200 p-8">
                <h3 class="text-xs font-semibold uppercase tracking-wider mb-4 text-gray-500">E-Wallet</h3>
                <p class="text-2xl font-bold mb-2">{{ $settings['payment_ewallet']->value ?? '' }}</p>
                <p class="text-xl mb-1">{{ $settings['contact_phone']->value ?? '' }}</p>
                <p class="text-sm text-gray-600">a.n. {{ $settings['payment_account_name']->value ?? '' }}</p>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
