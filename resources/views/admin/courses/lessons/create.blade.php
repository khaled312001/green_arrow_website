@extends('layouts.admin')

@section('title', 'إضافة درس جديد - لوحة الإدارة')

@section('content')
<div class="content-area">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="card-title">إضافة درس جديد</h2>
                            <p class="text-muted mb-0">{{ $course->title_ar }}</p>
                        </div>
                        <a href="{{ route('admin.courses.lessons', $course) }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-right"></i>
                            العودة للدروس
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.lessons.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        
                        <div class="row">
                            <!-- العنوان -->
                            <div class="col-md-6 mb-3">
                                <label for="title_ar" class="form-label">عنوان الدرس (عربي) *</label>
                                <input type="text" class="form-control @error('title_ar') is-invalid @enderror" 
                                       id="title_ar" name="title_ar" value="{{ old('title_ar') }}" required>
                                @error('title_ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="title_en" class="form-label">عنوان الدرس (إنجليزي)</label>
                                <input type="text" class="form-control @error('title_en') is-invalid @enderror" 
                                       id="title_en" name="title_en" value="{{ old('title_en') }}">
                                @error('title_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- الوصف -->
                            <div class="col-md-6 mb-3">
                                <label for="description_ar" class="form-label">وصف الدرس (عربي)</label>
                                <textarea class="form-control @error('description_ar') is-invalid @enderror" 
                                          id="description_ar" name="description_ar" rows="3">{{ old('description_ar') }}</textarea>
                                @error('description_ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="description_en" class="form-label">وصف الدرس (إنجليزي)</label>
                                <textarea class="form-control @error('description_en') is-invalid @enderror" 
                                          id="description_en" name="description_en" rows="3">{{ old('description_en') }}</textarea>
                                @error('description_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- نوع الدرس -->
                            <div class="col-md-6 mb-3">
                                <label for="type" class="form-label">نوع الدرس *</label>
                                <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                    <option value="">اختر نوع الدرس</option>
                                    <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>فيديو</option>
                                    <option value="pdf" {{ old('type') == 'pdf' ? 'selected' : '' }}>ملف PDF</option>
                                    <option value="text" {{ old('type') == 'text' ? 'selected' : '' }}>نص</option>
                                    <option value="quiz" {{ old('type') == 'quiz' ? 'selected' : '' }}>اختبار</option>
                                    <option value="assignment" {{ old('type') == 'assignment' ? 'selected' : '' }}>واجب</option>
                                    <option value="live_session" {{ old('type') == 'live_session' ? 'selected' : '' }}>محاضرة مباشرة</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- مدة الدرس -->
                            <div class="col-md-6 mb-3">
                                <label for="duration_minutes" class="form-label">مدة الدرس (دقائق)</label>
                                <input type="number" class="form-control @error('duration_minutes') is-invalid @enderror" 
                                       id="duration_minutes" name="duration_minutes" value="{{ old('duration_minutes', 0) }}" min="0">
                                @error('duration_minutes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- حقول خاصة بنوع الفيديو -->
                            <div class="col-md-6 mb-3 video-fields" style="display: none;">
                                <label for="video_url" class="form-label">رابط الفيديو</label>
                                <input type="url" class="form-control @error('video_url') is-invalid @enderror" 
                                       id="video_url" name="video_url" value="{{ old('video_url') }}">
                                @error('video_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3 video-fields" style="display: none;">
                                <label for="video_duration" class="form-label">مدة الفيديو</label>
                                <input type="text" class="form-control @error('video_duration') is-invalid @enderror" 
                                       id="video_duration" name="video_duration" value="{{ old('video_duration') }}" 
                                       placeholder="مثال: 15:30">
                                @error('video_duration')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- حقول خاصة بنوع PDF -->
                            <div class="col-md-6 mb-3 pdf-fields" style="display: none;">
                                <label for="pdf_file" class="form-label">ملف PDF</label>
                                <input type="file" class="form-control @error('pdf_file') is-invalid @enderror" 
                                       id="pdf_file" name="pdf_file" accept=".pdf">
                                @error('pdf_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- حقول خاصة بنوع النص -->
                            <div class="col-12 mb-3 text-fields" style="display: none;">
                                <label for="text_content" class="form-label">محتوى النص</label>
                                <textarea class="form-control @error('text_content') is-invalid @enderror" 
                                          id="text_content" name="text_content" rows="10">{{ old('text_content') }}</textarea>
                                @error('text_content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- حقول خاصة بالمحاضرات المباشرة -->
                            <div class="col-md-6 mb-3 live-fields" style="display: none;">
                                <label for="live_session_date" class="form-label">موعد المحاضرة المباشرة</label>
                                <input type="datetime-local" class="form-control @error('live_session_date') is-invalid @enderror" 
                                       id="live_session_date" name="live_session_date" value="{{ old('live_session_date') }}">
                                @error('live_session_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3 live-fields" style="display: none;">
                                <label for="google_meet_link" class="form-label">رابط Google Meet</label>
                                <input type="url" class="form-control @error('google_meet_link') is-invalid @enderror" 
                                       id="google_meet_link" name="google_meet_link" value="{{ old('google_meet_link') }}">
                                @error('google_meet_link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3 live-fields" style="display: none;">
                                <label for="meeting_id" class="form-label">معرف الاجتماع</label>
                                <input type="text" class="form-control @error('meeting_id') is-invalid @enderror" 
                                       id="meeting_id" name="meeting_id" value="{{ old('meeting_id') }}">
                                @error('meeting_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3 live-fields" style="display: none;">
                                <label for="meeting_password" class="form-label">كلمة مرور الاجتماع</label>
                                <input type="text" class="form-control @error('meeting_password') is-invalid @enderror" 
                                       id="meeting_password" name="meeting_password" value="{{ old('meeting_password') }}">
                                @error('meeting_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- الإعدادات -->
                            <div class="col-md-6 mb-3">
                                <label for="sort_order" class="form-label">ترتيب الدرس</label>
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                       id="sort_order" name="sort_order" value="{{ old('sort_order', $course->lessons->count() + 1) }}" min="1">
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_free" name="is_free" value="1" 
                                           {{ old('is_free') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_free">
                                        درس مجاني
                                    </label>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1" 
                                           {{ old('is_published', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_published">
                                        منشور
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i>
                                حفظ الدرس
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    const videoFields = document.querySelectorAll('.video-fields');
    const pdfFields = document.querySelectorAll('.pdf-fields');
    const textFields = document.querySelectorAll('.text-fields');
    const liveFields = document.querySelectorAll('.live-fields');
    
    function toggleFields() {
        const selectedType = typeSelect.value;
        
        // إخفاء جميع الحقول
        videoFields.forEach(field => field.style.display = 'none');
        pdfFields.forEach(field => field.style.display = 'none');
        textFields.forEach(field => field.style.display = 'none');
        liveFields.forEach(field => field.style.display = 'none');
        
        // إظهار الحقول المناسبة
        switch(selectedType) {
            case 'video':
                videoFields.forEach(field => field.style.display = 'block');
                break;
            case 'pdf':
                pdfFields.forEach(field => field.style.display = 'block');
                break;
            case 'text':
                textFields.forEach(field => field.style.display = 'block');
                break;
            case 'live_session':
                liveFields.forEach(field => field.style.display = 'block');
                break;
        }
    }
    
    typeSelect.addEventListener('change', toggleFields);
    toggleFields(); // تشغيل عند تحميل الصفحة
});
</script>

<style>
.form-label {
    font-weight: 500;
}

.form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

.form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}
</style>
@endsection 