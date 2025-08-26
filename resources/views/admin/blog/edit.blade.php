@extends('layouts.admin')

@section('title', 'تعديل المقال - لوحة الإدارة')

@section('content')
<div class="content-area">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="card-title">تعديل المقال: {{ $post->title_ar }}</h2>
                <a href="{{ route('admin.blog') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-right"></i>
                    العودة للمدونة
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <form method="POST" action="{{ route('admin.blog.update', $post) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <!-- المحتوى الرئيسي -->
                    <div class="col-lg-8">
                        <div class="mb-4">
                            <h5>المحتوى الرئيسي</h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="title_ar" class="form-label">عنوان المقال (عربي) *</label>
                                    <input type="text" class="form-control @error('title_ar') is-invalid @enderror" 
                                           id="title_ar" name="title_ar" value="{{ old('title_ar', $post->title_ar) }}" required>
                                    @error('title_ar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="title_en" class="form-label">عنوان المقال (إنجليزي)</label>
                                    <input type="text" class="form-control @error('title_en') is-invalid @enderror" 
                                           id="title_en" name="title_en" value="{{ old('title_en', $post->title_en) }}">
                                    @error('title_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="excerpt_ar" class="form-label">ملخص المقال (عربي)</label>
                                    <textarea class="form-control @error('excerpt_ar') is-invalid @enderror" 
                                              id="excerpt_ar" name="excerpt_ar" rows="3">{{ old('excerpt_ar', $post->excerpt_ar) }}</textarea>
                                    <div class="form-text">ملخص قصير يظهر في قائمة المقالات</div>
                                    @error('excerpt_ar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="excerpt_en" class="form-label">ملخص المقال (إنجليزي)</label>
                                    <textarea class="form-control @error('excerpt_en') is-invalid @enderror" 
                                              id="excerpt_en" name="excerpt_en" rows="3">{{ old('excerpt_en', $post->excerpt_en) }}</textarea>
                                    @error('excerpt_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="content_ar" class="form-label">محتوى المقال (عربي) *</label>
                                <textarea class="form-control @error('content_ar') is-invalid @enderror" 
                                          id="content_ar" name="content_ar" rows="10" required>{{ old('content_ar', $post->content_ar) }}</textarea>
                                @error('content_ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="content_en" class="form-label">محتوى المقال (إنجليزي)</label>
                                <textarea class="form-control @error('content_en') is-invalid @enderror" 
                                          id="content_en" name="content_en" rows="10">{{ old('content_en', $post->content_en) }}</textarea>
                                @error('content_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- إعدادات المقال -->
                        <div class="mb-4">
                            <h5>إعدادات المقال</h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="category" class="form-label">التصنيف</label>
                                    <input type="text" class="form-control @error('category') is-invalid @enderror" 
                                           id="category" name="category" value="{{ old('category', $post->category) }}" 
                                           placeholder="مثال: تعليم، تقنية، تطوير">
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="tags" class="form-label">العلامات</label>
                                    <input type="text" class="form-control @error('tags') is-invalid @enderror" 
                                           id="tags" name="tags" value="{{ old('tags', $post->tags) }}" 
                                           placeholder="افصل بين العلامات بفواصل">
                                    @error('tags')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="status" class="form-label">الحالة *</label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" name="status" required>
                                        <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>مسودة</option>
                                        <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>منشور</option>
                                        <option value="archived" {{ old('status', $post->status) == 'archived' ? 'selected' : '' }}>مؤرشف</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <div class="form-check mt-4">
                                        <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" 
                                               value="1" {{ old('is_featured', $post->is_featured) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_featured">
                                            مقال مميز
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <div class="form-check mt-4">
                                        <input class="form-check-input" type="checkbox" id="comments_enabled" name="comments_enabled" 
                                               value="1" {{ old('comments_enabled', $post->comments_enabled) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="comments_enabled">
                                            تفعيل التعليقات
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- الصورة والتحكم -->
                    <div class="col-lg-4">
                        <div class="mb-4">
                            <h5>صورة المقال</h5>
                            
                            @if($post->featured_image)
                                <div class="mb-3">
                                    <label class="form-label">الصورة الحالية</label>
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                         alt="{{ $post->title_ar }}" class="img-fluid rounded mb-2" style="max-height: 150px;">
                                </div>
                            @endif
                            
                            <div class="mb-3">
                                <label for="featured_image" class="form-label">تغيير الصورة</label>
                                <input type="file" class="form-control @error('featured_image') is-invalid @enderror" 
                                       id="featured_image" name="featured_image" accept="image/*">
                                <div class="form-text">الأبعاد الموصى بها: 1200×630 بكسل</div>
                                @error('featured_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div id="image-preview" class="text-center" style="display: none;">
                                <img id="preview-image" src="" alt="معاينة الصورة" 
                                     class="img-fluid rounded" style="max-height: 200px;">
                            </div>
                        </div>
                        
                        <!-- إعدادات SEO -->
                        <div class="mb-4">
                            <h5>إعدادات SEO</h5>
                            
                            <div class="mb-3">
                                <label for="meta_title_ar" class="form-label">عنوان Meta (عربي)</label>
                                <input type="text" class="form-control @error('meta_title_ar') is-invalid @enderror" 
                                       id="meta_title_ar" name="meta_title_ar" value="{{ old('meta_title_ar', $post->meta_title_ar) }}">
                                @error('meta_title_ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="meta_title_en" class="form-label">عنوان Meta (إنجليزي)</label>
                                <input type="text" class="form-control @error('meta_title_en') is-invalid @enderror" 
                                       id="meta_title_en" name="meta_title_en" value="{{ old('meta_title_en', $post->meta_title_en) }}">
                                @error('meta_title_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="meta_description_ar" class="form-label">وصف Meta (عربي)</label>
                                <textarea class="form-control @error('meta_description_ar') is-invalid @enderror" 
                                          id="meta_description_ar" name="meta_description_ar" rows="3">{{ old('meta_description_ar', $post->meta_description_ar) }}</textarea>
                                @error('meta_description_ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="meta_description_en" class="form-label">وصف Meta (إنجليزي)</label>
                                <textarea class="form-control @error('meta_description_en') is-invalid @enderror" 
                                          id="meta_description_en" name="meta_description_en" rows="3">{{ old('meta_description_en', $post->meta_description_en) }}</textarea>
                                @error('meta_description_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="meta_keywords_ar" class="form-label">كلمات مفتاحية (عربي)</label>
                                <input type="text" class="form-control @error('meta_keywords_ar') is-invalid @enderror" 
                                       id="meta_keywords_ar" name="meta_keywords_ar" value="{{ old('meta_keywords_ar', $post->meta_keywords_ar) }}">
                                @error('meta_keywords_ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="meta_keywords_en" class="form-label">كلمات مفتاحية (إنجليزي)</label>
                                <input type="text" class="form-control @error('meta_keywords_en') is-invalid @enderror" 
                                       id="meta_keywords_en" name="meta_keywords_en" value="{{ old('meta_keywords_en', $post->meta_keywords_en) }}">
                                @error('meta_keywords_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- إحصائيات المقال -->
                        <div class="mb-4">
                            <h5>إحصائيات المقال</h5>
                            <div class="row text-center">
                                <div class="col-4">
                                    <div class="bg-light rounded p-2">
                                        <h6 class="mb-1">{{ $post->views_count }}</h6>
                                        <small class="text-muted">المشاهدات</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="bg-light rounded p-2">
                                        <h6 class="mb-1">{{ $post->likes_count }}</h6>
                                        <small class="text-muted">الإعجابات</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="bg-light rounded p-2">
                                        <h6 class="mb-1">{{ $post->shares_count }}</h6>
                                        <small class="text-muted">المشاركات</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg"></i>
                                حفظ التغييرات
                            </button>
                            <a href="{{ route('admin.blog') }}" class="btn btn-secondary">
                                <i class="bi bi-x-lg"></i>
                                إلغاء
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// معاينة الصورة
document.getElementById('featured_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-image').src = e.target.result;
            document.getElementById('image-preview').style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        document.getElementById('image-preview').style.display = 'none';
    }
});

// التحقق من صحة النموذج
document.querySelector('form').addEventListener('submit', function(e) {
    const requiredFields = this.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            field.classList.add('is-invalid');
            isValid = false;
        } else {
            field.classList.remove('is-invalid');
        }
    });
    
    if (!isValid) {
        e.preventDefault();
        alert('يرجى ملء جميع الحقول المطلوبة');
    }
});

// معالجة العلامات
document.getElementById('tags').addEventListener('input', function(e) {
    // إزالة المسافات الزائدة
    this.value = this.value.replace(/\s+/g, ' ').trim();
});
</script>

<style>
.form-control, .form-select {
    border-radius: 8px;
    border: 1px solid #d1d5db;
    padding: 0.5rem 0.75rem;
}

.form-control:focus, .form-select:focus {
    border-color: #10b981;
    box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
}

.btn {
    border-radius: 8px;
    font-weight: 500;
}

.card {
    border: none;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
}

.card-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
}

h5 {
    color: #5a5c69;
    font-weight: 600;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e3e6f0;
}

.form-text {
    font-size: 0.875rem;
    color: #6c757d;
}

.invalid-feedback {
    font-size: 0.875rem;
}

.bg-light {
    background-color: #f8f9fa !important;
}

.form-check-input:checked {
    background-color: #10b981;
    border-color: #10b981;
}
</style>
@endsection 