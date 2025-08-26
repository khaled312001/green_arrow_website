@extends('layouts.admin')

@section('title', 'إضافة مقال جديد - لوحة الإدارة')

@section('content')
<div class="content-area">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="card-title">إضافة مقال جديد</h2>
                <a href="{{ route('admin.blog') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-right"></i>
                    العودة للمدونة
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <form method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="title_ar" class="form-label">عنوان المقال بالعربية *</label>
                            <input type="text" class="form-control @error('title_ar') is-invalid @enderror" 
                                   id="title_ar" name="title_ar" value="{{ old('title_ar') }}" required>
                            @error('title_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="status" class="form-label">حالة المقال *</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">اختر الحالة</option>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>مسودة</option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>منشور</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="title_en" class="form-label">عنوان المقال بالإنجليزية</label>
                    <input type="text" class="form-control @error('title_en') is-invalid @enderror" 
                           id="title_en" name="title_en" value="{{ old('title_en') }}">
                    @error('title_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="excerpt_ar" class="form-label">ملخص المقال بالعربية</label>
                            <textarea class="form-control @error('excerpt_ar') is-invalid @enderror" 
                                      id="excerpt_ar" name="excerpt_ar" rows="3">{{ old('excerpt_ar') }}</textarea>
                            <small class="form-text text-muted">ملخص مختصر للمقال يظهر في قائمة المقالات</small>
                            @error('excerpt_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="excerpt_en" class="form-label">ملخص المقال بالإنجليزية</label>
                            <textarea class="form-control @error('excerpt_en') is-invalid @enderror" 
                                      id="excerpt_en" name="excerpt_en" rows="3">{{ old('excerpt_en') }}</textarea>
                            @error('excerpt_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="content_ar" class="form-label">محتوى المقال بالعربية *</label>
                    <textarea class="form-control @error('content_ar') is-invalid @enderror" 
                              id="content_ar" name="content_ar" rows="10" required>{{ old('content_ar') }}</textarea>
                    @error('content_ar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="content_en" class="form-label">محتوى المقال بالإنجليزية</label>
                    <textarea class="form-control @error('content_en') is-invalid @enderror" 
                              id="content_en" name="content_en" rows="10">{{ old('content_en') }}</textarea>
                    @error('content_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="featured_image" class="form-label">الصورة المميزة</label>
                            <input type="file" class="form-control @error('featured_image') is-invalid @enderror" 
                                   id="featured_image" name="featured_image" accept="image/*">
                            <small class="form-text text-muted">الصورة التي ستظهر مع المقال (اختياري)</small>
                            @error('featured_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="meta_title" class="form-label">عنوان SEO</label>
                            <input type="text" class="form-control @error('meta_title') is-invalid @enderror" 
                                   id="meta_title" name="meta_title" value="{{ old('meta_title') }}" maxlength="60">
                            <small class="form-text text-muted">عنوان الصفحة في محركات البحث (أقصى 60 حرف)</small>
                            @error('meta_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="meta_description" class="form-label">وصف SEO</label>
                            <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                                      id="meta_description" name="meta_description" rows="3" maxlength="160">{{ old('meta_description') }}</textarea>
                            <small class="form-text text-muted">وصف الصفحة في محركات البحث (أقصى 160 حرف)</small>
                            @error('meta_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.blog') }}" class="btn btn-secondary">إلغاء</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i>
                        حفظ المقال
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.form-label {
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
}

.form-control, .form-select {
    border-radius: 8px;
    border: 1px solid #d1d5db;
    padding: 0.75rem;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #10b981;
    box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
}

.is-invalid {
    border-color: #dc3545;
}

.invalid-feedback {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary {
    background-color: #10b981;
    border-color: #10b981;
}

.btn-primary:hover {
    background-color: #059669;
    border-color: #059669;
}
</style>
@endsection 