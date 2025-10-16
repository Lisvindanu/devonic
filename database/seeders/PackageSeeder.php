<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            // Paket S1
            [
                'name' => 'Paket S1 - Website Basic',
                'slug' => 'paket-s1-website-basic',
                'icon' => 'heroicon-o-globe-alt',
                'category' => 's1',
                'price_min' => 3000000,
                'price_max' => 5000000,
                'description' => 'Paket pembuatan website untuk mahasiswa S1 dengan fitur dasar yang lengkap untuk kebutuhan skripsi atau tugas akhir.',
                'features' => json_encode([
                    'Landing Page Profesional',
                    'Responsive Design (Mobile & Desktop)',
                    'Maksimal 5 Halaman',
                    'Form Kontak',
                    'Google Maps Integration',
                    'Basic SEO Setup',
                    'SSL Certificate',
                    'Hosting 1 Tahun',
                    'Domain .com/.id 1 Tahun',
                    'Gratis Maintenance 3 Bulan',
                ]),
                'target_beneficiaries' => 1,
                'service_type' => 'Website Development',
                'is_active' => true,
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'name' => 'Paket S1 - Mobile App Basic',
                'slug' => 'paket-s1-mobile-app-basic',
                'icon' => 'heroicon-o-device-phone-mobile',
                'category' => 's1',
                'price_min' => 5000000,
                'price_max' => 8000000,
                'description' => 'Paket pembuatan aplikasi mobile sederhana untuk mahasiswa S1 dengan fitur CRUD dasar.',
                'features' => json_encode([
                    'Platform Android atau iOS (pilih salah satu)',
                    'Fitur CRUD (Create, Read, Update, Delete)',
                    'User Authentication',
                    'Database Integration',
                    'UI/UX Design Modern',
                    'Push Notification',
                    'Dokumentasi Lengkap',
                    'Source Code',
                    'Gratis Revisi 2x',
                ]),
                'target_beneficiaries' => 1,
                'service_type' => 'Mobile App Development',
                'is_active' => true,
                'is_featured' => true,
                'order' => 2,
            ],

            // Paket S2/S3
            [
                'name' => 'Paket S2/S3 - Website Advanced',
                'slug' => 'paket-s2-s3-website-advanced',
                'icon' => 'heroicon-o-server',
                'category' => 's2-s3',
                'price_min' => 8000000,
                'price_max' => 15000000,
                'description' => 'Paket website lengkap dengan fitur advanced untuk mahasiswa S2/S3 termasuk admin panel dan fitur kompleks.',
                'features' => json_encode([
                    'Full Website dengan Admin Panel',
                    'Maksimal 15 Halaman',
                    'User Management System',
                    'Dashboard Analytics',
                    'Database Complex',
                    'API Integration',
                    'Advanced SEO',
                    'Security Features',
                    'Hosting 1 Tahun',
                    'Domain .com/.id 1 Tahun',
                    'Gratis Maintenance 6 Bulan',
                    'Training & Dokumentasi',
                ]),
                'target_beneficiaries' => 1,
                'service_type' => 'Website Development',
                'is_active' => true,
                'is_featured' => true,
                'order' => 3,
            ],
            [
                'name' => 'Paket S2/S3 - Mobile App Advanced',
                'slug' => 'paket-s2-s3-mobile-app-advanced',
                'icon' => 'heroicon-o-cpu-chip',
                'category' => 's2-s3',
                'price_min' => 12000000,
                'price_max' => 20000000,
                'description' => 'Paket aplikasi mobile kompleks untuk penelitian S2/S3 dengan fitur AI/ML atau IoT.',
                'features' => json_encode([
                    'Cross-Platform (Android & iOS)',
                    'Advanced Features (AI/ML/IoT)',
                    'Real-time Database',
                    'Cloud Integration',
                    'User Management',
                    'Admin Dashboard Web',
                    'Advanced Analytics',
                    'Push Notification',
                    'Payment Gateway (optional)',
                    'Dokumentasi Lengkap',
                    'Source Code',
                    'Gratis Maintenance 6 Bulan',
                ]),
                'target_beneficiaries' => 1,
                'service_type' => 'Mobile App Development',
                'is_active' => true,
                'is_featured' => true,
                'order' => 4,
            ],

            // Custom Project
            [
                'name' => 'Custom Project - Enterprise',
                'slug' => 'custom-project-enterprise',
                'icon' => 'heroicon-o-building-office-2',
                'category' => 'custom',
                'price_min' => 25000000,
                'price_max' => 100000000,
                'description' => 'Solusi custom untuk kebutuhan bisnis enterprise dengan fitur dan skala yang disesuaikan.',
                'features' => json_encode([
                    'Custom Development sesuai kebutuhan',
                    'Unlimited Pages/Features',
                    'Microservices Architecture',
                    'Scalable Infrastructure',
                    'Advanced Security',
                    'Multiple Platform Support',
                    'API & Third-party Integration',
                    'CI/CD Pipeline',
                    'Load Balancing & Optimization',
                    'Dedicated Team',
                    'SLA & Support 24/7',
                    'Hosting & Infrastructure 1 Tahun',
                ]),
                'target_beneficiaries' => 5,
                'service_type' => 'Full Stack Development',
                'is_active' => true,
                'is_featured' => true,
                'order' => 5,
            ],

            // Donation
            [
                'name' => 'Program Donasi Website',
                'slug' => 'program-donasi-website',
                'icon' => 'heroicon-o-heart',
                'category' => 'donation',
                'price_min' => 0,
                'price_max' => 0,
                'description' => 'Program website gratis untuk organisasi sosial, yayasan, atau komunitas yang membutuhkan.',
                'features' => json_encode([
                    'Website Profile Organisasi',
                    'Maksimal 5 Halaman',
                    'Responsive Design',
                    'Form Kontak',
                    'Google Maps',
                    'Basic SEO',
                    'Hosting 1 Tahun (shared)',
                    'Subdomain gratis',
                    'Training Pengelolaan',
                    'Support via Email',
                ]),
                'target_beneficiaries' => 10,
                'service_type' => 'Website Development',
                'is_active' => true,
                'is_featured' => false,
                'order' => 6,
            ],
        ];

        foreach ($packages as $package) {
            Package::create($package);
        }
    }
}
