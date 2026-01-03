<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $fillable=['user_id','source_id','title','slug','hero_image_path','contenct','summary','ai_categories','ai_tags','is_published','published_at','views'];
    
    protected $cast=[
        'ai_categories'=>'array',
        'ai_tags'=>'array',
        'is_published'=>'boolean',
        'published_at'=>'datetime',
    ];


    //Relationships
    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function source(){
        return $this->belongsTo(Source::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }


}
