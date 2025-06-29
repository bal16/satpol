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
                    'title' => 'Layanan',
                    'image_src' => 'services_images/pengaduan.jpg',
                    'card_id' => 'layanan',
                ],
                'items' => [
                    ['text' => 'Ssarana & Prasarana', 'href' => '#'],
                    ['text' => 'Daftar Informasi Publik', 'href' => '#'],
                    ['text' => 'Peraturan', 'href' => '#'],
                ]
            ],
            [
                'service' => [
                    'title' => 'Pemberdayaan',
                    'image_src' => 'services_images/perizinan.jpg',
                    'card_id' => 'pemberdayaan',
                ],
                'items' => [
                    ['text' => 'Bidang Kamtibnas', 'href' => '#'],
                    ['text' => 'Bidang Kesehatan', 'href' => '#'],
                    ['text' => 'Bidang Pariwisata', 'href' => '#'],
                ]
            ],
            [
                'service' => [
                    'title' => 'PPID',
                    'image_src' => 'services_images/edukasi.jpg',
                    'card_id' => 'ppid',
                ],
                'items' => [
                    ['text' => 'Dasar Hukum', 'href' => '#'],
                    ['text' => 'Pelayanan Informasi', 'href' => '#'],
                    ['text' => 'Profil PPID', 'href' => '#'],
                ]
            ],
            [
                'service' => [
                    'title' => 'Kontak',
                    'image_src' => 'services_images/edukasi.jpg',
                    'card_id' => 'kontak',
                ],
                'items' => [
                    ['text' => 'No Telp: 08123456789', 'href' => '#'],
                    ['text' => 'Surel: mail@mail.com', 'href' => '#'],
                    ['text' => 'Facebook: facebook.com/example', 'href' => '#'],
                    ['text' => 'X: x.com/example', 'href' => '#'],
                    ['text' => 'Instagram: instagram.com/example', 'href' => '#'],
                ]
            ],
            [
                'service' => [
                    'title' => 'Perda Kota Semarang',
                    'image_src' => 'services_images/edukasi.jpg',
                    'card_id' => 'perda_kota_semarang',
                ],
                'items' => [
                    ['text' => 'Perda Bangunan Gedung', 'href' => '#'],
                    ['text' => 'Perda Minuman Beralkohol', 'href' => '#'],
                    ['text' => 'Perda Pengelolaan Rumah', 'href' => '#'],
                    ['text' => 'Perda Pengendalian Lingkungan Hidup', 'href' => '#'],
                    ['text' => 'Perda Penyelenggaraan Administrasi Kependudukan', 'href' => '#'],
                    ['text' => 'Perda Pendidik Pegawai Negeri Sipil', 'href' => '#'],
                    ['text' => 'Perda Rencana Tata Ruang Wilayah', 'href' => '#'],
                    ['text' => 'Perda Reklame', 'href' => '#'],
                    ['text' => 'Perda Pengelolaan Pohon Pada Ruang Terbuka Hijau', 'href' => '#'],
                ]
            ],
            [
                'service' => [
                    'title' => 'SOP',
                    'image_src' => 'services_images/edukasi.jpg',
                    'card_id' => 'sop',
                ],
                'items' => [
                    ['text' => 'Bidang PPUD', 'href' => '#'],
                    ['text' => 'Bidang Tibum', 'href' => '#'],
                    ['text' => 'Bidang Linmas', 'href' => '#'],
                    ['text' => 'Bidang Sekretariat', 'href' => '#'],
                    ['text' => 'Bidang Binmas', 'href' => '#'],
                ]
            ],
            [
                'service' => [
                    'title' => 'Pajak Daerah',
                    'image_src' => 'services_images/edukasi.jpg',
                    'card_id' => 'pajak_daerah',
                ],
                'items' => [
                    ['text' => 'Daftar Wajib Pajak', 'href' => '/services/pajak-daftar'],
                    ['text' => 'Jatuh Tempo Pajak', 'href' => '/services/tempo-pajak'],
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
