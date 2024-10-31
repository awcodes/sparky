<?php

namespace Database\Factories\Concerns;

use Illuminate\Database\Eloquent\Model;

trait HasSeo
{
    public function configure(): self
    {
        return $this->afterCreating(function (Model $model) {
            $model->seo()->updateOrCreate(
                ['model_id' => $model->id],
                [
                    'title' => fake()->sentence(3),
                    'description' => fake()->sentence(10),
                ]
            );
        });
    }
}
