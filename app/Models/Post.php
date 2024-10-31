<?php

namespace App\Models;

use App\Models\Concerns\HasPublishedScope;
use App\Enums\Status;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use RalphJSmit\Laravel\SEO\SchemaCollection;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class Post extends Model
{
    use HasFactory;
    use HasPublishedScope;
    use HasSEO;
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'status' => Status::class,
            'published_at' => 'datetime',
        ];
    }

    public function getPublicUrl(): string
    {
        return config('app.url') . '/posts/' . $this->slug;
    }

    public function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            title: $this->seo->title,
            description: $this->seo->description,
            schema: SchemaCollection::initialize()->addArticle(),
            robots: $this->seo->robots ?? config('seo.robots.default'),
        );
    }

    public function featuredImage(): HasOne
    {
        return $this->hasOne(Media::class, 'id', 'featured_image_id');
    }
}
