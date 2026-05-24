@extends('layouts.app')
@section('title', 'समाचार अपलोड')
@section('content')
    <main class="main-content">
        <section class="page-header">
            <div class="container">
                <h1>समाचार अपलोड</h1>
                <p>तपाईंको समाचार साझा गर्नुहोस्</p>
            </div>
        </section>

        <section class="upload-section">
            <div class="container">
                <div class="upload-container">
                    @auth
                        <form class="upload-form" action="{{ route('dashboard.news.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">समाचारको शीर्षक *</label>
                                <input type="text" id="title" name="title" required placeholder="समाचारको शीर्षक लेख्नुहोस्">
                            </div>

                            <div class="form-group">
                                <label for="category_id">श्रेणी *</label>
                                <select id="category_id" name="category_id" required>
                                    <option value="">श्रेणी छान्नुहोस्</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="summary">संक्षिप्त विवरण *</label>
                                <textarea id="summary" name="summary" required placeholder="समाचारको संक्षिप्त विवरण लेख्नुहोस्" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="content">समाचारको विस्तृत विवरण *</label>
                                <textarea id="content" name="content" required placeholder="समाचारको विस्तृत विवरण लेख्नुहोस्" rows="10"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="author">लेखकको नाम *</label>
                                <input type="text" id="author" name="author" required placeholder="तपाईंको नाम लेख्नुहोस्" value="{{ auth()->user()->name }}">
                            </div>

                            <div class="form-group">
                                <label for="email">ईमेल *</label>
                                <input type="email" id="email" name="email" required placeholder="तपाईंको ईमेल लेख्नुहोस्" value="{{ auth()->user()->email }}">
                            </div>

                            <div class="form-group">
                                <label for="image">तस्बिर अपलोड गर्नुहोस्</label>
                                <input type="file" id="image" name="image" accept="image/*">
                            </div>

                            <div class="form-group">
                                <label for="tags">ट्यागहरू</label>
                                <input type="text" id="tags" name="tags" placeholder="ट्यागहरू अल्पविरामले छुट्याउनुहोस्">
                                <small>उदाहरण: राजनीति, नेपाल, सरकार</small>
                            </div>

                            <div class="form-group">
                                <label for="priority">प्राथमिकता</label>
                                <select id="priority" name="priority">
                                    <option value="normal">सामान्य</option>
                                    <option value="high">उच्च</option>
                                    <option value="urgent">तत्काल</option>
                                </select>
                            </div>

                            <div class="form-group checkbox-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" id="terms" name="terms_accepted" required>
                                    <span>मैले <a href="#" class="terms-link">सर्तहरू र शर्तहरू</a> स्वीकार गर्छु</span>
                                </label>
                            </div>

                            <div class="form-actions">
                                <button type="submit" name="is_draft" value="1" class="btn btn-secondary">ड्राफ्ट सेभ गर्नुहोस्</button>
                                <button type="submit" class="btn btn-primary">समाचार अपलोड गर्नुहोस्</button>
                            </div>
                        </form>
                    @else
                        <div style="text-align: center; padding: 60px 20px;">
                            <i class="fas fa-user-lock" style="font-size: 48px; color: #CD2737; margin-bottom: 16px;"></i>
                            <h3>समाचार अपलोड गर्न लगइन गर्नुहोस्</h3>
                            <p style="color: #6c757d; margin-bottom: 20px;">कृपया पहिले खातामा लगइन गर्नुहोस् वा नयाँ खाता सिर्जना गर्नुहोस्।</p>
                            <a href="{{ route('login') }}" class="btn btn-primary">लगइन गर्नुहोस्</a>
                            <a href="{{ route('register') }}" class="btn btn-secondary">खाता सिर्जना गर्नुहोस्</a>
                        </div>
                    @endauth
                </div>
            </div>
        </section>

        <section class="upload-guidelines">
            <div class="container">
                <h2 class="section-title">अपलोड गाइडलाइनहरू</h2>
                <div class="guidelines-grid">
                    <div class="guideline-card">
                        <i class="fas fa-check-circle"></i>
                        <h3>सामग्रीको गुणस्तर</h3>
                        <p>समाचार सही, प्रमाणित र नयाँ हुनुपर्छ।</p>
                    </div>
                    <div class="guideline-card">
                        <i class="fas fa-language"></i>
                        <h3>भाषा र शैली</h3>
                        <p>समाचार नेपाली भाषामा लेख्नुहोस् र स्पष्ट, सरल शब्दहरू प्रयोग गर्नुहोस्।</p>
                    </div>
                    <div class="guideline-card">
                        <i class="fas fa-image"></i>
                        <h3>तस्बिरहरू</h3>
                        <p>तस्बिरहरू स्पष्ट, उच्च गुणस्तरका र समाचारसँग सम्बन्धित हुनुपर्छ।</p>
                    </div>
                    <div class="guideline-card">
                        <i class="fas fa-shield-alt"></i>
                        <h3>सुरक्षा र नैतिकता</h3>
                        <p>समाचार नैतिक मानदण्डहरूको पालना गर्दै लेख्नुहोस्।</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <style>
    .upload-form { max-width: 700px; margin: 0 auto; }
    .upload-form .form-group { margin-bottom: 20px; }
    .upload-form label { display: block; font-weight: 600; margin-bottom: 6px; color: #1a1a2e; font-size: 14px; }
    .upload-form input, .upload-form select, .upload-form textarea { width: 100%; padding: 12px 16px; border: 2px solid #e9ecef; border-radius: 10px; font-size: 15px; font-family: 'Noto Sans Devanagari', sans-serif; background: #f8f9fa; transition: border-color 0.2s; }
    .upload-form input:focus, .upload-form select:focus, .upload-form textarea:focus { outline: none; border-color: #CD2737; background: white; }
    .upload-form textarea { resize: vertical; min-height: 120px; }
    .upload-form small { font-size: 12px; color: #6c757d; }
    .checkbox-group label { display: flex; align-items: center; gap: 10px; cursor: pointer; }
    .checkbox-group input[type="checkbox"] { width: 18px; height: 18px; accent-color: #CD2737; }
    .form-actions { display: flex; gap: 16px; margin-top: 24px; }
    .btn { padding: 14px 28px; border: none; border-radius: 10px; font-size: 15px; font-weight: 600; cursor: pointer; transition: all 0.3s; font-family: 'Noto Sans Devanagari', sans-serif; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; }
    .btn-primary { background: #CD2737; color: white; }
    .btn-primary:hover { background: #b3202e; }
    .btn-secondary { background: #6c757d; color: white; }
    .btn-secondary:hover { background: #5a6268; }
    .guidelines-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 24px; margin-top: 30px; }
    .guideline-card { background: white; padding: 24px; border-radius: 12px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }
    .guideline-card i { font-size: 32px; color: #CD2737; margin-bottom: 12px; }
    .guideline-card h3 { font-size: 16px; font-weight: 600; margin-bottom: 8px; color: #1a1a2e; }
    .guideline-card p { font-size: 14px; color: #6c757d; margin: 0; }
    </style>
@endsection
