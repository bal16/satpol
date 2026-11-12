# Website Profil Satpol PP Kota Semarang

<p>
  <img src="https://shieldcn.dev/badge/Live%20Demo-satpol.vercel.app-16a34a.svg?logo=lu:Globe&split=true" alt="Live Demo">
  <img src="https://shieldcn.dev/badge/Status-Portofolio%20Showcase-ea580c.svg?logo=lu:Sparkles&split=true" alt="Status">
  <img src="https://shieldcn.dev/badge/License-MIT-2563eb.svg?logo=opensourceinitiative&split=true" alt="License">
</p>

<p>
  <img src="https://shieldcn.dev/badge/Laravel-12-dc2626.svg?logo=laravel&split=true" alt="Laravel 12">
  <img src="https://shieldcn.dev/badge/PHP-8.4-4f46e5.svg?logo=php&split=true" alt="PHP 8.4">
  <img src="https://shieldcn.dev/badge/Tailwind%20CSS-4-0891b2.svg?logo=tailwindcss&split=true" alt="Tailwind CSS 4">
  <img src="https://shieldcn.dev/badge/Vite-6-7c3aed.svg?logo=vite&split=true" alt="Vite">
</p>

<p>
  <img src="https://shieldcn.dev/badge/PostgreSQL-Neon-3b82f6.svg?logo=postgresql&split=true" alt="PostgreSQL">
  <img src="https://shieldcn.dev/badge/Storage-Neon%20Object%20Storage-0d9488.svg?logo=neon&split=true" alt="Object Storage">
  <img src="https://shieldcn.dev/badge/Hosting-Vercel-3f3f46.svg?logo=vercel&split=true" alt="Vercel">
  <img src="https://shieldcn.dev/badge/Tests-86%20lulus-059669.svg?logo=lu:CircleCheck&split=true" alt="Tests">
</p>

Situs profil dan pusat informasi Satpol PP Kota Semarang: berita kegiatan, profil organisasi, layanan masyarakat, galeri, sampai dokumen informasi publik. Semuanya bisa diperbarui sendiri lewat panel admin, tanpa perlu menyentuh kode.

> **Catatan penting:** proyek ini dibuat untuk keperluan portofolio dan demonstrasi teknis. **Bukan situs resmi instansi pemerintah** dan tidak dipakai untuk pelayanan publik yang sebenarnya.

**Lihat langsung:** <https://satpol.vercel.app>

## Daftar Isi

- [Tentang](#tentang)
- [Fitur](#fitur)
- [Teknologi](#teknologi)
- [Menjalankan di Lokal](#menjalankan-di-lokal)
- [Konfigurasi](#konfigurasi)
- [Deployment](#deployment)
- [Struktur Proyek](#struktur-proyek)
- [Pengujian](#pengujian)
- [Dokumentasi Lain](#dokumentasi-lain)
- [Lisensi](#lisensi)

## Tentang

Ada dua bagian besar di dalam aplikasi ini:

1. **Halaman publik** — yang dilihat pengunjung: beranda, profil, berita, layanan, galeri, dan halaman informasi.
2. **Panel admin** — tempat pengelola memperbarui isi website: menulis berita, mengunggah foto, mengganti gambar beranda, dan memperbarui profil.

Semua konten disimpan di basis data, sedangkan foto dan gambar disimpan di penyimpanan objek (bukan di dalam aplikasi), sehingga website tetap ringan dan aman ketika dijalankan di server yang dibuat ulang setiap kali diperbarui.

## Fitur

### Untuk Pengunjung

- **Beranda** — sorotan kegiatan lewat slider, berita terbaru, dan pintasan menuju layanan.
- **Profil** — visi, sejarah, struktur organisasi, tupoksi, dan kegiatan.
- **Berita** — daftar berita dengan halaman detail, gambar, dan kategori.
- **Layanan** — daftar layanan masyarakat, termasuk panduan pajak daerah (pendaftaran dan tempo pajak).
- **Galeri** — dokumentasi foto kegiatan yang dikelompokkan per kategori.
- **Informasi publik** — halaman PPID, Perda, dan SOP per bidang.

### Untuk Pengelola

- **Dashboard** — ringkasan konten dan aktivitas terbaru.
- **Berita** — tulis, ubah, hapus, lampirkan beberapa gambar, dan atur kategori.
- **Galeri** — unggah foto, kelola kategori, ubah, dan hapus.
- **Slider beranda** — atur gambar untuk setiap slot tampilan.
- **Layanan** — kelola daftar layanan beserta rincian item di dalamnya.
- **Profil & SOP** — perbarui teks, gambar struktur organisasi, dan dokumen SOP.
- **Login aman** — dilindungi captcha matematika sederhana, tanpa bergantung pada layanan captcha pihak ketiga.

## Teknologi

| Bagian | Yang Dipakai |
| --- | --- |
| Kerangka kerja | Laravel 12 (PHP 8.4) |
| Tampilan | Blade, Tailwind CSS 4, Vite |
| Basis data | PostgreSQL (Neon) |
| Penyimpanan gambar | Object storage kompatibel S3 (Neon Object Storage) |
| Hosting | Vercel, dijalankan sebagai container |
| Pengujian | Pest |

## Menjalankan di Lokal

Yang perlu tersedia: **PHP 8.2+**, **Composer**, **Node.js 20+**, dan **basis data** (PostgreSQL, MySQL, atau SQLite).

```bash
git clone https://github.com/bal16/satpol.git
cd satpol

composer install
cp .env.example .env
php artisan key:generate

# Sesuaikan koneksi basis data di .env, lalu:
php artisan migrate --seed

npm install
npm run build      # atau: npm run dev, saat sedang mengembangkan tampilan
php artisan serve
```

Buka <http://localhost:8000>. Panel admin ada di `/admin`.

Kalau memakai penyimpanan lokal untuk gambar (`MEDIA_DISK=public`), jalankan sekali:

```bash
php artisan storage:link
```

Akun admin awal dibuat oleh seeder. Lihat `database/seeders/DatabaseSeeder.php` untuk detailnya, dan **ganti kata sandinya sebelum dipakai di lingkungan nyata**.

## Konfigurasi

Semua pengaturan ada di file `.env`. Beberapa yang paling sering disentuh:

| Variabel | Kegunaan |
| --- | --- |
| `APP_URL` | Alamat website, dipakai saat membuat tautan |
| `DB_*` | Koneksi basis data. Untuk Neon, aktifkan `DB_SSLMODE=require` |
| `MEDIA_DISK` | Tempat menyimpan gambar: `public` (lokal) atau `s3` (object storage) |
| `AWS_*` | Kredensial dan alamat object storage, dipakai bila `MEDIA_DISK=s3` |

Penjelasan lengkap setiap variabel ada sebagai komentar di `.env.example`.

## Deployment

Aplikasi ini disiapkan untuk berjalan di **Vercel** dengan tiga bagian:

- **Aplikasi** — dibungkus sebagai container (FrankenPHP) lewat `Dockerfile`, dikenali Vercel melalui `vercel.json`.
- **Basis data** — PostgreSQL di Neon, terhubung dengan koneksi ber-SSL.
- **Gambar** — Neon Object Storage, dengan alamat publik yang bisa dibuka langsung oleh browser.

Nilai rahasia seperti kata sandi basis data dan kunci storage **tidak disimpan di repository**, melainkan diatur sebagai *environment variables* pada dashboard Vercel.

## Struktur Proyek

| Folder | Isi |
| --- | --- |
| `app/` | Logika aplikasi: controller, service, model, dan repository |
| `resources/views/` | Tampilan halaman (Blade) |
| `routes/` | Daftar alamat halaman publik dan admin |
| `public/` | Titik masuk aplikasi dan aset hasil build |
| `database/` | Migrasi, seeder, dan data contoh |
| `tests/` | Pengujian otomatis |

## Pengujian

```bash
composer run test           # menjalankan seluruh pengujian
./vendor/bin/pint --test    # memeriksa gaya penulisan kode
```

## Dokumentasi Lain

- [`README.laravel.md`](README.laravel.md) — dokumentasi asli dari Laravel.

## Lisensi

Kode proyek ini dirilis di bawah lisensi [MIT](https://opensource.org/licenses/MIT). Dibangun dengan [Laravel](https://laravel.com).
