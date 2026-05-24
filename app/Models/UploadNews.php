<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadNews extends Model
{
    protected $table = 'upload_news';

    protected $fillable = [
        'title',
        'category',
        'summary',
        'content',
        'author',
        'email',
        'image',
        'tags',
        'priority',
        'is_draft',
        'terms_accepted',
    ];

    protected $casts = [
        'is_draft' => 'boolean',
        'terms_accepted' => 'boolean',
    ];
}
