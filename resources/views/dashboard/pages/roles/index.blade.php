@extends('layouts.dashboard')
@section('title', 'भूमिका व्यवस्थापन - News AI')
@section('content')
<div class="dashboard-content">
    <div class="page-header">
        <div class="header-top">
            <div>
                <h1 class="page-title">भूमिका व्यवस्थापन</h1>
                <p class="page-subtitle">भूमिका र अनुमतिहरू व्यवस्थापन गर्नुहोस्</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('dashboard.roles.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> नयाँ भूमिका
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

    <div class="roles-grid">
        @foreach($roles as $role)
        <div class="role-card">
            <div class="role-header">
                <h3>{{ $role->name }}</h3>
                <code>{{ $role->slug }}</code>
            </div>
            @if($role->description)
                <p class="role-desc">{{ $role->description }}</p>
            @endif
            <div class="role-stats">
                <div class="stat">
                    <span class="stat-value">{{ $role->users_count }}</span>
                    <span class="stat-label">प्रयोगकर्ता</span>
                </div>
                <div class="stat">
                    <span class="stat-value">{{ $role->permissions_count }}</span>
                    <span class="stat-label">अनुमति</span>
                </div>
            </div>
            <div class="role-permissions">
                <strong>अनुमतिहरू:</strong>
                <div class="perm-tags">
                    @forelse($role->permissions as $perm)
                        <span class="perm-tag">{{ $perm->name }}</span>
                    @empty
                        <span class="perm-tag none">कुनै अनुमति छैन</span>
                    @endforelse
                </div>
            </div>
            <div class="role-actions">
                <a href="{{ route('dashboard.roles.edit', $role) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-edit"></i> सम्पादन
                </a>
                @if($role->slug !== 'super-admin')
                <form action="{{ route('dashboard.roles.destroy', $role) }}" method="POST" style="display:inline" onsubmit="return confirm('के तपाईं यो भूमिका मेटाउन चाहनुहुन्छ?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i> मेटाउनुहोस्
                    </button>
                </form>
                @endif
            </div>
        </div>
        @endforeach
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
.roles-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 24px; }
.role-card { background: white; border-radius: 16px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); }
.role-header { margin-bottom: 12px; }
.role-header h3 { font-size: 18px; font-weight: 700; color: #1a1a2e; margin: 0 0 6px 0; }
.role-header code { background: #f0f0f0; padding: 2px 8px; border-radius: 4px; font-size: 13px; color: #6c757d; }
.role-desc { color: #6c757d; font-size: 14px; margin-bottom: 16px; }
.role-stats { display: flex; gap: 20px; margin-bottom: 16px; }
.role-stats .stat { display: flex; flex-direction: column; }
.role-stats .stat-value { font-size: 24px; font-weight: 700; color: #1a1a2e; }
.role-stats .stat-label { font-size: 12px; color: #6c757d; }
.role-permissions { margin-bottom: 16px; }
.role-permissions strong { display: block; font-size: 13px; color: #1a1a2e; margin-bottom: 8px; }
.perm-tags { display: flex; flex-wrap: wrap; gap: 6px; }
.perm-tag { background: #e3f2fd; color: #1976d2; padding: 4px 10px; border-radius: 8px; font-size: 12px; }
.perm-tag.none { background: #f0f0f0; color: #6c757d; }
.role-actions { display: flex; gap: 8px; padding-top: 16px; border-top: 1px solid #f0f0f0; }
.btn { padding: 14px 28px; border: none; border-radius: 10px; font-size: 15px; font-weight: 600; cursor: pointer; transition: all 0.3s; font-family: 'Noto Sans Devanagari', sans-serif; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; }
.btn-sm { padding: 8px 16px; font-size: 13px; }
.btn-primary { background: #CD2737; color: white; }
.btn-primary:hover { background: #b3202e; }
.btn-danger { background: #fce4ec; color: #CD2737; }
.btn-danger:hover { background: #CD2737; color: white; }
</style>
@endsection
