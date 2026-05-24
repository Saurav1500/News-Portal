@php
    use App\Models\News;
    $totalNews = $totalNews ?? News::count();
    $publishedNews = $publishedNews ?? News::published()->count();
    $draftNews = $draftNews ?? News::draft()->count();
    $recentNews = $recentNews ?? News::with('category')->latest()->take(5)->get();
    $currentUser = auth()->user();
@endphp

@extends('layouts.dashboard')
@section('title', 'Dashboard - News AI')

@section('content')
<div class="dashboard-content">
    <div class="page-header">
        <div class="header-top">
            <div>
                <h1 class="page-title">Dashboard</h1>
                <p class="page-subtitle">तपाईंको समाचार पोर्टलको सारांश</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('dashboard.news.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> नयाँ समाचार
                </a>
            </div>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background: #CD2737;">
                <i class="fas fa-newspaper"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $totalNews }}</h3>
                <p>कुल समाचार</p>
            </div>
            <div class="stat-change up">
                <i class="fas fa-arrow-up"></i> कुल
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: #28a745;">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $publishedNews }}</h3>
                <p>प्रकाशित</p>
            </div>
            <div class="stat-change up">
                <i class="fas fa-globe"></i> सार्वजनिक
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: #ffc107;">
                <i class="fas fa-pen-fancy"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $draftNews }}</h3>
                <p>ड्राफ्ट</p>
            </div>
            <div class="stat-change">
                <i class="fas fa-clock"></i> पेन्डिङ
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: #0d6efd;">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $currentUser ? $currentUser->name : '—' }}</h3>
                <p>स्वागत छ</p>
            </div>
            <div class="stat-change">
                <i class="fas fa-user"></i> {{ $currentUser ? $currentUser->email : '' }}
            </div>
        </div>
    </div>

    <div class="dashboard-grid">
        <div class="dashboard-card recent-news">
            <div class="card-header">
                <h3><i class="fas fa-clock"></i> हालैका समाचार</h3>
                <a href="{{ route('dashboard.news.list') }}" class="card-link">सबै हेर्नुहोस् <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="card-body">
                @if($recentNews->count() > 0)
                    <table class="news-table">
                        <thead>
                            <tr>
                                <th>शीर्षक</th>
                                <th>श्रेणी</th>
                                <th>लेखक</th>
                                <th>स्थिति</th>
                                <th>मिति</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentNews as $item)
                            <tr>
                                <td class="title-cell">
                                    <span class="news-title">{{ Str::limit($item->title, 40) }}</span>
                                </td>
                                <td><span class="category-badge">{{ $item->category?->name ?? $item->category }}</span></td>
                                <td>{{ $item->author }}</td>
                                <td>
                                    @if($item->is_draft)
                                        <span class="status-badge draft">ड्राफ्ट</span>
                                    @else
                                        <span class="status-badge published">प्रकाशित</span>
                                    @endif
                                </td>
                                <td class="date-cell">{{ $item->created_at->format('Y-m-d') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-state">
                        <i class="fas fa-newspaper"></i>
                        <p>कुनै समाचार छैन। पहिलो समाचार सिर्जना गर्नुहोस्।</p>
                        <a href="{{ route('dashboard.news.create') }}" class="btn btn-primary">समाचार सिर्जना गर्नुहोस्</a>
                    </div>
                @endif
            </div>
        </div>

        <div class="dashboard-card quick-actions">
            <div class="card-header">
                <h3><i class="fas fa-bolt"></i> द्रुत कार्यहरू</h3>
            </div>
            <div class="card-body">
                <div class="action-list">
                    <a href="{{ route('dashboard.news.create') }}" class="action-item">
                        <span class="action-icon" style="background: #CD2737;"><i class="fas fa-plus"></i></span>
                        <span class="action-text"><strong>नयाँ समाचार</strong><small>नयाँ समाचार लेख्नुहोस् र प्रकाशित गर्नुहोस्</small></span>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                    <a href="{{ route('dashboard.news.list') }}" class="action-item">
                        <span class="action-icon" style="background: #28a745;"><i class="fas fa-list"></i></span>
                        <span class="action-text"><strong>समाचार व्यवस्थापन</strong><small>सबै समाचार हेर्नुहोस्, सम्पादन गर्नुहोस् वा मेटाउनुहोस्</small></span>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                    <a href="{{ route('dashboard.categories.index') }}" class="action-item">
                        <span class="action-icon" style="background: #ffc107;"><i class="fas fa-folder"></i></span>
                        <span class="action-text"><strong>श्रेणी व्यवस्थापन</strong><small>श्रेणीहरू थप्नुहोस् र व्यवस्थापन गर्नुहोस्</small></span>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                    <a href="{{ route('dashboard.crawl-sources.index') }}" class="action-item">
                        <span class="action-icon" style="background: #0d6efd;"><i class="fas fa-cloud-download-alt"></i></span>
                        <span class="action-text"><strong>क्रल स्रोतहरू</strong><small>अन्य साइटबाट समाचार क्रल गर्नुहोस्</small></span>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="dashboard-card recent-activity" style="margin-top: 30px;">
        <div class="card-header">
            <h3><i class="fas fa-chart-bar"></i> श्रेणी अनुसार समाचार</h3>
        </div>
        <div class="card-body">
            @php
                $categories = \App\Models\Category::withCount('news')->orderBy('news_count', 'desc')->get();
            @endphp
            @if($categories->count() > 0)
                <div class="categories-chart">
                    @foreach($categories as $cat)
                        @php
                            $maxCount = $categories->max('news_count');
                            $percentage = $maxCount > 0 ? round(($cat->news_count / $maxCount) * 100) : 0;
                            $colors = ['#CD2737', '#28a745', '#ffc107', '#0d6efd', '#6610f2', '#fd7e14', '#20c997', '#e83e8c', '#6f42c1'];
                            $colorIndex = $loop->index % count($colors);
                        @endphp
                        <div class="category-bar-item">
                            <div class="category-bar-label">
                                <span class="category-name">{{ $cat->name }}</span>
                                <span class="category-count">{{ $cat->news_count }}</span>
                            </div>
                            <div class="category-bar-track">
                                <div class="category-bar-fill" style="width: {{ $percentage }}%; background: {{ $colors[$colorIndex] }};"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state"><p>कुनै श्रेणी डेटा उपलब्ध छैन।</p></div>
            @endif
        </div>
    </div>
</div>

<style>
.dashboard-content { padding: 30px; }
.page-header { margin-bottom: 30px; }
.header-top { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px; }
.page-title { font-size: 28px; font-weight: 700; color: #1a1a2e; margin: 0; }
.page-subtitle { color: #6c757d; margin: 5px 0 0 0; font-size: 15px; }
.stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 24px; margin-bottom: 30px; }
.stat-card { background: white; border-radius: 16px; padding: 24px; display: flex; align-items: center; gap: 20px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); transition: transform 0.2s, box-shadow 0.2s; position: relative; }
.stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0,0,0,0.1); }
.stat-icon { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; color: white; font-size: 22px; flex-shrink: 0; }
.stat-info h3 { font-size: 26px; font-weight: 700; color: #1a1a2e; margin: 0 0 4px 0; }
.stat-info p { color: #6c757d; font-size: 14px; margin: 0; }
.stat-change { position: absolute; top: 16px; right: 16px; font-size: 12px; padding: 3px 10px; border-radius: 20px; background: #f8f9fa; color: #6c757d; }
.stat-change.up { color: #28a745; background: #e8f5e9; }
.dashboard-grid { display: grid; grid-template-columns: 1.5fr 1fr; gap: 30px; }
@media (max-width: 1024px) { .dashboard-grid { grid-template-columns: 1fr; } }
.dashboard-card { background: white; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); overflow: hidden; }
.card-header { padding: 20px 24px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; }
.card-header h3 { font-size: 17px; font-weight: 600; color: #1a1a2e; margin: 0; display: flex; align-items: center; gap: 10px; }
.card-header h3 i { color: #CD2737; }
.card-link { color: #CD2737; text-decoration: none; font-size: 14px; font-weight: 500; display: flex; align-items: center; gap: 6px; transition: gap 0.2s; }
.card-link:hover { gap: 10px; }
.card-body { padding: 20px 24px; }
.news-table { width: 100%; border-collapse: collapse; }
.news-table th { text-align: left; font-size: 13px; font-weight: 600; color: #6c757d; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 8px; border-bottom: 2px solid #f0f0f0; }
.news-table td { padding: 14px 8px; border-bottom: 1px solid #f8f9fa; font-size: 14px; color: #333; }
.news-table tr:last-child td { border-bottom: none; }
.news-table tr:hover td { background: #fafafa; }
.title-cell .news-title { font-weight: 500; color: #1a1a2e; }
.category-badge { background: #f0f0f0; padding: 4px 12px; border-radius: 12px; font-size: 12px; color: #555; }
.status-badge { padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 600; }
.status-badge.published { background: #e8f5e9; color: #28a745; }
.status-badge.draft { background: #fff8e1; color: #f39c12; }
.date-cell { color: #6c757d; font-size: 13px; }
.empty-state { text-align: center; padding: 40px 20px; color: #6c757d; }
.empty-state i { font-size: 48px; color: #dee2e6; margin-bottom: 16px; }
.action-list { display: flex; flex-direction: column; gap: 4px; }
.action-item { display: flex; align-items: center; gap: 16px; padding: 16px; border-radius: 12px; text-decoration: none; color: #333; transition: background 0.2s; }
.action-item:hover { background: #f8f9fa; }
.action-icon { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 18px; flex-shrink: 0; }
.action-text strong { display: block; font-size: 14px; color: #1a1a2e; }
.action-text small { font-size: 12px; color: #6c757d; }
.action-item .fa-chevron-right { color: #dee2e6; font-size: 14px; }
.categories-chart { display: flex; flex-direction: column; gap: 16px; }
.category-bar-item { display: flex; flex-direction: column; gap: 6px; }
.category-bar-label { display: flex; justify-content: space-between; align-items: center; }
.category-name { font-size: 14px; font-weight: 500; color: #333; }
.category-count { font-size: 14px; font-weight: 600; color: #1a1a2e; }
.category-bar-track { height: 8px; background: #f0f0f0; border-radius: 4px; overflow: hidden; }
.category-bar-fill { height: 100%; border-radius: 4px; transition: width 0.6s ease; }
.btn { padding: 14px 28px; border: none; border-radius: 10px; font-size: 15px; font-weight: 600; cursor: pointer; transition: all 0.3s; font-family: 'Noto Sans Devanagari', sans-serif; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; }
.btn-primary { background: #CD2737; color: white; box-shadow: 0 4px 15px rgba(205,39,55,0.3); }
.btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(205,39,55,0.4); }
@media (max-width: 768px) { .dashboard-content { padding: 20px; } .stats-grid { grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 16px; } .stat-card { padding: 16px; } .stat-info h3 { font-size: 20px; } .stat-icon { width: 44px; height: 44px; font-size: 18px; } }
</style>
@endsection
