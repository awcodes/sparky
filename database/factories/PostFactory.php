<?php

namespace Database\Factories;

use App\Enums\Status;
use Awcodes\Curator\Models\Media;
use Database\Factories\Tools\MarkdownFakerProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    use Concerns\HasSeo;
    use Concerns\HasStatus;

    public function definition(): array
    {
        $this->faker->addProvider(new MarkdownFakerProvider($this->faker));

        $title = $this->faker->unique()->sentence(rand(1, 8));

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'status' => Status::Draft,
            'content' => $this->faker->markdown(),
            'featured_image_id' => Media::factory(),
        ];
    }
}
