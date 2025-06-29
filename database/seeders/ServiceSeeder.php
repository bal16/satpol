<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data kustom untuk layanan beserta item-itemnya
        $servicesData = [
            [
                'service' => [
                    'title' => 'Layanan Pengaduan Masyarakat',
                    'image_src' => 'services_images/pengaduan.jpg',
                    'card_id' => 'pengaduan-masyarakat',
                ],
                'items' => [
                    ['text' => 'Formulir Pengaduan Online', 'href' => '/pengaduan/online'],
                    ['text' => 'Lacak Status Pengaduan', 'href' => '/pengaduan/lacak'],
                    ['text' => 'Hotline WhatsApp', 'href' => 'https://wa.me/6281234567890'],
                ]
            ],
            [
                'service' => [
                    'title' => 'Informasi Perizinan',
                    'image_src' => 'services_images/perizinan.jpg',
                    'card_id' => 'informasi-perizinan',
                ],
                'items' => [
                    ['text' => 'Izin Keramaian', 'href' => '/izin/keramaian'],
                    ['text' => 'Izin Reklame', 'href' => '/izin/reklame'],
                    ['text' => 'Regulasi Terkait Perizinan', 'href' => '/regulasi/perizinan'],
                ]
            ],
            [
                'service' => [
                    'title' => 'Edukasi dan Sosialisasi',
                    'image_src' => 'services_images/edukasi.jpg',
                    'card_id' => 'edukasi-sosialisasi',
                ],
                'items' => [
                    ['text' => 'Jadwal Sosialisasi Perda', 'href' => '/edukasi/jadwal'],
                    ['text' => 'Materi Edukasi Publik', 'href' => '/edukasi/materi'],
                ]
            ],
        ];

        // Looping untuk membuat service dan item-itemnya
        foreach ($servicesData as $data) {
            Service::factory()
                ->has(ServiceItem::factory()->count(count($data['items']))->state(new Sequence(...$data['items'])), 'items')
                ->create($data['service']);
        }
    }
}
