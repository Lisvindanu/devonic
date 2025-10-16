<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Package;
use App\Models\Portfolio;
use App\Models\Setting;
use App\Models\AboutContent;
use App\Models\TeamMember;
use App\Models\ContactInquiry;
use App\Models\PaymentConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function about()
    {
        $data = [
            'aboutContents' => AboutContent::orderBy('order')->get(),
            'teamMembers' => TeamMember::where('is_active', true)->orderBy('order')->get(),
            'settings' => Setting::all()->keyBy('key'),
        ];

        return view('pages.about', $data);
    }

    public function services()
    {
        $data = [
            'services' => Service::where('is_active', true)->orderBy('order')->get(),
            'settings' => Setting::all()->keyBy('key'),
        ];

        return view('pages.services', $data);
    }

    public function serviceDetail($slug)
    {
        $service = Service::where('slug', $slug)->where('is_active', true)->firstOrFail();

        $data = [
            'service' => $service,
            'relatedServices' => Service::where('is_active', true)
                ->where('id', '!=', $service->id)
                ->orderBy('order')
                ->take(3)
                ->get(),
            'settings' => Setting::all()->keyBy('key'),
        ];

        return view('pages.service-detail', $data);
    }

    public function packages()
    {
        $data = [
            'packages' => Package::where('is_active', true)->orderBy('order')->get(),
            'settings' => Setting::all()->keyBy('key'),
        ];

        return view('pages.packages', $data);
    }

    public function portfolio()
    {
        $data = [
            'portfolios' => Portfolio::where('is_published', true)
                ->orderBy('order')
                ->paginate(12),
            'services' => Service::where('is_active', true)->get(),
            'settings' => Setting::all()->keyBy('key'),
        ];

        return view('pages.portfolio', $data);
    }

    public function portfolioDetail($slug)
    {
        $portfolio = Portfolio::where('slug', $slug)->where('is_published', true)->firstOrFail();

        $data = [
            'portfolio' => $portfolio,
            'relatedPortfolios' => Portfolio::where('is_published', true)
                ->where('id', '!=', $portfolio->id)
                ->orderBy('order')
                ->take(3)
                ->get(),
            'settings' => Setting::all()->keyBy('key'),
        ];

        return view('pages.portfolio-detail', $data);
    }

    public function contact()
    {
        $data = [
            'settings' => Setting::all()->keyBy('key'),
        ];

        return view('pages.contact', $data);
    }

    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ], [
            'name.required' => 'Nama lengkap wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'subject.required' => 'Subjek wajib diisi',
            'message.required' => 'Pesan wajib diisi',
        ]);

        ContactInquiry::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'status' => 'new',
        ]);

        return redirect()->route('contact')->with('success', 'Terima kasih! Pesan Anda telah kami terima. Tim kami akan segera menghubungi Anda.');
    }

    public function paymentConfirmation()
    {
        $data = [
            'packages' => Package::where('is_active', true)->orderBy('order')->get(),
            'settings' => Setting::all()->keyBy('key'),
        ];

        return view('pages.payment-confirmation', $data);
    }

    public function paymentConfirmationSubmit(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'package_id' => 'nullable|exists:packages,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:100',
            'payment_proof' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'notes' => 'nullable|string',
        ], [
            'customer_name.required' => 'Nama lengkap wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'phone.required' => 'Nomor telepon wajib diisi',
            'amount.required' => 'Jumlah pembayaran wajib diisi',
            'payment_method.required' => 'Metode pembayaran wajib dipilih',
            'payment_proof.required' => 'Bukti pembayaran wajib diupload',
            'payment_proof.image' => 'Bukti pembayaran harus berupa gambar',
            'payment_proof.mimes' => 'Bukti pembayaran harus berformat jpeg, jpg, atau png',
            'payment_proof.max' => 'Ukuran bukti pembayaran maksimal 2MB',
        ]);

        // Upload payment proof
        $paymentProofPath = $request->file('payment_proof')->store('payment-proofs', 'public');

        PaymentConfirmation::create([
            'customer_name' => $validated['customer_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'package_id' => $validated['package_id'] ?? null,
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'payment_proof' => $paymentProofPath,
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('payment.confirmation')->with('success', 'Terima kasih! Konfirmasi pembayaran Anda telah kami terima. Tim kami akan segera memverifikasi pembayaran Anda.');
    }
}
