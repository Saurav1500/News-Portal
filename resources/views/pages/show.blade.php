@extends('layouts.app')
@section('title', $news->title . ' - NEWSai')
@section('content')
<section class="news-detail" style="padding: 40px 0;">
    <div class="container" style="max-width: 800px; margin: 0 auto;">
        <div style="margin-bottom: 24px;">
            @if($news->category)
                <a href="{{ route('category.show', $news->category->slug) }}" style="display: inline-block; background: #CD2737; color: white; padding: 4px 14px; border-radius: 20px; font-size: 13px; text-decoration: none; margin-bottom: 12px;">
                    {{ $news->category->name }}
                </a>
            @endif
            <h1 style="font-size: 32px; font-weight: 700; color: #1a1a2e; margin: 0 0 16px 0; line-height: 1.3;">{{ $news->title }}</h1>
            <div style="display: flex; gap: 20px; font-size: 14px; color: #6c757d; flex-wrap: wrap;">
                <span><i class="fas fa-user"></i> {{ $news->author }}</span>
                <span><i class="fas fa-clock"></i> {{ $news->published_at?->format('Y-m-d') }}</span>
                @if($news->source)
                    <span><i class="fas fa-source"></i> {{ $news->source }}</span>
                @endif
            </div>
        </div>

        @if($news->image)
            <img src="{{ asset($news->image) }}" alt="{{ $news->title }}" style="width: 100%; max-height: 400px; object-fit: cover; border-radius: 12px; margin-bottom: 24px;">
        @endif

        @if($news->summary)
            <div style="background: #f8f9fa; padding: 20px; border-radius: 12px; margin-bottom: 24px; font-size: 16px; color: #555; font-style: italic; border-left: 4px solid #CD2737;">
                {{ $news->summary }}
            </div>
        @endif

        <div style="font-size: 16px; line-height: 1.8; color: #333; white-space: pre-wrap;">
            {{ $news->content }}
        </div>

        @if($news->tags->count() > 0)
            <div style="margin-top: 32px; padding-top: 24px; border-top: 1px solid #f0f0f0;">
                <strong style="font-size: 14px; color: #1a1a2e;">ट्यागहरू:</strong>
                <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-top: 8px;">
                    @foreach($news->tags as $tag)
                        <span style="background: #f0f0f0; padding: 4px 12px; border-radius: 12px; font-size: 13px; color: #555;">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>

@if($relatedNews->count() > 0)
<section style="background: #f8f9fa; padding: 40px 0;">
    <div class="container">
        <h3 style="font-size: 22px; font-weight: 700; color: #1a1a2e; margin-bottom: 24px;">सम्बन्धित समाचार</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px;">
            @foreach($relatedNews as $related)
            <article style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.08);">
                <a href="{{ route('news.show', $related->slug) }}" style="text-decoration: none; color: inherit;">
                    @if($related->image)
                        <img src="{{ asset($related->image) }}" alt="" style="width: 100%; height: 160px; object-fit: cover;">
                    @endif
                    <div style="padding: 14px;">
                        <h4 style="font-size: 15px; font-weight: 600; margin: 0 0 6px 0; color: #1a1a2e;">{{ Str::limit($related->title, 60) }}</h4>
                        <span style="font-size: 12px; color: #6c757d;">{{ $related->published_at?->diffForHumans() }}</span>
                    </div>
                </a>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
