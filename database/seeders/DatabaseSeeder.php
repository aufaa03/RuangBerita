<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat satu user utama untuk menjadi penulis semua post
        $user = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        // 2. Buat beberapa kategori
        $teknologi = Category::create(['name' => 'Teknologi', 'slug' => Str::slug('Teknologi')]);
        $gayaHidup = Category::create(['name' => 'Gaya Hidup', 'slug' => Str::slug('Gaya Hidup')]);
        $tutorial = Category::create(['name' => 'Tutorial Pemrograman', 'slug' => Str::slug('Tutorial-Pemrograman')]);
        $berita = Category::create(['name' => 'Berita Terbaru', 'slug' => Str::slug('Berita-Terbaru')]);
        $pemandangan = Category::create([
            'name' => 'Pemandangan Alam',
            'slug' => Str::slug('Pemandangan-Alam'),
        ]);

//         Post::create([
//             'user_id' => $user->id,
//             'category_id' => $teknologi->id,
            
//             'title' => 'Dunia Coding Bekali Talenta Digital dengan Peta Jalan Full Stack Terkini, Integrasikan AI sebagai Kunci',
//             'slug' => Str::slug('Dunia-Coding-Bekali-Talenta'),
//             'body' => 'SEMARANG – Di tengah pesatnya perkembangan teknologi, antusiasme untuk menjadi seorang pengembang perangkat lunak (developer) yang andal terus meningkat. Menjawab kebutuhan tersebut, platform edukasi teknologi "Dunia Coding" kembali menggelar webinar inspiratif yang membahas tuntas "Full Stack Roadmap", Rabu malam (6/8/2025).

// Acara yang diselenggarakan secara daring ini menarik perhatian puluhan talenta digital dari berbagai daerah, yang terlihat dari jumlah peserta yang mencapai lebih dari 90 orang. Dalam sesi yang dipandu oleh praktisi ahli Yunus Febriansyah, para peserta diajak untuk menyelami peta jalan komprehensif untuk menjadi seorang Full Stack Developer yang siap bersaing di industri modern.

// Dari gambar yang dibagikan, Yunus Febriansyah memaparkan lima pilar utama yang harus dikuasai. Roadmap tersebut dimulai dari Front-End (React.js, Next.js, Tailwindcss), berlanjut ke Back-End (PHP, JS, TS), Data Storage (PostgreSQL, MongoDB, MySQL), hingga Deployment (Vercel, AWS, Google Cloud, Docker).

// Namun, yang menjadi sorotan utama dan pembeda dalam roadmap kali ini adalah penekanan pada pilar keempat: AI Services. Dengan menyertakan teknologi seperti Hugging Face, Dunia Coding menegaskan bahwa penguasaan kecerdasan buatan (AI) bukan lagi pilihan, melainkan sebuah keharusan bagi developer masa kini. Integrasi AI dalam pengembangan aplikasi menjadi nilai jual dan kompetensi krusial di era digital.

// "Ini bukan lagi sekadar membangun website atau aplikasi, tetapi bagaimana membuatnya lebih cerdas dan fungsional dengan sentuhan AI," ujar seorang peserta yang mengikuti sesi tersebut.

// Webinar ini tidak hanya memberikan panduan teknis, tetapi juga membuka wawasan tentang bagaimana seluruh komponen teknologi ini saling bersinergi untuk menciptakan produk digital yang solid dan inovatif. Inisiatif seperti yang dilakukan oleh Dunia Coding ini menjadi angin segar bagi ekosistem digital Indonesia, membuktikan komitmennya dalam mencetak developer berkualitas yang siap menjawab tantangan zaman.',
//         ]);
    }
}
