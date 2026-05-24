@extends('layouts.dashboard')
@section('title', 'भूमिका सम्पादन - News AI')
@section('content')
<div class="dashboard-content">
    <div class="page-header">
        <div class="header-top">
            <div>
                <h1 class="page-title">भूमिका सम्पादन</h1>
                <p class="page-subtitle">{{ $role->name }}</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('dashboard.roles.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> फिर्ता जानुहोस्
                </a>
            </div>
        </div>
    </div>

    <div class="form-card">
        <form action="{{ route('dashboard.roles.update', $role) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-grid">
                <div class="form-group">
                    <label for="name">नाम <span class="required">*</span></label>
                    <input type="text" id="name" name="name" required value="{{ old('name', $role->name) }}">
                    @error('name') <span class="field-error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="slug">स्लग <span class="required">*</span></label>
                    <input type="text" id="slug" name="slug" required value="{{ old('slug', $role->slug) }}">
                    @error('slug') <span class="field-error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group full-width">
                    <label for="description">विवरण</label>
                    <textarea id="description" name="description" rows="2">{{ old('description', $role->description) }}</textarea>
                </div>
                <div class="form-group full-width">
                    <label>अनुमतिहरू</label>
                    <div class="permissions-grid">
                        @foreach($permissions as $perm)
                        <label class="perm-checkbox">
                            <input type="checkbox" name="permissions[]" value="{{ $perm->id }}"
                                {{ in_array($perm->id, old('permissions', $rolePermissions)) ? 'checked' : '' }}>
                            <span>{{ $perm->name }}</span>
                            <small>{{ $perm->slug }}</small>
                        </label>
                        @endforeach
                    </div>
                </div>
                <div class="form-actions full-width">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> अद्यावधिक गर्नुहोस्
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<style>
.dashboard-content { padding: 30px; }
.page-header { margin-bottom: 30px; }
.header-top { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px; }
.page-title { font-size: 28px; font-weight: 700; color: #1a1a2e; margin: 0; }
.page-subtitle { color: #6c757d; margin: 5px 0 0 0; font-size: 15px; }
.form-card { background: white; border-radius: 16px; padding: 40px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); }
.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
.form-group.full-width { grid-column: 1 / -1; }
.form-group { display: flex; flex-direction: column; gap: 8px; }
.form-group label { font-weight: 600; color: #1a1a2e; font-size: 14px; }
.form-group .required { color: #CD2737; }
.form-group input, .form-group select, .form-group textarea { padding: 12px 16px; border: 2px solid #e9ecef; border-radius: 10px; font-size: 15px; font-family: "Noto Sans Devanagari", sans-serif; background: #f8f9fa; transition: border-color 0.2s; }
.form-group input:focus, .form-group select:focus, .form-group textarea:focus { outline: none; border-color: #CD2737; background: white; }
.permissions-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 10px; }
.perm-checkbox { display: flex; align-items: center; gap: 8px; padding: 10px 14px; border: 1px solid #e9ecef; border-radius: 8px; cursor: pointer; transition: all 0.2s; }
.perm-checkbox:hover { border-color: #CD2737; background: #fff5f5; }
.perm-checkbox input { width: 18px; height: 18px; accent-color: #CD2737; }
.perm-checkbox span { font-size: 14px; font-weight: 500; color: #333; }
.perm-checkbox small { font-size: 11px; color: #6c757d; margin-left: auto; }
.form-actions { display: flex; gap: 16px; padding-top: 8px; }
.btn { padding: 14px 28px; border: none; border-radius: 10px; font-size: 15px; font-weight: 600; cursor: pointer; transition: all 0.3s; font-family: "Noto Sans Devanagari", sans-serif; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; }
.btn-primary { background: #CD2737; color: white; box-shadow: 0 4px 15px rgba(205,39,55,0.3); }
.btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(205,39,55,0.4); }
.btn-secondary { background: #6c757d; color: white; }
.btn-secondary:hover { background: #5a6268; transform: translateY(-2px); }
</style>
@endsection
