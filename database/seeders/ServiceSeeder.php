<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Website Development',
                'slug' => 'website-development',
                'description' => 'Kami menyediakan layanan pembuatan website profesional yang disesuaikan dengan kebutuhan bisnis atau akademis Anda. Dari landing page sederhana hingga website kompleks dengan sistem manajemen konten.',
                'icon' => 'heroicon-o-code-bracket',
                'is_active' => true,
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'name' => 'Mobile App Development',
                'slug' => 'mobile-app-development',
                'description' => 'Layanan pengembangan aplikasi mobile native dan cross-platform untuk Android dan iOS. Kami membantu mewujudkan ide aplikasi Anda menjadi kenyataan dengan teknologi terkini.',
                'icon' => 'heroicon-o-device-phone-mobile',
                'is_active' => true,
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'name' => 'UI/UX Design',
                'slug' => 'ui-ux-design',
                'description' => 'Desain antarmuka pengguna yang menarik dan pengalaman pengguna yang optimal. Kami fokus pada menciptakan desain yang tidak hanya indah dipandang, tetapi juga mudah digunakan.',
                'icon' => 'heroicon-o-paint-brush',
                'is_active' => true,
                'is_featured' => true,
                'order' => 3,
            ],
            [
                'name' => 'Digital Marketing',
                'slug' => 'digital-marketing',
                'description' => 'Strategi pemasaran digital untuk meningkatkan visibilitas brand Anda. Termasuk SEO, social media marketing, content marketing, dan iklan digital.',
                'icon' => 'heroicon-o-megaphone',
                'is_active' => true,
                'is_featured' => false,
                'order' => 4,
            ],
            [
                'name' => 'Branding & Graphic Design',
                'slug' => 'branding-graphic-design',
                'description' => 'Layanan branding komprehensif dan desain grafis untuk berbagai kebutuhan. Dari logo, company profile, hingga marketing collateral.',
                'icon' => 'heroicon-o-sparkles',
                'is_active' => true,
                'is_featured' => false,
                'order' => 5,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
