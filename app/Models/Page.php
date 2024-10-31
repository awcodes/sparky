<?php

namespace App\Models;

use App\Models\Concerns\HasPublishedScope;
use App\Enums\PageLayout;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use RalphJSmit\Laravel\SEO\SchemaCollection;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class Page extends Model
{
    use HasFactory;
    use HasPublishedScope;
    use HasSEO;
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'status' => Status::class,
            'layout' => PageLayout::class,
            'front_page' => 'boolean',
            'published_at' => 'datetime',
            'content' => 'array',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function ($page) {
            if ($page->front_page) {
                $oldFrontPage = Page::where('front_page', true)->first();
                $oldFrontPage?->update([
                    'front_page' => false,
                ]);

                $page->status = Status::Published;
                $page->layout = PageLayout::Default;
            }
        });

        static::updating(function ($page) {
            if ($page->front_page) {
                $oldFrontPage = Page::where('front_page', true)->first();
                if ($oldFrontPage && $oldFrontPage->id !== $page->id) {
                    $oldFrontPage->update([
                        'front_page' => false,
                    ]);
                }

                $page->status = Status::Published;
                $page->layout = PageLayout::Default;
            }
        });
    }

    public function scopeIsFrontPage($query)
    {
        return $query->where('front_page', true)->first();
    }

    public function getPublicUrl(): string
    {
        if ($this->front_page) {
            return config('app.url');
        }

        if ($this->parent) {
            return config('app.url') . '/' . $this->parent . '/' . $this->slug;
        }

        return config('app.url') . '/' . $this->slug;
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
}
