<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $featuredNews = News::with('category')->published()->latest('published_at')->take(6)->get();
        $categories = Category::active()->ordered()->get();
        $trendingNews = News::with('category')->published()->where('priority', 'urgent')->latest('published_at')->take(4)->get();

        return view('pages.index', compact('featuredNews', 'categories', 'trendingNews'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $newsList = News::with('category')->published()->where('category_id', $category->id)
            ->latest('published_at')->paginate(12);

        return view('pages.category', compact('category', 'newsList'));
    }

    public function show($slug)
    {
        $news = News::with('category', 'tags')->where('slug', $slug)->published()->firstOrFail();
        $relatedNews = News::with('category')->published()
            ->where('category_id', $news->category_id)
            ->where('id', '!=', $news->id)
            ->latest('published_at')->take(4)->get();

        return view('pages.show', compact('news', 'relatedNews'));
    }

    public function news()
    {
        return $this->index();
    }

    public function business()
    {
        return $this->category('business');
    }

    public function life_style()
    {
        return $this->category('life-style');
    }

    public function entertainment()
    {
        return $this->category('entertainment');
    }

    public function opinion()
    {
        return $this->category('opinion');
    }

    public function technology()
    {
        return $this->category('technology');
    }

    public function sports()
    {
        return $this->category('sports');
    }

    public function upload()
    {
        $categories = Category::active()->ordered()->get();
        return view('pages.upload', compact('categories'));
    }
}
