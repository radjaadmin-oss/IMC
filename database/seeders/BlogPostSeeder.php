<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil user pertama atau buat dummy admin
        $author = User::first();
        
        if (!$author) {
            $author = User::create([
                'name' => 'Admin Radjatiket',
                'email' => 'admin@radjatiket.com',
                'password' => bcrypt('password'),
            ]);
        }

        $posts = [
            [
                'title' => 'Tips Membeli Tiket Event Secara Online yang Aman',
                'slug' => 'tips-membeli-tiket-event-online-aman',
                'excerpt' => 'Panduan lengkap membeli tiket event online dengan aman dan terhindar dari penipuan.',
                'content' => 'Membeli tiket event online kini semakin mudah. Namun, penting untuk memastikan keamanan transaksi Anda. Selalu gunakan platform resmi dan terpercaya seperti Radjatiket untuk menghindari penipuan.',
                'featured_image' => 'blog/post-1.jpg',
                'author_id' => $author->id,
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'views' => rand(100, 500),
            ],
            [
                'title' => '10 Event Musik Terbaik di Indonesia 2026',
                'slug' => '10-event-musik-terbaik-indonesia-2026',
                'excerpt' => 'Daftar konser dan festival musik yang wajib kamu datangi tahun ini.',
                'content' => 'Tahun 2026 dipenuhi dengan event musik spektakuler di seluruh Indonesia. Dari konser internasional hingga festival lokal, jangan sampai ketinggalan!',
                'featured_image' => 'blog/post-2.jpg',
                'author_id' => $author->id,
                'is_published' => true,
                'published_at' => now()->subDays(3),
                'views' => rand(200, 600),
            ],
            [
                'title' => 'Cara Menjadi Event Organizer Sukses',
                'slug' => 'cara-menjadi-event-organizer-sukses',
                'excerpt' => 'Panduan memulai bisnis event organizer dari nol hingga sukses.',
                'content' => 'Menjadi Event Organizer (EO) membutuhkan perencanaan matang dan eksekusi yang tepat. Mulai dari riset pasar hingga promosi, semua langkah harus dilakukan dengan cermat.',
                'featured_image' => 'blog/post-3.jpg',
                'author_id' => $author->id,
                'is_published' => true,
                'published_at' => now()->subDay(),
                'views' => rand(150, 400),
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::create($post);
        }

        $this->command->info('✓ Blog posts berhasil dibuat');
    }
}
