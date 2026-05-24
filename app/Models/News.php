<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'summary',
        'content',
        'author',
        'email',
        'image',
        'priority',
        'is_draft',
        'is_published',
        'terms_accepted',
        'user_id',
        'source',
        'source_url',
        'published_at',
    ];

    protected $casts = [
        'is_draft' => 'boolean',
        'is_published' => 'boolean',
        'terms_accepted' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->title) . '-' . uniqid();
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'news_tag');
    }

    public function scopePublished($query)
    {
        return $query->where('is_draft', false)->where('is_published', true);
    }

    public function scopeDraft($query)
    {
        return $query->where('is_draft', true);
    }

    public function scopeByCategory($query, $categorySlug)
    {
        return $query->whereHas('category', function ($q) use ($categorySlug) {
            $q->where('slug', $categorySlug);
        });
    }
}
