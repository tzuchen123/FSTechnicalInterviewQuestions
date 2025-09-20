<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;   
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Post::create([
                'title'   => "測試文章標題 {$i}",
                'image'   => "https://picsum.photos/seed/{$i}/600/400",
                'content' => Str::random(50) . " 測試內容 " . Str::random(50),
                'is_active' => $i % 2,  // 偶數停用, 奇數啟用
                'order_no'  => $i
            ]);
        }
    }
}
