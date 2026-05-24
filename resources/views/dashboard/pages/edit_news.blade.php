@extends('layouts.dashboard')
@section('title', 'समाचार सम्पादन - News AI')
@section('content')
<div class="dashboard-content">
    <div class="page-header">
        <div class="header-top">
            <div>
                <h1 class="page-title">समाचार सम्पादन</h1>
                <p class="page-subtitle">समाचार विवरण सम्पादन गर्नुहोस्</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('dashboard.news.list') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> फिर्ता जानुहोस्
                </a>
            </div>
        </div>
    </div>

    <div class="form-card">
        <form action="{{ route('dashboard.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="title">समाचारको शीर्षक <span class="required">*</span></label>
                    <input type="text" id="title" name="title" required value="{{ old('title', $news->title) }}">
                    @error('title') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="category_id">श्रेणी <span class="required">*</span></label>
                    <select id="category_id" name="category_id" required>
                        <option value="">श्रेणी छान्नुहोस्</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $news->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="priority">प्राथमिकता</label>
                    <select id="priority" name="priority">
                        <option value="normal" {{ old('priority', $news->priority) == 'normal' ? 'selected' : '' }}>सामान्य</option>
                        <option value="high" {{ old('priority', $news->priority) == 'high' ? 'selected' : '' }}>उच्च</option>
                        <option value="urgent" {{ old('priority', $news->priority) == 'urgent' ? 'selected' : '' }}>तत्काल</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="author">लेखकको नाम <span class="required">*</span></label>
                    <input type="text" id="author" name="author" required value="{{ old('author', $news->author) }}">
                    @error('author') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="email">ईमेल <span class="required">*</span></label>
                    <input type="email" id="email" name="email" required value="{{ old('email', $news->email) }}">
                    @error('email') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="tags">ट्यागहरू</label>
                    <input type="text" id="tags" name="tags" value="{{ old('tags', $news->tags->pluck('name')->implode(', ')) }}">
                    <small class="hint">ट्यागहरू अल्पविरामले छुट्याउनुहोस्</small>
                </div>

                <div class="form-group full-width">
                    <label for="summary">संक्षिप्त विवरण <span class="required">*</span></label>
                    <textarea id="summary" name="summary" required rows="3">{{ old('summary', $news->summary) }}</textarea>
                    @error('summary') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group full-width">
                    <label for="content">समाचारको विस्तृत विवरण <span class="required">*</span></label>
                    <textarea id="content" name="content" required rows="12">{{ old('content', $news->content) }}</textarea>
                    @error('content') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group full-width">
                    <label for="image">तस्बिर</label>
                    <input type="file" id="image" name="image" accept="image/*">
                    @if($news->image)
                        <small>हालको तस्बिर: {{ $news->image }}</small>
                    @endif
                    @error('image') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group checkbox-group full-width">
                    <label class="checkbox-label">
                        <input type="checkbox" id="is_draft" name="is_draft" value="1" {{ old('is_draft', $news->is_draft) ? 'checked' : '' }}>
                        <span>ड्राफ्टको रूपमा सेभ गर्नुहोस्</span>
                    </label>
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
.form-group input, .form-group select, .form-group textarea { padding: 12px 16px; border: 2px solid #e9ecef; border-radius: 10px; font-size: 15px; font-family: 'Noto Sans Devanagari', sans-serif; transition: border-color 0.2s; background: #f8f9fa; }
.form-group input:focus, .form-group select:focus, .form-group textarea:focus { outline: none; border-color: #CD2737; background: white; }
.hint { font-size: 12px; color: #6c757d; }
.field-error { font-size: 13px; color: #CD2737; }
.checkbox-group { display: flex; align-items: flex-start; }
.checkbox-label { display: flex; align-items: center; gap: 10px; cursor: pointer; font-size: 14px; color: #333; }
.checkbox-label input[type="checkbox"] { width: 18px; height: 18px; accent-color: #CD2737; cursor: pointer; }
.form-actions { display: flex; gap: 16px; justify-content: flex-start; padding-top: 8px; }
.btn { padding: 14px 28px; border: none; border-radius: 10px; font-size: 15px; font-weight: 600; cursor: pointer; transition: all 0.3s; font-family: 'Noto Sans Devanagari', sans-serif; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; }
.btn-primary { background: #CD2737; color: white; box-shadow: 0 4px 15px rgba(205, 39, 55, 0.3); }
.btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(205, 39, 55, 0.4); }
.btn-secondary { background: #6c757d; color: white; }
.btn-secondary:hover { background: #5a6268; transform: translateY(-2px); }
@media (max-width: 768px) { .dashboard-content { padding: 20px; } .form-card { padding: 24px; } .form-grid { grid-template-columns: 1fr; } .form-actions { flex-direction: column; } }
</style>
@endsection
