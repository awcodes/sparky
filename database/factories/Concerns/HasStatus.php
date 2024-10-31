<?php

namespace Database\Factories\Concerns;

use App\Enums\Status;

trait HasStatus
{
    public function draft(): static
    {
        return $this->state([
            'status' => Status::Draft,
            'published_at' => null,
        ]);
    }

    public function inReview(): static
    {
        return $this->state([
            'status' => Status::InReview,
            'published_at' => null,
        ]);
    }

    public function scheduled(): static
    {
        return $this->state([
            'status' => Status::Published,
            'published_at' => $this->faker->dateTimeBetween('now', '+1 month'),
        ]);
    }

    public function published(): static
    {
        return $this->state([
            'status' => Status::Published,
            'published_at' => $this->faker->dateTimeBetween('-1 year', '-1 day'),
        ]);
    }
}
