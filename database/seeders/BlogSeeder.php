<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 15; $i++) {
            Post::factory()
                ->published()
                ->create();
        }

        for ($i = 1; $i <= 8; $i++) {
            Post::factory()
                ->scheduled()
                ->create();
        }

        for ($i = 1; $i <= 5; $i++) {
            Post::factory()
                ->create();
        }
    }
}
