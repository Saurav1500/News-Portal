@extends('layouts.dashboard')
@section('title', 'क्रल स्रोत व्यवस्थापन - News AI')
@section('content')
<div class="dashboard-content">
    <div class="page-header">
        <div class="header-top">
            <div>
                <h1 class="page-title">क्रल स्रोत व्यवस्थापन</h1>
                <p class="page-subtitle">अन्य वेबसाइटबाट समाचार क्रल गर्न स्रोतहरू व्यवस्थापन गर्नुहोस्</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('dashboard.crawl-sources.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> नयाँ स्रोत
                </a>
                <form action="{{ route('dashboard.crawl.run') }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="btn btn-primary" style="background:#28a745;box-shadow:0 4px 15px rgba(40,167,69,0.3);">
                        <i class="fas fa-cloud-download-alt"></i> सबै क्रल गर्नुहोस्
                    </button>
                </form>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <div class="list-card">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>नाम</th>
                        <th>URL</th>
                        <th>श्रेणी</th>
                        <th>सक्रिय</th>
                        <th>पछिल्लो क्रल</th>
                        <th>कार्यहरू</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sources as $source)
                    <tr>
                        <td>{{ $source->id }}</td>
                        <td class="title-cell">
                            <span class="source-name">{{ $source->name }}</span>
                        </td>
                        <td><a href="{{ $source->url }}" target="_blank" class="source-url">{{ Str::limit($source->url, 40) }}</a></td>
                        <td>{{ $source->category?->name ?? '—' }}</td>
                        <td>
                            @if($source->is_active)
                                <span class="status-badge published">सक्रिय</span>
                            @else
                                <span class="status-badge draft">निष्क्रिय</span>
                            @endif
                        </td>
                        <td class="date-cell">{{ $source->last_crawled_at ? $source->last_crawled_at->diffForHumans() : 'कहिल्यै' }}</td>
                        <td class="actions-cell">
                            <div class="action-btns">
                                <form action="{{ route('dashboard.crawl.run') }}" method="POST" style="display:inline">
                                    @csrf
                                    <input type="hidden" name="source" value="{{ $source->id }}">
                                    <button type="submit" class="action-btn publish" title="क्रल गर्नुहोस्">
                                        <i class="fas fa-cloud-download-alt"></i>
                                    </button>
                                </form>
                                <a href="{{ route('dashboard.crawl-sources.edit', $source) }}" class="action-btn edit" title="सम्पादन">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('dashboard.crawl-sources.destroy', $source) }}" method="POST" style="display:inline" onsubmit="return confirm('के तपाईं यो स्रोत मेटाउन चाहनुहुन्छ?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="action-btn delete" title="मेटाउनुहोस्">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">
            {{ $sources->links() }}
        </div>
    </div>
</div>
<style>
.dashboard-content { padding: 30px; }
.page-header { margin-bottom: 30px; }
.header-top { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px; }
.page-title { font-size: 28px; font-weight: 700; color: #1a1a2e; margin: 0; }
.page-subtitle { color: #6c757d; margin: 5px 0 0 0; font-size: 15px; }
.alert { padding: 14px 20px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; }
.alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
.alert-error { background: #fce4ec; color: #CD2737; border: 1px solid #f8d7da; }
.list-card { background: white; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); overflow: hidden; }
.table-responsive { overflow-x: auto; }
.data-table { width: 100%; border-collapse: collapse; }
.data-table th { text-align: left; padding: 14px 16px; font-size: 12px; font-weight: 600; color: #6c757d; text-transform: uppercase; letter-spacing: 0.5px; background: #fafafa; border-bottom: 1px solid #f0f0f0; }
.data-table td { padding: 16px; border-bottom: 1px solid #f8f9fa; font-size: 14px; color: #333; vertical-align: middle; }
.data-table tr:hover td { background: #fafafa; }
.title-cell { min-width: 150px; }
.source-name { font-weight: 500; color: #1a1a2e; }
.source-url { color: #1976d2; font-size: 13px; text-decoration: none; }
.source-url:hover { text-decoration: underline; }
.status-badge { padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 600; }
.status-badge.published { background: #e8f5e9; color: #28a745; }
.status-badge.draft { background: #fff8e1; color: #f39c12; }
.date-cell { color: #6c757d; font-size: 13px; }
.actions-cell { white-space: nowrap; }
.action-btns { display: flex; gap: 6px; }
.action-btn { width: 36px; height: 36px; border: none; border-radius: 8px; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; font-size: 14px; transition: all 0.2s; text-decoration: none; }
.action-btn.edit { background: #e3f2fd; color: #1976d2; }
.action-btn.edit:hover { background: #1976d2; color: white; }
.action-btn.delete { background: #fce4ec; color: #CD2737; }
.action-btn.delete:hover { background: #CD2737; color: white; }
.action-btn.publish { background: #e8f5e9; color: #28a745; }
.action-btn.publish:hover { background: #28a745; color: white; }
.pagination-wrapper { padding: 16px 24px; border-top: 1px solid #f0f0f0; }
.btn { padding: 14px 28px; border: none; border-radius: 10px; font-size: 15px; font-weight: 600; cursor: pointer; transition: all 0.3s; font-family: "Noto Sans Devanagari", sans-serif; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; }
.btn-primary { background: #CD2737; color: white; box-shadow: 0 4px 15px rgba(205,39,55,0.3); }
.btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(205,39,55,0.4); }
</style>
@endsection
