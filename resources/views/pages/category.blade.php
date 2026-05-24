@extends('layouts.app')
@section('title', $category->name . ' - NEWSai')
@section('content')
<section class="page-header" style="background: #CD2737; color: white; padding: 60px 0; text-align: center;">
    <div class="container">
        <h1>{{ $category->name }}</h1>
        @if($category->description)
            <p>{{ $category->description }}</p>
        @endif
    </div>
</section>

<section class="category-news" style="padding: 40px 0;">
    <div class="container">
        @if($newsList->count() > 0)
            <div class="news-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px;">
                @foreach($newsList as $item)
                <article class="news-card" style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.08); transition: transform 0.3s;">
                    <a href="{{ route('news.show', $item->slug) }}" style="text-decoration: none; color: inherit;">
                        @if($item->image)
                            <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" style="width: 100%; height: 200px; object-fit: cover;">
                        @endif
                        <div style="padding: 16px;">
                            <h3 style="font-size: 18px; font-weight: 600; margin: 0 0 8px 0; color: #1a1a2e;">{{ $item->title }}</h3>
                            <p style="font-size: 14px; color: #6c757d; margin: 0 0 12px 0;">{{ Str::limit($item->summary, 100) }}</p>
                            <div style="display: flex; justify-content: space-between; font-size: 12px; color: #6c757d;">
                                <span>{{ $item->author }}</span>
                                <span>{{ $item->published_at?->diffForHumans() }}</span>
                            </div>
                        </div>
                    </a>
                </article>
                @endforeach
            </div>
            <div style="margin-top: 30px;">
                {{ $newsList->links() }}
            </div>
        @else
            <div style="text-align: center; padding: 60px 20px; color: #6c757d;">
                <i class="fas fa-newspaper" style="font-size: 48px; color: #dee2e6; margin-bottom: 16px;"></i>
                <h3>यस श्रेणीमा कुनै समाचार छैन।</h3>
            </div>
        @endif
    </div>
</section>
@endsection
