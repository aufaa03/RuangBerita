RuangBerita
RuangBerita adalah sebuah platform blog atau portal berita modern yang dibangun menggunakan Laravel 11. Aplikasi ini dirancang untuk menyajikan konten seputar teknologi, wawasan pengembangan diri, dan dinamika global yang relevan untuk Anda.

## Fitur Utama
Tampilan Publik: Antarmuka yang bersih dan modern bagi pengguna untuk membaca semua berita yang dipublikasikan.

Dashboard Admin: Halaman khusus untuk mengelola seluruh konten website.

Manajemen Post (CRUD): Admin dapat membuat, membaca, memperbarui, dan menghapus post berita dengan mudah.

Manajemen Kategori (CRUD): Kemampuan untuk mengelola kategori berita.

Filter & Pencarian: Fungsionalitas untuk memfilter post berdasarkan kategori dan melakukan pencarian berdasarkan judul.

Sistem Peran (Roles): Pembatasan akses antara peran Admin dan User biasa.

Desain Responsif: Tampilan yang optimal di berbagai perangkat, lengkap dengan mode Terang & Gelap (Light & Dark).

Autentikasi Aman: Sistem registrasi dan login yang aman dibangun di atas Laravel Breeze.

## Teknologi yang Digunakan
Backend: Laravel 11, PHP 8.2+

Frontend: Blade, Tailwind CSS, Alpine.js (via Breeze)

Database: MySQL

Autentikasi: Laravel Breeze

## Instalasi & Konfigurasi
Berikut adalah langkah-langkah untuk menjalankan proyek ini di lingkungan development lokal.

Clone Repository

Bash

git clone https://github.com/NAMA_USER_ANDA/NAMA_REPO_ANDA.git
cd NAMA_REPO_ANDA
Install Dependencies

Bash

composer install
npm install
Setup Environment
Salin file .env.example menjadi .env dan konfigurasikan database Anda.

Bash

cp .env.example .env
Setelah itu, buka file .env dan atur koneksi database Anda (DB_DATABASE, DB_USERNAME, DB_PASSWORD).

Generate Application Key

Bash

php artisan key:generate
Jalankan Migrasi Database
Perintah ini akan membuat semua tabel yang dibutuhkan di database Anda.

Bash

php artisan migrate
Compile Aset Frontend
Jalankan perintah ini dan biarkan tetap berjalan selama development.

Bash

npm run dev
Jalankan Development Server
Buka terminal baru dan jalankan perintah ini.

Bash

php artisan serve
Aplikasi Anda sekarang bisa diakses di http://127.0.0.1:8000.

## Membuat User Admin
Setelah instalasi, Anda perlu membuat akun admin secara manual.

Registrasi Akun Baru: Buka halaman registrasi di aplikasi Anda dan buat akun baru seperti biasa.

Ubah Role di Database: Buka database Anda (menggunakan phpMyAdmin, TablePlus, dll.), cari user yang baru saja Anda buat di tabel users, dan ubah nilai kolom role dari 'user' menjadi 'admin'.

## Akun Demo (Development)
Untuk memudahkan proses testing, Anda bisa menggunakan akun berikut setelah Anda membuatnya dan mengubah role-nya menjadi admin.

Email: admin1@gmail.com

Password: admin123
