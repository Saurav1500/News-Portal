@extends('layouts.dashboard')
@section('title', 'श्रेणी व्यवस्थापन - News AI')
@section('content')
<div class="dashboard-content">
    <div class="page-header">
        <div class="header-top">
            <div>
                <h1 class="page-title">श्रेणी व्यवस्थापन</h1>
                <p class="page-subtitle">समाचार श्रेणीहरू व्यवस्थापन गर्नुहोस्</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> नयाँ श्रेणी
                </a>
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
                        <th>क्रम</th>
                        <th>नाम</th>
                        <th>स्लग</th>
                        <th>समाचार संख्या</th>
                        <th>सक्रिय</th>
                        <th>क्रमाङ्क</th>
                        <th>कार्यहरू</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $cat)
                    <tr>
                        <td>{{ $cat->id }}</td>
                        <td class="title-cell">
                            <span class="news-title">{{ $cat->name }}</span>
                        </td>
                        <td><code>{{ $cat->slug }}</code></td>
                        <td>{{ $cat->news()->count() }}</td>
                        <td>
                            @if($cat->is_active)
                                <span class="status-badge published">सक्रिय</span>
                            @else
                                <span class="status-badge draft">निष्क्रिय</span>
                            @endif
                        </td>
                        <td>{{ $cat->display_order }}</td>
                        <td class="actions-cell">
                            <div class="action-btns">
                                <a href="{{ route('dashboard.categories.edit', $cat) }}" class="action-btn edit" title="सम्पादन">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('dashboard.categories.destroy', $cat) }}" method="POST" style="display:inline" onsubmit="return confirm('के तपाईं यो श्रेणी मेटाउन चाहनुहुन्छ?')">
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
            {{ $categories->links() }}
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
.data-table th { text-align: left; padding: 14px 16px; font-size: 12px; font-weight: 600; color: #6c757d; text-transform: uppercase; letter-spacing: 0.5px; background: #fafafa; border-bottom: 1px solid #f0f0f0; white-space: nowrap; }
.data-table td { padding: 16px; border-bottom: 1px solid #f8f9fa; font-size: 14px; color: #333; vertical-align: middle; }
.data-table tr:hover td { background: #fafafa; }
.title-cell { min-width: 150px; }
.news-title { font-weight: 500; color: #1a1a2e; }
.actions-cell { white-space: nowrap; }
.action-btns { display: flex; gap: 6px; }
.action-btn { width: 36px; height: 36px; border: none; border-radius: 8px; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; font-size: 14px; transition: all 0.2s; text-decoration: none; }
.action-btn.edit { background: #e3f2fd; color: #1976d2; }
.action-btn.edit:hover { background: #1976d2; color: white; }
.action-btn.delete { background: #fce4ec; color: #CD2737; }
.action-btn.delete:hover { background: #CD2737; color: white; }
.status-badge { padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 600; }
.status-badge.published { background: #e8f5e9; color: #28a745; }
.status-badge.draft { background: #fff8e1; color: #f39c12; }
code { background: #f0f0f0; padding: 2px 8px; border-radius: 4px; font-size: 13px; }
.pagination-wrapper { padding: 16px 24px; border-top: 1px solid #f0f0f0; }
.btn { padding: 14px 28px; border: none; border-radius: 10px; font-size: 15px; font-weight: 600; cursor: pointer; transition: all 0.3s; font-family: 'Noto Sans Devanagari', sans-serif; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; }
.btn-primary { background: #CD2737; color: white; box-shadow: 0 4px 15px rgba(205,39,55,0.3); }
.btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(205,39,55,0.4); }
</style>
@endsection
