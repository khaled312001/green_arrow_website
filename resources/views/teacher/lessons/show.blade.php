@extends('layouts.teacher')

@section('title', 'عرض الدرس - لوحة تحكم المدرب')

@section('content')
<div class="dashboard-container">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 class="page-title">عرض الدرس</h1>
            <p class="text-muted">{{ $lesson->title_ar }}</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('teacher.lessons.edit', $lesson) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i>
                تعديل الدرس
            </a>
            <a href="{{ route('teacher.lessons.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-right"></i>
                العودة للدروس
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Lesson Details -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">تفاصيل الدرس</h5>
                </div>
                <div class="card-body">
                    <div class="lesson-details">
                        <div class="detail-row">
                            <div class="detail-label">عنوان الدرس (عربي):</div>
                            <div class="detail-value">{{ $lesson->title_ar }}</div>
                        </div>
                        
                        <div class="detail-row">
                            <div class="detail-label">عنوان الدرس (إنجليزي):</div>
                            <div class="detail-value">{{ $lesson->title_en }}</div>
                        </div>
                        
                        <div class="detail-row">
                            <div class="detail-label">الوصف (عربي):</div>
                            <div class="detail-value">{{ $lesson->description_ar ?: 'لا يوجد وصف' }}</div>
                        </div>
                        
                        <div class="detail-row">
                            <div class="detail-label">الوصف (إنجليزي):</div>
                            <div class="detail-value">{{ $lesson->description_en ?: 'لا يوجد وصف' }}</div>
                        </div>
                        
                        <div class="detail-row">
                            <div class="detail-label">نوع المحتوى:</div>
                            <div class="detail-value">
                                <span class="badge bg-{{ $lesson->content_type === 'video' ? 'primary' : ($lesson->content_type === 'text' ? 'success' : 'info') }}">
                                    {{ $lesson->content_type === 'video' ? 'فيديو' : ($lesson->content_type === 'text' ? 'نص' : ($lesson->content_type === 'file' ? 'ملف' : 'رابط')) }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="detail-row">
                            <div class="detail-label">المدة (بالدقائق):</div>
                            <div class="detail-value">{{ $lesson->duration }}</div>
                        </div>
                        
                        <div class="detail-row">
                            <div class="detail-label">الترتيب:</div>
                            <div class="detail-value">{{ $lesson->order }}</div>
                        </div>
                        
                        <div class="detail-row">
                            <div class="detail-label">مجاني:</div>
                            <div class="detail-value">
                                <span class="badge bg-{{ $lesson->is_free ? 'success' : 'warning' }}">
                                    {{ $lesson->is_free ? 'نعم' : 'لا' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lesson Content -->
            @if($lesson->content_type === 'video' && $lesson->video_file)
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title">محتوى الفيديو</h5>
                </div>
                <div class="card-body">
                    <video controls class="w-100" style="max-height: 400px;">
                        <source src="{{ asset('storage/' . $lesson->video_file) }}" type="video/mp4">
                        متصفحك لا يدعم تشغيل الفيديو.
                    </video>
                </div>
            </div>
            @endif

            @if($lesson->content_type === 'text' && $lesson->content)
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title">محتوى النص</h5>
                </div>
                <div class="card-body">
                    <div class="lesson-content">
                        {!! $lesson->content !!}
                    </div>
                </div>
            </div>
            @endif

            @if($lesson->content_type === 'file' && $lesson->lesson_file)
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title">ملف الدرس</h5>
                </div>
                <div class="card-body">
                    <a href="{{ asset('storage/' . $lesson->lesson_file) }}" 
                       class="btn btn-primary" 
                       target="_blank">
                        <i class="bi bi-download"></i>
                        تحميل الملف
                    </a>
                </div>
            </div>
            @endif

            @if($lesson->content_type === 'link' && $lesson->external_link)
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title">رابط خارجي</h5>
                </div>
                <div class="card-body">
                    <a href="{{ $lesson->external_link }}" 
                       class="btn btn-primary" 
                       target="_blank">
                        <i class="bi bi-link-45deg"></i>
                        فتح الرابط
                    </a>
                </div>
            </div>
            @endif
        </div>

        <!-- Lesson Info Sidebar -->
        <div class="col-lg-4">
            <!-- Course Info -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">معلومات الدورة</h5>
                </div>
                <div class="card-body">
                    <div class="course-info">
                        <div class="course-title">{{ $lesson->course->title_ar }}</div>
                        <div class="course-subtitle">{{ $lesson->course->title_en }}</div>
                        <a href="{{ route('teacher.courses.show', $lesson->course) }}" class="btn btn-outline-primary btn-sm mt-2">
                            <i class="bi bi-eye"></i>
                            عرض الدورة
                        </a>
                    </div>
                </div>
            </div>

            <!-- Lesson Stats -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title">إحصائيات الدرس</h5>
                </div>
                <div class="card-body">
                    <div class="stats-list">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="bi bi-eye"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-value">{{ $lesson->views ?? 0 }}</div>
                                <div class="stat-label">المشاهدات</div>
                            </div>
                        </div>
                        
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="bi bi-calendar"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-value">{{ $lesson->created_at->format('Y-m-d') }}</div>
                                <div class="stat-label">تاريخ الإنشاء</div>
                            </div>
                        </div>
                        
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="bi bi-clock"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-value">{{ $lesson->updated_at->format('Y-m-d') }}</div>
                                <div class="stat-label">آخر تحديث</div>
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
                        <a href="{{ route('teacher.lessons.edit', $lesson) }}" class="btn btn-warning btn-sm w-100 mb-2">
                            <i class="bi bi-pencil"></i>
                            تعديل الدرس
                        </a>
                        
                        <button type="button" 
                                class="btn btn-danger btn-sm w-100"
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
/* Lesson Details */
.lesson-details {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.detail-row {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem;
    background: #f9fafb;
    border-radius: 10px;
}

.detail-label {
    font-weight: 600;
    color: #374151;
    min-width: 150px;
}

.detail-value {
    color: #6b7280;
    flex: 1;
}

/* Course Info */
.course-info {
    text-align: center;
}

.course-title {
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.5rem;
}

.course-subtitle {
    color: #6b7280;
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

/* Stats */
.stats-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: #f9fafb;
    border-radius: 10px;
}

.stat-icon {
    width: 40px;
    height: 40px;
    background: #667eea;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.stat-content {
    flex: 1;
}

.stat-value {
    font-weight: 600;
    color: #1f2937;
    font-size: 1.1rem;
}

.stat-label {
    color: #6b7280;
    font-size: 0.9rem;
}

/* Quick Actions */
.quick-actions {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

/* Lesson Content */
.lesson-content {
    line-height: 1.8;
    color: #374151;
}

.lesson-content h1, .lesson-content h2, .lesson-content h3 {
    color: #1f2937;
    margin-bottom: 1rem;
}

.lesson-content p {
    margin-bottom: 1rem;
}

.lesson-content ul, .lesson-content ol {
    margin-bottom: 1rem;
    padding-right: 1.5rem;
}

/* Responsive */
@media (max-width: 768px) {
    .detail-row {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .detail-label {
        min-width: auto;
    }
}
</style>

<script>
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