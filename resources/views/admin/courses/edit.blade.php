@extends('layouts.admin')

@section('title', 'تعديل الدورة - لوحة الإدارة')

@section('content')
<div class="content-area">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="card-title">تعديل الدورة: {{ $course->title_ar }}</h2>
                <a href="{{ route('admin.courses') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-right"></i>
                    العودة للدورات
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <form method="POST" action="{{ route('admin.courses.update', $course) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <!-- المعلومات الأساسية -->
                    <div class="col-lg-8">
                        <div class="mb-4">
                            <h5>المعلومات الأساسية</h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="title_ar" class="form-label">عنوان الدورة (عربي) *</label>
                                    <input type="text" class="form-control @error('title_ar') is-invalid @enderror" 
                                           id="title_ar" name="title_ar" value="{{ old('title_ar', $course->title_ar) }}" required>
                                    @error('title_ar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="title_en" class="form-label">عنوان الدورة (إنجليزي)</label>
                                    <input type="text" class="form-control @error('title_en') is-invalid @enderror" 
                                           id="title_en" name="title_en" value="{{ old('title_en', $course->title_en) }}">
                                    @error('title_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="description_ar" class="form-label">وصف الدورة (عربي) *</label>
                                <textarea class="form-control @error('description_ar') is-invalid @enderror" 
                                          id="description_ar" name="description_ar" rows="4" required>{{ old('description_ar', $course->description_ar) }}</textarea>
                                @error('description_ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="description_en" class="form-label">وصف الدورة (إنجليزي)</label>
                                <textarea class="form-control @error('description_en') is-invalid @enderror" 
                                          id="description_en" name="description_en" rows="4">{{ old('description_en', $course->description_en) }}</textarea>
                                @error('description_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- إعدادات الدورة -->
                        <div class="mb-4">
                            <h5>إعدادات الدورة</h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="category_id" class="form-label">القسم *</label>
                                    <select class="form-select @error('category_id') is-invalid @enderror" 
                                            id="category_id" name="category_id" required>
                                        <option value="">اختر القسم</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name_ar }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="instructor_id" class="form-label">المدرب *</label>
                                    <select class="form-select @error('instructor_id') is-invalid @enderror" 
                                            id="instructor_id" name="instructor_id" required>
                                        <option value="">اختر المدرب</option>
                                        @foreach($instructors as $instructor)
                                            <option value="{{ $instructor->id }}" 
                                                {{ old('instructor_id', $course->instructor_id) == $instructor->id ? 'selected' : '' }}>
                                                {{ $instructor->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('instructor_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="price" class="form-label">السعر (ريال) *</label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                           id="price" name="price" value="{{ old('price', $course->price) }}" min="0" step="0.01" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="duration" class="form-label">المدة (ساعات) *</label>
                                    <input type="number" class="form-control @error('duration') is-invalid @enderror" 
                                           id="duration" name="duration" value="{{ old('duration', $course->duration) }}" min="1" required>
                                    @error('duration')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="level" class="form-label">المستوى *</label>
                                    <select class="form-select @error('level') is-invalid @enderror" 
                                            id="level" name="level" required>
                                        <option value="">اختر المستوى</option>
                                        <option value="beginner" {{ old('level', $course->level) == 'beginner' ? 'selected' : '' }}>مبتدئ</option>
                                        <option value="intermediate" {{ old('level', $course->level) == 'intermediate' ? 'selected' : '' }}>متوسط</option>
                                        <option value="advanced" {{ old('level', $course->level) == 'advanced' ? 'selected' : '' }}>متقدم</option>
                                    </select>
                                    @error('level')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">الحالة *</label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" name="status" required>
                                        <option value="">اختر الحالة</option>
                                        <option value="draft" {{ old('status', $course->status) == 'draft' ? 'selected' : '' }}>مسودة</option>
                                        <option value="published" {{ old('status', $course->status) == 'published' ? 'selected' : '' }}>منشور</option>
                                        <option value="archived" {{ old('status', $course->status) == 'archived' ? 'selected' : '' }}>مؤرشف</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="video_intro" class="form-label">رابط الفيديو التعريفي</label>
                                    <input type="url" class="form-control @error('video_intro') is-invalid @enderror" 
                                           id="video_intro" name="video_intro" value="{{ old('video_intro', $course->video_intro) }}" 
                                           placeholder="https://www.youtube.com/watch?v=...">
                                    @error('video_intro')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- الصورة والتحكم -->
                    <div class="col-lg-4">
                        <div class="mb-4">
                            <h5>صورة الدورة</h5>
                            
                            @if($course->thumbnail)
                                <div class="mb-3">
                                    <label class="form-label">الصورة الحالية</label>
                                    <img src="{{ asset('storage/' . $course->thumbnail) }}" 
                                         alt="{{ $course->title_ar }}" class="img-fluid rounded mb-2" style="max-height: 150px;">
                                </div>
                            @endif
                            
                            <div class="mb-3">
                                <label for="thumbnail" class="form-label">تغيير الصورة</label>
                                <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" 
                                       id="thumbnail" name="thumbnail" accept="image/*">
                                <div class="form-text">الأبعاد الموصى بها: 800×600 بكسل</div>
                                @error('thumbnail')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div id="thumbnail-preview" class="text-center" style="display: none;">
                                <img id="preview-image" src="" alt="معاينة الصورة" 
                                     class="img-fluid rounded" style="max-height: 200px;">
                            </div>
                        </div>
                        
                        <!-- إحصائيات الدورة -->
                        <div class="mb-4">
                            <h5>إحصائيات الدورة</h5>
                            <div class="row text-center">
                                <div class="col-6">
                                    <div class="bg-light rounded p-3">
                                        <h6 class="mb-1">{{ $course->lessons()->count() }}</h6>
                                        <small class="text-muted">الدروس</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-light rounded p-3">
                                        <h6 class="mb-1">{{ $course->enrollments()->count() }}</h6>
                                        <small class="text-muted">التسجيلات</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg"></i>
                                حفظ التغييرات
                            </button>
                            <a href="{{ route('admin.courses') }}" class="btn btn-secondary">
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
document.getElementById('thumbnail').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-image').src = e.target.result;
            document.getElementById('thumbnail-preview').style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        document.getElementById('thumbnail-preview').style.display = 'none';
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
</style>
@endsection 