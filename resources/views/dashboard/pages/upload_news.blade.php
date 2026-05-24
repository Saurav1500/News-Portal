@extends('layouts.dashboard')
@section('title', 'नयाँ समाचार - News AI')
@section('content')
<div class="dashboard-content">
    <div class="page-header">
        <div class="header-top">
            <div>
                <h1 class="page-title">नयाँ समाचार</h1>
                <p class="page-subtitle">नयाँ समाचार लेख्नुहोस् र प्रकाशित गर्नुहोस्</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('dashboard.news.list') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> फिर्ता जानुहोस्
                </a>
            </div>
        </div>
    </div>

    <div class="form-card">
        <form action="{{ route('dashboard.news.store') }}" method="POST" enctype="multipart/form-data" id="newsUploadForm">
            @csrf
            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="title">समाचारको शीर्षक <span class="required">*</span></label>
                    <input type="text" id="title" name="title" required placeholder="समाचारको शीर्षक लेख्नुहोस्" value="{{ old('title') }}">
                    @error('title') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="category_id">श्रेणी <span class="required">*</span></label>
                    <select id="category_id" name="category_id" required>
                        <option value="">श्रेणी छान्नुहोस्</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="priority">प्राथमिकता</label>
                    <select id="priority" name="priority">
                        <option value="normal" {{ old('priority') == 'normal' ? 'selected' : '' }}>सामान्य</option>
                        <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>उच्च</option>
                        <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>तत्काल</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="author">लेखकको नाम <span class="required">*</span></label>
                    <input type="text" id="author" name="author" required placeholder="लेखकको नाम" value="{{ old('author', auth()->user()->name) }}">
                    @error('author') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="email">ईमेल <span class="required">*</span></label>
                    <input type="email" id="email" name="email" required placeholder="ईमेल ठेगाना" value="{{ old('email', auth()->user()->email) }}">
                    @error('email') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="tags">ट्यागहरू</label>
                    <input type="text" id="tags" name="tags" placeholder="ट्यागहरू अल्पविरामले छुट्याउनुहोस्" value="{{ old('tags') }}">
                    <small class="hint">उदाहरण: राजनीति, नेपाल, सरकार</small>
                </div>

                <div class="form-group full-width">
                    <label for="summary">संक्षिप्त विवरण <span class="required">*</span></label>
                    <textarea id="summary" name="summary" required placeholder="समाचारको संक्षिप्त विवरण लेख्नुहोस्" rows="3">{{ old('summary') }}</textarea>
                    @error('summary') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group full-width">
                    <label for="content">समाचारको विस्तृत विवरण <span class="required">*</span></label>
                    <textarea id="content" name="content" required placeholder="समाचारको विस्तृत विवरण लेख्नुहोस्" rows="12">{{ old('content') }}</textarea>
                    @error('content') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group full-width">
                    <label for="image">तस्बिर अपलोड गर्नुहोस्</label>
                    <div class="file-upload-area">
                        <input type="file" id="image" name="image" accept="image/*" hidden>
                        <div class="file-upload-label" id="fileUploadLabel">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <div class="file-upload-text">
                                <span class="main-text">तस्बिर छान्नुहोस्</span>
                                <span class="sub-text">वा ड्र्याग गरेर छोड्नुहोस्</span>
                            </div>
                            <span class="file-name"></span>
                        </div>
                    </div>
                    @error('image') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group checkbox-group full-width">
                    <label class="checkbox-label">
                        <input type="checkbox" id="terms" name="terms_accepted" required>
                        <span class="checkmark"></span>
                        <span>मैले <a href="#" class="terms-link">सर्तहरू र शर्तहरू</a> स्वीकार गर्छु <span class="required">*</span></span>
                    </label>
                </div>

                <div class="form-actions full-width">
                    <button type="submit" name="is_draft" value="1" class="btn btn-secondary">
                        <i class="fas fa-save"></i> ड्राफ्ट सेभ गर्नुहोस्
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-upload"></i> समाचार अपलोड गर्नुहोस्
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('image');
    const fileLabel = document.getElementById('fileUploadLabel');
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const fileName = fileLabel.querySelector('.file-name');
            const mainText = fileLabel.querySelector('.main-text');
            const subText = fileLabel.querySelector('.sub-text');
            fileName.textContent = file.name;
            mainText.textContent = 'तस्बिर चयन भयो';
            subText.textContent = '';
            fileLabel.classList.add('has-file');
        }
    });
    fileLabel.addEventListener('click', function() { fileInput.click(); });
    fileLabel.addEventListener('dragover', function(e) { e.preventDefault(); this.classList.add('drag-over'); });
    fileLabel.addEventListener('dragleave', function(e) { e.preventDefault(); this.classList.remove('drag-over'); });
    fileLabel.addEventListener('drop', function(e) {
        e.preventDefault(); this.classList.remove('drag-over');
        const files = e.dataTransfer.files;
        if (files.length > 0) { fileInput.files = files; fileInput.dispatchEvent(new Event('change', { bubbles: true })); }
    });
});
</script>

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
.form-group input, .form-group select, .form-group textarea { padding: 12px 16px; border: 2px solid #e9ecef; border-radius: 10px; font-size: 15px; font-family: 'Noto Sans Devanagari', sans-serif; transition: border-color 0.2s, box-shadow 0.2s; background: #f8f9fa; }
.form-group input:focus, .form-group select:focus, .form-group textarea:focus { outline: none; border-color: #CD2737; background: white; box-shadow: 0 0 0 3px rgba(205, 39, 55, 0.1); }
.hint { font-size: 12px; color: #6c757d; }
.field-error { font-size: 13px; color: #CD2737; }
.file-upload-area { position: relative; }
.file-upload-area input[type="file"] { display: none; }
.file-upload-label { display: flex; align-items: center; gap: 16px; padding: 24px 20px; border: 2px dashed #dee2e6; border-radius: 12px; background: #fafafa; cursor: pointer; transition: all 0.3s; }
.file-upload-label:hover { border-color: #CD2737; background: #fff5f5; }
.file-upload-label.drag-over { border-color: #CD2737; background: #fff0f0; }
.file-upload-label.has-file { border-color: #28a745; background: #f0fff4; border-style: solid; }
.file-upload-label i { font-size: 32px; color: #CD2737; }
.file-upload-text { display: flex; flex-direction: column; }
.file-upload-text .main-text { font-size: 15px; font-weight: 500; color: #1a1a2e; }
.file-upload-text .sub-text { font-size: 13px; color: #6c757d; }
.file-name { margin-left: auto; font-size: 13px; color: #28a745; font-weight: 500; }
.checkbox-group { display: flex; align-items: flex-start; }
.checkbox-label { display: flex; align-items: center; gap: 10px; cursor: pointer; font-size: 14px; color: #333; }
.checkbox-label input[type="checkbox"] { width: 18px; height: 18px; accent-color: #CD2737; cursor: pointer; }
.terms-link { color: #CD2737; text-decoration: none; font-weight: 500; }
.terms-link:hover { text-decoration: underline; }
.form-actions { display: flex; gap: 16px; justify-content: flex-start; padding-top: 8px; }
.btn { padding: 14px 28px; border: none; border-radius: 10px; font-size: 15px; font-weight: 600; cursor: pointer; transition: all 0.3s; font-family: 'Noto Sans Devanagari', sans-serif; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; }
.btn-primary { background: #CD2737; color: white; box-shadow: 0 4px 15px rgba(205, 39, 55, 0.3); }
.btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(205, 39, 55, 0.4); }
.btn-secondary { background: #6c757d; color: white; }
.btn-secondary:hover { background: #5a6268; transform: translateY(-2px); }
@media (max-width: 768px) { .dashboard-content { padding: 20px; } .form-card { padding: 24px; } .form-grid { grid-template-columns: 1fr; } .form-actions { flex-direction: column; } }
</style>
@endsection
