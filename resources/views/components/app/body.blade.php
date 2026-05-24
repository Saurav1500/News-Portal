@php
    $featured = $featuredNews ?? \App\Models\News::with('category')->published()->latest('published_at')->take(6)->get();
    $allCategories = $categories ?? \App\Models\Category::active()->ordered()->get();
    $trending = $trendingNews ?? \App\Models\News::with('category')->published()->where('priority', 'urgent')->latest('published_at')->take(4)->get();
@endphp

<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h2>{{ __('site.hero.title') }}</h2>
            <p>{{ __('site.hero.subtitle') }}</p>
        </div>
    </div>
</section>

@if($trending->count() > 0)
<section class="trending-section">
    <div class="container">
        <h3 class="section-title">{{ __('site.sections.trending') }}</h3>
        <div class="trending-grid">
            @foreach($trending as $index => $item)
                @if($index === 0)
                <article class="trending-item main-trending">
                    <a href="{{ route('news.show', $item->slug) }}" style="text-decoration: none; color: inherit;">
                        <div class="trending-image">
                            @if($item->image)
                                <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" />
                            @endif
                            @if($item->priority === 'urgent')
                                <div class="trending-badge">{{ __('site.labels.trending') }}</div>
                            @endif
                        </div>
                        <div class="trending-content">
                            <h4>{{ $item->title }}</h4>
                            <p>{{ Str::limit($item->summary, 120) }}</p>
                            <div class="trending-meta">
                                <span class="category">{{ $item->category?->name ?? '' }}</span>
                                <span class="time">{{ $item->published_at?->diffForHumans() }}</span>
                            </div>
                        </div>
                    </a>
                </article>
                @else
                <article class="trending-item">
                    <a href="{{ route('news.show', $item->slug) }}" style="text-decoration: none; color: inherit;">
                        <div class="trending-image">
                            @if($item->image)
                                <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" />
                            @endif
                        </div>
                        <div class="trending-content">
                            <h5>{{ $item->title }}</h5>
                            <span class="time">{{ $item->published_at?->diffForHumans() }}</span>
                        </div>
                    </a>
                </article>
                @endif
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="news-categories">
    <div class="container">
        <div class="categories-grid">
            @foreach($allCategories->take(4) as $category)
                @php
                    $catNews = $featured->where('category_id', $category->id);
                @endphp
                <div class="category-section">
                    <h3 class="category-title">
                        <a href="{{ route('category.show', $category->slug) }}" style="color: inherit; text-decoration: none;">
                            {{ $category->name }}
                        </a>
                    </h3>
                    <div class="news-list">
                        @forelse($catNews->take(2) as $item)
                        <article class="news-item">
                            <a href="{{ route('news.show', $item->slug) }}" style="display: flex; gap: 16px; text-decoration: none; color: inherit;">
                                @if($item->image)
                                    <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" style="width: 120px; height: 90px; object-fit: cover; border-radius: 8px;" />
                                @endif
                                <div class="news-content">
                                    <h4>{{ $item->title }}</h4>
                                    @if($item->summary)
                                        <p>{{ Str::limit($item->summary, 80) }}</p>
                                    @endif
                                    <span class="news-time">{{ $item->published_at?->diffForHumans() }}</span>
                                </div>
                            </a>
                        </article>
                        @empty
                            <p style="color: #6c757d; font-size: 14px;">यस श्रेणीमा कुनै समाचार छैन।</p>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@if($featured->count() > 0)
<section class="featured-stories">
    <div class="container">
        <h3 class="section-title">{{ __('site.sections.featured') }}</h3>
        <div class="stories-grid">
            @foreach($featured->take(2) as $item)
            <article class="story-item">
                <a href="{{ route('news.show', $item->slug) }}" style="text-decoration: none; color: inherit;">
                    @if($item->image)
                        <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" />
                    @endif
                    <div class="story-content">
                        <h4>{{ $item->title }}</h4>
                        <p>{{ Str::limit($item->summary, 100) }}</p>
                        <span class="story-category">{{ $item->category?->name ?? __('site.labels.special') }}</span>
                    </div>
                </a>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif
