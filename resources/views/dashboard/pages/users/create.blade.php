@extends('layouts.dashboard')
@section('title', 'नयाँ प्रयोगकर्ता - News AI')
@section('content')
<div class="dashboard-content">
    <div class="page-header">
        <div class="header-top">
            <div>
                <h1 class="page-title">नयाँ प्रयोगकर्ता</h1>
                <p class="page-subtitle">नयाँ प्रयोगकर्ता सिर्जना गर्नुहोस्</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('dashboard.users.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> फिर्ता जानुहोस्
                </a>
            </div>
        </div>
    </div>

    <div class="form-card">
        <form action="{{ route('dashboard.users.store') }}" method="POST">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label for="name">नाम <span class="required">*</span></label>
                    <input type="text" id="name" name="name" required value="{{ old('name') }}">
                    @error('name') <span class="field-error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="email">ईमेल <span class="required">*</span></label>
                    <input type="email" id="email" name="email" required value="{{ old('email') }}">
                    @error('email') <span class="field-error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="password">पासवर्ड <span class="required">*</span></label>
                    <input type="password" id="password" name="password" required minlength="8">
                    @error('password') <span class="field-error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">पासवर्ड पुष्टि <span class="required">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>
                <div class="form-group">
                    <label for="role_id">भूमिका</label>
                    <select id="role_id" name="role_id">
                        <option value="">भूमिका छान्नुहोस्</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-actions full-width">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> प्रयोगकर्ता सिर्जना गर्नुहोस्
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
.form-group input, .form-group select { padding: 12px 16px; border: 2px solid #e9ecef; border-radius: 10px; font-size: 15px; font-family: 'Noto Sans Devanagari', sans-serif; background: #f8f9fa; transition: border-color 0.2s; }
.form-group input:focus, .form-group select:focus { outline: none; border-color: #CD2737; background: white; }
.field-error { font-size: 13px; color: #CD2737; }
.form-actions { display: flex; gap: 16px; padding-top: 8px; }
.btn { padding: 14px 28px; border: none; border-radius: 10px; font-size: 15px; font-weight: 600; cursor: pointer; transition: all 0.3s; font-family: 'Noto Sans Devanagari', sans-serif; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; }
.btn-primary { background: #CD2737; color: white; box-shadow: 0 4px 15px rgba(205,39,55,0.3); }
.btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(205,39,55,0.4); }
.btn-secondary { background: #6c757d; color: white; }
.btn-secondary:hover { background: #5a6268; transform: translateY(-2px); }
</style>
@endsection
