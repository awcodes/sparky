<?php

namespace Database\Factories;

use App\Enums\PageLayout;
use App\Enums\Status;
use App\Models\Page;
use Database\Factories\Concerns\HasSeo;
use Database\Factories\Concerns\HasStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PageFactory extends Factory
{
    use HasSeo;
    use HasStatus;
    use WithoutModelEvents;

    public function definition(): array
    {
        $title = $this->faker->unique()->sentence(rand(1, 8));

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'status' => Status::Draft->value,
            'layout' => PageLayout::Default->value,
            'content' => [],
        ];
    }

    public function isChild(): static
    {
        return $this->state([
            'parent' => Page::query()->inRandomOrder()->limit(1)->first()->slug,
        ]);
    }
}
