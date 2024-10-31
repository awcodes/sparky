<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    //    use WithoutModelEvents;

    public function run(): void
    {
        Menu::factory()->create([
            'name' => 'Main',
            'slug' => 'main',
            'items' => [
                [
                    'label' => 'About',
                    'url' => '/about',
                    'target' => null,
                    'rel' => null,
                    'children' => [],
                ],
                [
                    'label' => 'Blog',
                    'url' => '/blog',
                    'target' => null,
                    'rel' => null,
                    'children' => [],
                ],
                [
                    'label' => 'Contact',
                    'url' => '/contact',
                    'target' => null,
                    'rel' => null,
                    'children' => [],
                ],
            ],
        ]);

        Menu::factory()->create([
            'name' => 'Mobile',
            'slug' => 'mobile',
            'items' => [
                [
                    'label' => 'About',
                    'url' => '/about',
                    'target' => null,
                    'rel' => null,
                    'children' => [],
                ],
                [
                    'label' => 'Blog',
                    'url' => '/blog',
                    'target' => null,
                    'rel' => null,
                    'children' => [],
                ],
                [
                    'label' => 'Contact',
                    'url' => '/contact',
                    'target' => null,
                    'rel' => null,
                    'children' => [],
                ],
            ],
        ]);
    }
}
