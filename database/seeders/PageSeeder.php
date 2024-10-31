<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        Page::factory()
            ->count(4)
            ->published()
            ->sequence(
                ['title' => 'Home', 'slug' => 'home', 'front_page' => true],
                ['title' => 'About', 'slug' => 'about'],
                ['title' => 'Blog', 'slug' => 'blog'],
                ['title' => 'Contact', 'slug' => 'contact'],
            )
            ->create();

        Page::factory(15)
            ->published()
            ->create();

        $withChildren = Page::factory(1)
            ->published()
            ->create();

        Page::factory(3)
            ->published()
            ->isChild()
            ->create([
                'parent' => $withChildren->first()->slug,
            ]);

        Page::factory(3)
            ->inReview()
            ->create();

        Page::factory(5)
            ->scheduled()
            ->create();

        Page::factory(8)
            ->create();
    }
}
