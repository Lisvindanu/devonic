<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            // Student testimonials
            [
                'name' => 'Ahmad Fauzi',
                'role' => 'Mahasiswa S1 Teknik Informatika',
                'company' => 'Universitas Indonesia',
                'content' => 'Devonic sangat membantu saya dalam menyelesaikan tugas akhir. Website yang dibuat profesional dan sesuai dengan kebutuhan penelitian saya. Tim juga sangat responsif dalam menjawab pertanyaan.',
                'avatar' => null,
                'type' => 'student',
                'rating' => 5,
                'is_featured' => true,
                'is_published' => true,
                'order' => 1,
            ],
            [
                'name' => 'Siti Nurhaliza',
                'role' => 'Mahasiswa S2 Sistem Informasi',
                'company' => 'Institut Teknologi Bandung',
                'content' => 'Aplikasi mobile yang dikembangkan sangat membantu penelitian saya tentang IoT. Fitur-fiturnya lengkap dan dokumentasinya jelas. Highly recommended!',
                'avatar' => null,
                'type' => 'student',
                'rating' => 5,
                'is_featured' => true,
                'is_published' => true,
                'order' => 2,
            ],
            [
                'name' => 'Budi Santoso',
                'role' => 'Mahasiswa S3 Ilmu Komputer',
                'company' => 'Universitas Gadjah Mada',
                'content' => 'Platform yang dibangun Devonic sangat membantu dalam implementasi machine learning untuk disertasi saya. Kualitas kode sangat baik dan maintainable.',
                'avatar' => null,
                'type' => 'student',
                'rating' => 5,
                'is_featured' => true,
                'is_published' => true,
                'order' => 3,
            ],

            // Client testimonials
            [
                'name' => 'Rina Wijaya',
                'role' => 'CEO',
                'company' => 'PT. Digital Indonesia',
                'content' => 'Devonic telah membantu kami dalam mengembangkan platform e-commerce yang modern dan scalable. Tim mereka profesional dan deadline-oriented.',
                'avatar' => null,
                'type' => 'client',
                'rating' => 5,
                'is_featured' => true,
                'is_published' => true,
                'order' => 4,
            ],
            [
                'name' => 'Dr. Hendra Kusuma',
                'role' => 'Ketua Program Studi',
                'company' => 'Universitas Teknologi Indonesia',
                'content' => 'Website akademik yang dibuat sangat user-friendly dan memudahkan administrasi kampus. Support yang diberikan juga sangat memuaskan.',
                'avatar' => null,
                'type' => 'client',
                'rating' => 5,
                'is_featured' => true,
                'is_published' => true,
                'order' => 5,
            ],
            [
                'name' => 'Andika Pratama',
                'role' => 'Founder',
                'company' => 'CV. Karya Inovasi',
                'content' => 'Aplikasi inventory yang dikembangkan sangat membantu operasional bisnis kami. Fitur reporting-nya sangat lengkap dan mudah digunakan.',
                'avatar' => null,
                'type' => 'client',
                'rating' => 5,
                'is_featured' => false,
                'is_published' => true,
                'order' => 6,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
