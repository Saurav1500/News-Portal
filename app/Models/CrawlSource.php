<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrawlSource extends Model
{
    protected $fillable = [
        'name',
        'url',
        'category_id',
        'is_active',
        'crawl_interval_minutes',
        'last_crawled_at',
        'selector_config',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'crawl_interval_minutes' => 'integer',
        'last_crawled_at' => 'datetime',
        'selector_config' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
