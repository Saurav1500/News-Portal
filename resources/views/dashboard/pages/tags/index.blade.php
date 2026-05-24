@extends('layouts.dashboard')
@section('title', 'ट्याग व्यवस्थापन - News AI')
@section('content')
<div class="dashboard-content">
    <div class="page-header">
        <div class="header-top">
            <div>
                <h1 class="page-title">ट्याग व्यवस्थापन</h1>
                <p class="page-subtitle">समाचार ट्यागहरू व्यवस्थापन गर्नुहोस्</p>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="list-card">
        <div class="list-toolbar">
            <form action="{{ route('dashboard.tags.store') }}" method="POST" class="inline-form">
                @csrf
                <div class="inline-group">
                    <input type="text" name="name" required placeholder="नयाँ ट्याग नाम" class="inline-input">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> थप्नुहोस्
                    </button>
                </div>
            </form>
            <span class="total-count">जम्मा: {{ $tags->total() }} ट्याग</span>
        </div>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>नाम</th>
                        <th>स्लग</th>
                        <th>समाचार संख्या</th>
                        <th>मिति</th>
                        <th>कार्यहरू</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tags as $tag)
                    <tr>
                        <td>{{ $tag->id }}</td>
                        <td class="title-cell">
                            <span class="tag-name">{{ $tag->name }}</span>
                        </td>
                        <td><code>{{ $tag->slug }}</code></td>
                        <td><span class="badge">{{ $tag->news_count }}</span></td>
                        <td class="date-cell">{{ $tag->created_at->format('Y-m-d') }}</td>
                        <td class="actions-cell">
                            <div class="action-btns">
                                <form action="{{ route('dashboard.tags.update', $tag) }}" method="POST" style="display:inline" class="inline-edit-form">
                                    @csrf @method('PUT')
                                    <input type="text" name="name" value="{{ $tag->name }}" required class="edit-input" style="display:none">
                                    <button type="button" class="action-btn edit toggle-edit" title="सम्पादन">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="submit" class="action-btn publish save-edit" title="सेभ" style="display:none">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                <form action="{{ route('dashboard.tags.destroy', $tag) }}" method="POST" style="display:inline" onsubmit="return confirm('के तपाईं यो ट्याग मेटाउन चाहनुहुन्छ?')">
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
            {{ $tags->links() }}
        </div>
    </div>
</div>
<script>
document.querySelectorAll('.toggle-edit').forEach(btn => {
    btn.addEventListener('click', function() {
        const form = this.closest('form');
        form.querySelector('.edit-input').style.display = 'inline-block';
        this.style.display = 'none';
        form.querySelector('.save-edit').style.display = 'inline-flex';
    });
});
</script>
<style>
.dashboard-content { padding: 30px; }
.page-header { margin-bottom: 30px; }
.header-top { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px; }
.page-title { font-size: 28px; font-weight: 700; color: #1a1a2e; margin: 0; }
.page-subtitle { color: #6c757d; margin: 5px 0 0 0; font-size: 15px; }
.alert { padding: 14px 20px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; }
.alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
.list-card { background: white; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); overflow: hidden; }
.list-toolbar { display: flex; justify-content: space-between; align-items: center; padding: 20px 24px; border-bottom: 1px solid #f0f0f0; flex-wrap: wrap; gap: 16px; }
.inline-form { margin: 0; }
.inline-group { display: flex; gap: 8px; align-items: center; }
.inline-input { padding: 10px 14px; border: 2px solid #e9ecef; border-radius: 10px; font-size: 14px; font-family: 'Noto Sans Devanagari', sans-serif; background: #f8f9fa; min-width: 200px; transition: border-color 0.2s; }
.inline-input:focus { outline: none; border-color: #CD2737; background: white; }
.total-count { font-size: 14px; color: #6c757d; }
.table-responsive { overflow-x: auto; }
.data-table { width: 100%; border-collapse: collapse; }
.data-table th { text-align: left; padding: 14px 16px; font-size: 12px; font-weight: 600; color: #6c757d; text-transform: uppercase; letter-spacing: 0.5px; background: #fafafa; border-bottom: 1px solid #f0f0f0; }
.data-table td { padding: 16px; border-bottom: 1px solid #f8f9fa; font-size: 14px; color: #333; vertical-align: middle; }
.data-table tr:hover td { background: #fafafa; }
.title-cell { min-width: 150px; }
.tag-name { font-weight: 500; color: #1a1a2e; }
.badge { background: #f0f0f0; padding: 4px 12px; border-radius: 12px; font-size: 13px; font-weight: 600; }
code { background: #f0f0f0; padding: 2px 8px; border-radius: 4px; font-size: 13px; }
.date-cell { color: #6c757d; font-size: 13px; }
.actions-cell { white-space: nowrap; }
.action-btns { display: flex; gap: 6px; align-items: center; }
.action-btn { width: 36px; height: 36px; border: none; border-radius: 8px; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; font-size: 14px; transition: all 0.2s; text-decoration: none; }
.action-btn.edit { background: #e3f2fd; color: #1976d2; }
.action-btn.edit:hover { background: #1976d2; color: white; }
.action-btn.delete { background: #fce4ec; color: #CD2737; }
.action-btn.delete:hover { background: #CD2737; color: white; }
.action-btn.publish { background: #e8f5e9; color: #28a745; }
.action-btn.publish:hover { background: #28a745; color: white; }
.edit-input { padding: 6px 10px; border: 2px solid #CD2737; border-radius: 6px; font-size: 14px; font-family: 'Noto Sans Devanagari', sans-serif; background: white; width: 150px; }
.pagination-wrapper { padding: 16px 24px; border-top: 1px solid #f0f0f0; }
.btn { padding: 14px 28px; border: none; border-radius: 10px; font-size: 15px; font-weight: 600; cursor: pointer; transition: all 0.3s; font-family: 'Noto Sans Devanagari', sans-serif; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; }
.btn-sm { padding: 10px 18px; font-size: 14px; }
.btn-primary { background: #CD2737; color: white; box-shadow: 0 4px 15px rgba(205,39,55,0.3); }
.btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(205,39,55,0.4); }
</style>
@endsection
