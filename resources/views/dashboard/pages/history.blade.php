@extends('layouts.dashboard')
@section('title', 'समाचार व्यवस्थापन - News AI')
@section('content')
<div class="dashboard-content">
    <div class="page-header">
        <div class="header-top">
            <div>
                <h1 class="page-title">समाचार व्यवस्थापन</h1>
                <p class="page-subtitle">सबै समाचारहरू हेर्नुहोस्, सम्पादन गर्नुहोस् वा मेटाउनुहोस्</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('dashboard.news.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> नयाँ समाचार
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="list-card">
        <div class="list-toolbar">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="समाचार खोज्नुहोस्..." onkeyup="filterTable()">
            </div>
            <div class="filter-group">
                <select id="filterStatus" onchange="filterTable()">
                    <option value="all">सबै स्थिति</option>
                    <option value="published">प्रकाशित</option>
                    <option value="draft">ड्राफ्ट</option>
                </select>
                <select id="filterCategory" onchange="filterTable()">
                    <option value="all">सबै श्रेणी</option>
                    @foreach(\App\Models\Category::active()->ordered()->get() as $cat)
                        <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        @if($news->count() > 0)
            <div class="table-responsive">
                <table class="data-table" id="newsTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>शीर्षक</th>
                            <th>श्रेणी</th>
                            <th>लेखक</th>
                            <th>प्राथमिकता</th>
                            <th>स्थिति</th>
                            <th>मिति</th>
                            <th>कार्यहरू</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($news as $item)
                        <tr>
                            <td class="id-cell">#{{ $item->id }}</td>
                            <td class="title-cell">
                                <span class="news-title">{{ Str::limit($item->title, 50) }}</span>
                                @if($item->priority === 'urgent')
                                    <span class="priority-badge urgent">तत्काल</span>
                                @elseif($item->priority === 'high')
                                    <span class="priority-badge high">उच्च</span>
                                @endif
                            </td>
                            <td><span class="category-tag">{{ $item->category?->name ?? $item->category }}</span></td>
                            <td>{{ $item->author }}</td>
                            <td><span class="priority-dot {{ $item->priority }}"></span></td>
                            <td>
                                @if($item->is_draft)
                                    <span class="status-badge draft">ड्राफ्ट</span>
                                @else
                                    <span class="status-badge published">प्रकाशित</span>
                                @endif
                            </td>
                            <td class="date-cell">{{ $item->created_at->format('Y-m-d') }}</td>
                            <td class="actions-cell">
                                <div class="action-btns">
                                    @if($item->is_draft)
                                        <form action="{{ route('dashboard.news.publish', $item->id) }}" method="POST" style="display:inline">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="action-btn publish" title="प्रकाशित गर्नुहोस्">
                                                <i class="fas fa-check-circle"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('dashboard.news.toggle-draft', $item->id) }}" method="POST" style="display:inline">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="action-btn unpublish" title="ड्राफ्टमा लैजानुहोस्">
                                                <i class="fas fa-pen-fancy"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('dashboard.news.edit', $item->id) }}" class="action-btn edit" title="सम्पादन">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('dashboard.news.destroy', $item->id) }}" method="POST" style="display:inline" onsubmit="return confirm('के तपाईं यो समाचार मेटाउन चाहनुहुन्छ?')">
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
                {{ $news->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-newspaper"></i>
                <h3>कुनै समाचार छैन</h3>
                <p>तपाईंसँग अहिलेसम्म कुनै समाचार छैन। पहिलो समाचार सिर्जना गर्नुहोस्।</p>
                <a href="{{ route('dashboard.news.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> पहिलो समाचार सिर्जना गर्नुहोस्
                </a>
            </div>
        @endif
    </div>
</div>

<script>
function filterTable() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    const statusFilter = document.getElementById('filterStatus').value;
    const categoryFilter = document.getElementById('filterCategory').value;
    const rows = document.querySelectorAll('#newsTable tbody tr');
    rows.forEach(row => {
        const title = row.querySelector('.news-title')?.textContent?.toLowerCase() || '';
        const author = row.cells[3]?.textContent?.toLowerCase() || '';
        const category = row.cells[2]?.textContent?.toLowerCase().trim() || '';
        const statusEl = row.querySelector('.status-badge');
        const status = statusEl?.classList.contains('published') ? 'published' : 'draft';
        const matchesSearch = title.includes(input) || author.includes(input);
        const matchesStatus = statusFilter === 'all' || status === statusFilter;
        const matchesCategory = categoryFilter === 'all' || category === categoryFilter;
        row.style.display = matchesSearch && matchesStatus && matchesCategory ? '' : 'none';
    });
}
setTimeout(() => { document.querySelectorAll('.alert').forEach(el => el.remove()); }, 5000);
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
.search-box { display: flex; align-items: center; background: #f8f9fa; border-radius: 10px; padding: 0 16px; border: 2px solid #e9ecef; transition: border-color 0.2s; }
.search-box:focus-within { border-color: #CD2737; background: white; }
.search-box i { color: #6c757d; margin-right: 10px; }
.search-box input { border: none; background: transparent; padding: 12px 0; font-size: 14px; font-family: 'Noto Sans Devanagari', sans-serif; min-width: 250px; outline: none; }
.filter-group { display: flex; gap: 10px; flex-wrap: wrap; }
.filter-group select { padding: 10px 14px; border: 2px solid #e9ecef; border-radius: 10px; font-size: 14px; font-family: 'Noto Sans Devanagari', sans-serif; background: #f8f9fa; color: #333; cursor: pointer; outline: none; transition: border-color 0.2s; }
.filter-group select:focus { border-color: #CD2737; background: white; }
.table-responsive { overflow-x: auto; }
.data-table { width: 100%; border-collapse: collapse; }
.data-table th { text-align: left; padding: 14px 16px; font-size: 12px; font-weight: 600; color: #6c757d; text-transform: uppercase; letter-spacing: 0.5px; background: #fafafa; border-bottom: 1px solid #f0f0f0; white-space: nowrap; }
.data-table td { padding: 16px; border-bottom: 1px solid #f8f9fa; font-size: 14px; color: #333; vertical-align: middle; }
.data-table tr:hover td { background: #fafafa; }
.id-cell { color: #6c757d; font-weight: 500; }
.title-cell { min-width: 200px; }
.news-title { font-weight: 500; color: #1a1a2e; }
.priority-badge { display: inline-block; font-size: 10px; padding: 2px 8px; border-radius: 10px; margin-left: 6px; font-weight: 600; }
.priority-badge.urgent { background: #fce4e4; color: #CD2737; }
.priority-badge.high { background: #fff3e0; color: #f39c12; }
.category-tag { background: #f0f0f0; padding: 4px 12px; border-radius: 12px; font-size: 12px; color: #555; white-space: nowrap; }
.priority-dot { display: inline-block; width: 10px; height: 10px; border-radius: 50%; }
.priority-dot.normal { background: #6c757d; }
.priority-dot.high { background: #f39c12; }
.priority-dot.urgent { background: #CD2737; }
.status-badge { padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 600; }
.status-badge.published { background: #e8f5e9; color: #28a745; }
.status-badge.draft { background: #fff8e1; color: #f39c12; }
.date-cell { color: #6c757d; font-size: 13px; white-space: nowrap; }
.actions-cell { white-space: nowrap; }
.action-btns { display: flex; gap: 6px; }
.action-btn { width: 36px; height: 36px; border: none; border-radius: 8px; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; font-size: 14px; transition: all 0.2s; text-decoration: none; }
.action-btn.edit { background: #e3f2fd; color: #1976d2; }
.action-btn.edit:hover { background: #1976d2; color: white; }
.action-btn.delete { background: #fce4ec; color: #CD2737; }
.action-btn.delete:hover { background: #CD2737; color: white; }
.action-btn.publish { background: #e8f5e9; color: #28a745; }
.action-btn.publish:hover { background: #28a745; color: white; }
.action-btn.unpublish { background: #fff8e1; color: #f39c12; }
.action-btn.unpublish:hover { background: #f39c12; color: white; }
.pagination-wrapper { padding: 16px 24px; border-top: 1px solid #f0f0f0; }
.empty-state { text-align: center; padding: 60px 20px; color: #6c757d; }
.empty-state i { font-size: 56px; color: #dee2e6; margin-bottom: 16px; }
.empty-state h3 { font-size: 20px; color: #1a1a2e; margin-bottom: 8px; }
.btn { padding: 14px 28px; border: none; border-radius: 10px; font-size: 15px; font-weight: 600; cursor: pointer; transition: all 0.3s; font-family: 'Noto Sans Devanagari', sans-serif; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; }
.btn-primary { background: #CD2737; color: white; box-shadow: 0 4px 15px rgba(205,39,55,0.3); }
.btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(205,39,55,0.4); }
@media (max-width: 768px) { .dashboard-content { padding: 20px; } .list-toolbar { flex-direction: column; align-items: stretch; } .search-box input { min-width: auto; width: 100%; } }
</style>
@endsection
