<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        $partners = [
            // Clients
            [
                'name' => 'Angelic Holyn Pure',
                'logo' => 'assets/@angelicholynpure-angelicholynpure-profile.jpg',
                'website_url' => 'https://instagram.com/angelicholynpure',
                'type' => 'client',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Abyss Kidwear',
                'logo' => 'assets/abysskidwear.jpg',
                'website_url' => 'https://instagram.com/abysskidwear',
                'type' => 'client',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'ACP',
                'logo' => 'assets/acp.jpg',
                'website_url' => null,
                'type' => 'client',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'AGNEA',
                'logo' => 'assets/AGNEA .png',
                'website_url' => null,
                'type' => 'client',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'name' => 'Beebee',
                'logo' => 'assets/beebee.png',
                'website_url' => null,
                'type' => 'client',
                'is_active' => true,
                'order' => 5,
            ],
            [
                'name' => 'Firelord',
                'logo' => 'assets/firelord.jpg',
                'website_url' => null,
                'type' => 'client',
                'is_active' => true,
                'order' => 6,
            ],
            [
                'name' => 'Info Konser Bareng',
                'logo' => 'assets/infokonserbareng.jpeg',
                'website_url' => 'https://instagram.com/infokonserbareng',
                'type' => 'client',
                'is_active' => true,
                'order' => 7,
            ],
            [
                'name' => 'Jajan Baju Hemat',
                'logo' => 'assets/Jajanbajuhemat - 3.png',
                'website_url' => null,
                'type' => 'client',
                'is_active' => true,
                'order' => 8,
            ],
            [
                'name' => 'Meart',
                'logo' => 'assets/meart.PNG',
                'website_url' => null,
                'type' => 'client',
                'is_active' => true,
                'order' => 9,
            ],
            [
                'name' => 'Syaflora',
                'logo' => 'assets/syaflora.jpg',
                'website_url' => null,
                'type' => 'client',
                'is_active' => true,
                'order' => 10,
            ],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
}
