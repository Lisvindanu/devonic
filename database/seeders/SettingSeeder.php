<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Company Information
            [
                'key' => 'company_name',
                'label' => 'Nama Perusahaan',
                'value' => 'Devonic - Digital Agency for Academic',
                'type' => 'text',
                'group' => 'company',
                'description' => 'Nama resmi perusahaan',
            ],
            [
                'key' => 'company_tagline',
                'label' => 'Tagline',
                'value' => 'Empowering Students, Building Future',
                'type' => 'text',
                'group' => 'company',
                'description' => 'Tagline perusahaan',
            ],
            [
                'key' => 'company_description',
                'label' => 'Deskripsi Perusahaan',
                'value' => 'Devonic adalah digital agency yang fokus membantu mahasiswa dan peneliti dalam mengembangkan solusi teknologi untuk kebutuhan akademis dan penelitian.',
                'type' => 'textarea',
                'group' => 'company',
                'description' => 'Deskripsi singkat perusahaan',
            ],

            // Contact Information
            [
                'key' => 'contact_email',
                'label' => 'Email Kontak',
                'value' => 'hello@devonic.id',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Email utama untuk kontak',
            ],
            [
                'key' => 'contact_phone',
                'label' => 'Nomor Telepon',
                'value' => '+62 812-3456-7890',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Nomor telepon utama',
            ],
            [
                'key' => 'contact_whatsapp',
                'label' => 'WhatsApp',
                'value' => '+62 812-3456-7890',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Nomor WhatsApp untuk konsultasi cepat',
            ],
            [
                'key' => 'contact_address',
                'label' => 'Alamat',
                'value' => 'Jl. Teknologi No. 123, Bandung, Jawa Barat 40123',
                'type' => 'textarea',
                'group' => 'contact',
                'description' => 'Alamat kantor',
            ],

            // Social Media
            [
                'key' => 'social_facebook',
                'label' => 'Facebook URL',
                'value' => 'https://facebook.com/devonic',
                'type' => 'text',
                'group' => 'social',
                'description' => 'Link Facebook page',
            ],
            [
                'key' => 'social_instagram',
                'label' => 'Instagram URL',
                'value' => 'https://instagram.com/devonic.id',
                'type' => 'text',
                'group' => 'social',
                'description' => 'Link Instagram profile',
            ],
            [
                'key' => 'social_twitter',
                'label' => 'Twitter/X URL',
                'value' => 'https://twitter.com/devonic_id',
                'type' => 'text',
                'group' => 'social',
                'description' => 'Link Twitter/X profile',
            ],
            [
                'key' => 'social_linkedin',
                'label' => 'LinkedIn URL',
                'value' => 'https://linkedin.com/company/devonic',
                'type' => 'text',
                'group' => 'social',
                'description' => 'Link LinkedIn company page',
            ],
            [
                'key' => 'social_youtube',
                'label' => 'YouTube URL',
                'value' => 'https://youtube.com/@devonic',
                'type' => 'text',
                'group' => 'social',
                'description' => 'Link YouTube channel',
            ],

            // Payment Information
            [
                'key' => 'payment_bank_name',
                'label' => 'Nama Bank',
                'value' => 'Bank Mandiri',
                'type' => 'text',
                'group' => 'payment',
                'description' => 'Nama bank untuk transfer',
            ],
            [
                'key' => 'payment_account_number',
                'label' => 'Nomor Rekening',
                'value' => '1234567890',
                'type' => 'text',
                'group' => 'payment',
                'description' => 'Nomor rekening bank',
            ],
            [
                'key' => 'payment_account_name',
                'label' => 'Nama Rekening',
                'value' => 'Devonic Digital Agency',
                'type' => 'text',
                'group' => 'payment',
                'description' => 'Nama pemilik rekening',
            ],

            // SEO & Meta
            [
                'key' => 'meta_keywords',
                'label' => 'Meta Keywords',
                'value' => 'digital agency, website development, mobile app, skripsi, thesis, mahasiswa, teknologi',
                'type' => 'textarea',
                'group' => 'seo',
                'description' => 'Keywords untuk SEO',
            ],
            [
                'key' => 'google_analytics_id',
                'label' => 'Google Analytics ID',
                'value' => null,
                'type' => 'text',
                'group' => 'seo',
                'description' => 'Google Analytics tracking ID',
            ],

            // General Settings
            [
                'key' => 'site_maintenance',
                'label' => 'Mode Maintenance',
                'value' => 'false',
                'type' => 'boolean',
                'group' => 'general',
                'description' => 'Aktifkan mode maintenance',
            ],
            [
                'key' => 'items_per_page',
                'label' => 'Items Per Page',
                'value' => '12',
                'type' => 'number',
                'group' => 'general',
                'description' => 'Jumlah item per halaman',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
