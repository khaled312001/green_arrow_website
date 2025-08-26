@extends('layouts.teacher')

@section('title', 'تعديل الدرس - لوحة تحكم المدرب')

@section('content')
<div class="dashboard-container">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 class="page-title">تعديل الدرس</h1>
            <p class="text-muted">{{ $lesson->title_ar }}</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('teacher.lessons.show', $lesson) }}" class="btn btn-secondary">
                <i class="bi bi-eye"></i>
                عرض الدرس
            </a>
            <a href="{{ route('teacher.lessons.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-right"></i>
                العودة للدروس
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">تعديل معلومات الدرس</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('teacher.lessons.update', $lesson) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Course Selection -->
                        <div class="mb-3">
                            <label for="course_id" class="form-label">الدورة <span class="text-danger">*</span></label>
                            <select name="course_id" id="course_id" class="form-select @error('course_id') is-invalid @enderror" required>
                                <option value="">اختر الدورة</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ $lesson->course_id == $course->id ? 'selected' : '' }}>
                                        {{ $course->title_ar }}
                                    </option>
                                @endforeach
                            </select>
                            @error('course_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Title Arabic -->
                        <div class="mb-3">
                            <label for="title_ar" class="form-label">عنوان الدرس (عربي) <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('title_ar') is-invalid @enderror" 
                                   id="title_ar" 
                                   name="title_ar" 
                                   value="{{ old('title_ar', $lesson->title_ar) }}" 
                                   required>
                            @error('title_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Title English -->
                        <div class="mb-3">
                            <label for="title_en" class="form-label">عنوان الدرس (إنجليزي) <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('title_en') is-invalid @enderror" 
                                   id="title_en" 
                                   name="title_en" 
                                   value="{{ old('title_en', $lesson->title_en) }}" 
                                   required>
                            @error('title_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description Arabic -->
                        <div class="mb-3">
                            <label for="description_ar" class="form-label">الوصف (عربي)</label>
                            <textarea class="form-control @error('description_ar') is-invalid @enderror" 
                                      id="description_ar" 
                                      name="description_ar" 
                                      rows="3">{{ old('description_ar', $lesson->description_ar) }}</textarea>
                            @error('description_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description English -->
                        <div class="mb-3">
                            <label for="description_en" class="form-label">الوصف (إنجليزي)</label>
                            <textarea class="form-control @error('description_en') is-invalid @enderror" 
                                      id="description_en" 
                                      name="description_en" 
                                      rows="3">{{ old('description_en', $lesson->description_en) }}</textarea>
                            @error('description_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Content Type -->
                        <div class="mb-3">
                            <label for="content_type" class="form-label">نوع المحتوى <span class="text-danger">*</span></label>
                            <select name="content_type" id="content_type" class="form-select @error('content_type') is-invalid @enderror" required>
                                <option value="video" {{ $lesson->content_type === 'video' ? 'selected' : '' }}>فيديو</option>
                                <option value="text" {{ $lesson->content_type === 'text' ? 'selected' : '' }}>نص</option>
                                <option value="file" {{ $lesson->content_type === 'file' ? 'selected' : '' }}>ملف</option>
                                <option value="link" {{ $lesson->content_type === 'link' ? 'selected' : '' }}>رابط خارجي</option>
                            </select>
                            @error('content_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Content Fields (Dynamic) -->
                        <div id="content-fields">
                            <!-- Video Content -->
                            <div class="content-field" id="video-field" style="display: {{ $lesson->content_type === 'video' ? 'block' : 'none' }};">
                                <div class="mb-3">
                                    <label for="video_file" class="form-label">ملف الفيديو</label>
                                    <input type="file" 
                                           class="form-control @error('video_file') is-invalid @enderror" 
                                           id="video_file" 
                                           name="video_file" 
                                           accept="video/*">
                                    @error('video_file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if($lesson->video_file)
                                        <div class="form-text">
                                            <strong>الملف الحالي:</strong> {{ basename($lesson->video_file) }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Text Content -->
                            <div class="content-field" id="text-field" style="display: {{ $lesson->content_type === 'text' ? 'block' : 'none' }};">
                                <div class="mb-3">
                                    <label for="content" class="form-label">محتوى النص</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" 
                                              id="content" 
                                              name="content" 
                                              rows="10">{{ old('content', $lesson->content) }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- File Content -->
                            <div class="content-field" id="file-field" style="display: {{ $lesson->content_type === 'file' ? 'block' : 'none' }};">
                                <div class="mb-3">
                                    <label for="lesson_file" class="form-label">ملف الدرس</label>
                                    <input type="file" 
                                           class="form-control @error('lesson_file') is-invalid @enderror" 
                                           id="lesson_file" 
                                           name="lesson_file">
                                    @error('lesson_file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if($lesson->lesson_file)
                                        <div class="form-text">
                                            <strong>الملف الحالي:</strong> {{ basename($lesson->lesson_file) }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Link Content -->
                            <div class="content-field" id="link-field" style="display: {{ $lesson->content_type === 'link' ? 'block' : 'none' }};">
                                <div class="mb-3">
                                    <label for="external_link" class="form-label">الرابط الخارجي</label>
                                    <input type="url" 
                                           class="form-control @error('external_link') is-invalid @enderror" 
                                           id="external_link" 
                                           name="external_link" 
                                           value="{{ old('external_link', $lesson->external_link) }}">
                                    @error('external_link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Duration -->
                        <div class="mb-3">
                            <label for="duration" class="form-label">المدة (بالدقائق) <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control @error('duration') is-invalid @enderror" 
                                   id="duration" 
                                   name="duration" 
                                   value="{{ old('duration', $lesson->duration) }}" 
                                   min="1" 
                                   required>
                            @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Order -->
                        <div class="mb-3">
                            <label for="order" class="form-label">الترتيب <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control @error('order') is-invalid @enderror" 
                                   id="order" 
                                   name="order" 
                                   value="{{ old('order', $lesson->order) }}" 
                                   min="1" 
                                   required>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Is Free -->
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="is_free" 
                                       name="is_free" 
                                       value="1" 
                                       {{ $lesson->is_free ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_free">
                                    درس مجاني
                                </label>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i>
                                حفظ التغييرات
                            </button>
                            <a href="{{ route('teacher.lessons.show', $lesson) }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle"></i>
                                إلغاء
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Lesson Info -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">معلومات الدرس</h5>
                </div>
                <div class="card-body">
                    <div class="lesson-info">
                        <div class="info-item">
                            <div class="info-label">الدورة:</div>
                            <div class="info-value">{{ $lesson->course->title_ar }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">نوع المحتوى:</div>
                            <div class="info-value">
                                <span class="badge bg-{{ $lesson->content_type === 'video' ? 'primary' : ($lesson->content_type === 'text' ? 'success' : 'info') }}">
                                    {{ $lesson->content_type === 'video' ? 'فيديو' : ($lesson->content_type === 'text' ? 'نص' : ($lesson->content_type === 'file' ? 'ملف' : 'رابط')) }}
                                </span>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">المدة:</div>
                            <div class="info-value">{{ $lesson->duration }} دقيقة</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">الترتيب:</div>
                            <div class="info-value">{{ $lesson->order }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">مجاني:</div>
                            <div class="info-value">
                                <span class="badge bg-{{ $lesson->is_free ? 'success' : 'warning' }}">
                                    {{ $lesson->is_free ? 'نعم' : 'لا' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title">إجراءات سريعة</h5>
                </div>
                <div class="card-body">
                    <div class="quick-actions">
                        <a href="{{ route('teacher.lessons.show', $lesson) }}" class="btn btn-outline-primary btn-sm w-100 mb-2">
                            <i class="bi bi-eye"></i>
                            عرض الدرس
                        </a>
                        
                        <button type="button" 
                                class="btn btn-outline-danger btn-sm w-100"
                                onclick="deleteLesson({{ $lesson->id }})">
                            <i class="bi bi-trash"></i>
                            حذف الدرس
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Form Styles */
.form-label {
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
}

.form-control, .form-select {
    border: 2px solid #e5e7eb;
    border-radius: 10px;
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.form-check-input:checked {
    background-color: #667eea;
    border-color: #667eea;
}

/* Content Fields */
.content-field {
    background: #f9fafb;
    padding: 1.5rem;
    border-radius: 10px;
    margin-bottom: 1rem;
    border: 2px solid #e5e7eb;
}

/* Lesson Info */
.lesson-info {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem;
    background: #f9fafb;
    border-radius: 8px;
}

.info-label {
    font-weight: 600;
    color: #374151;
}

.info-value {
    color: #6b7280;
}

/* Quick Actions */
.quick-actions {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

/* Responsive */
@media (max-width: 768px) {
    .info-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
}
</style>

<script>
// Show/hide content fields based on content type
document.getElementById('content_type').addEventListener('change', function() {
    const contentType = this.value;
    const contentFields = document.querySelectorAll('.content-field');
    
    // Hide all content fields
    contentFields.forEach(field => {
        field.style.display = 'none';
    });
    
    // Show the selected content field
    const selectedField = document.getElementById(contentType + '-field');
    if (selectedField) {
        selectedField.style.display = 'block';
    }
});

// Delete lesson confirmation
function deleteLesson(lessonId) {
    if (confirm('هل أنت متأكد من حذف هذا الدرس؟')) {
        fetch(`/teacher/lessons/${lessonId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = '{{ route("teacher.lessons.index") }}';
            } else {
                alert('حدث خطأ أثناء حذف الدرس');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('حدث خطأ أثناء حذف الدرس');
        });
    }
}
</script>
@endsection 