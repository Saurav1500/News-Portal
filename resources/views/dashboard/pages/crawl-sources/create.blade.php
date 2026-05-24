@extends('layouts.dashboard')
@section('title', 'नयाँ क्रल स्रोत - News AI')
@section('content')
<div class="dashboard-content">
    <div class="page-header">
        <div class="header-top">
            <div>
                <h1 class="page-title">नयाँ क्रल स्रोत</h1>
                <p class="page-subtitle">नयाँ वेबसाइट स्रोत थप्नुहोस्</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('dashboard.crawl-sources.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> फिर्ता जानुहोस्
                </a>
            </div>
        </div>
    </div>

    <div class="form-card">
        <form action="{{ route('dashboard.crawl-sources.store') }}" method="POST">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label for="name">स्रोतको नाम <span class="required">*</span></label>
                    <input type="text" id="name" name="name" required value="{{ old('name') }}" placeholder="जस्तै: सेतोपाटी - राजनीति">
                    @error('name') <span class="field-error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="url">URL <span class="required">*</span></label>
                    <input type="url" id="url" name="url" required value="{{ old('url') }}" placeholder="https://www.example.com/category">
                    @error('url') <span class="field-error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="category_id">श्रेणी</label>
                    <select id="category_id" name="category_id">
                        <option value="">श्रेणी छान्नुहोस्</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="crawl_interval_minutes">क्रल अन्तराल (मिनेट)</label>
                    <input type="number" id="crawl_interval_minutes" name="crawl_interval_minutes" value="{{ old('crawl_interval_minutes', 60) }}" min="5">
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="is_active" value="1" checked>
                        सक्रिय
                    </label>
                </div>
                <div class="form-actions full-width">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> स्रोत सिर्जना गर्नुहोस्
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
.form-group input, .form-group select { padding: 12px 16px; border: 2px solid #e9ecef; border-radius: 10px; font-size: 15px; font-family: "Noto Sans Devanagari", sans-serif; background: #f8f9fa; transition: border-color 0.2s; }
.form-group input:focus, .form-group select:focus { outline: none; border-color: #CD2737; background: white; }
.field-error { font-size: 13px; color: #CD2737; }
.form-actions { display: flex; gap: 16px; padding-top: 8px; }
.btn { padding: 14px 28px; border: none; border-radius: 10px; font-size: 15px; font-weight: 600; cursor: pointer; transition: all 0.3s; font-family: "Noto Sans Devanagari", sans-serif; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; }
.btn-primary { background: #CD2737; color: white; box-shadow: 0 4px 15px rgba(205,39,55,0.3); }
.btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(205,39,55,0.4); }
.btn-secondary { background: #6c757d; color: white; }
.btn-secondary:hover { background: #5a6268; transform: translateY(-2px); }
</style>
@endsection
