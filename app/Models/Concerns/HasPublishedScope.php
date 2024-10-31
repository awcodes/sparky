<?php

namespace App\Models\Concerns;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasPublishedScope
{
    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where(column: 'status', operator: '=', value: Status::Published)
            ->where('published_at', '<=', now()->toDateTimeString());
    }

    public function isPublished(): Attribute
    {
        return new Attribute(
            get: fn (): bool => $this->status === Status::Published && $this->published_at <= now()->toDateTimeString(),
        );
    }
}
