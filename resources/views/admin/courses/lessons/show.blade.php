@extends('layouts.admin')

@section('title', 'عرض الدرس - لوحة الإدارة')

@section('content')
<div class="content-area">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="card-title">تفاصيل الدرس</h2>
                        <div>
                            <a href="{{ route('admin.courses.lessons', $lesson->course) }}" class="btn btn-secondary me-2">
                                <i class="bi bi-arrow-right"></i>
                                العودة للدروس
                            </a>
                            <a href="{{ route('admin.lessons.edit', $lesson) }}" class="btn btn-primary">
                                <i class="bi bi-pencil"></i>
                                تعديل الدرس
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h3>{{ $lesson->title_ar }}</h3>
                            @if($lesson->title_en)
                                <p class="text-muted">{{ $lesson->title_en }}</p>
                            @endif
                            
                            @if($lesson->description_ar)
                                <div class="mt-3">
                                    <h5>الوصف:</h5>
                                    <p>{{ $lesson->description_ar }}</p>
                                </div>
                            @endif
                            
                            @if($lesson->description_en)
                                <div class="mt-3">
                                    <h5>Description:</h5>
                                    <p>{{ $lesson->description_en }}</p>
                                </div>
                            @endif
                            
                            <!-- عرض المحتوى حسب النوع -->
                            @if($lesson->type === 'video' && $lesson->video_url)
                                <div class="mt-4">
                                    <h5>الفيديو:</h5>
                                    <div class="ratio ratio-16x9">
                                        <iframe src="{{ $lesson->video_url }}" allowfullscreen></iframe>
                                    </div>
                                    @if($lesson->video_duration)
                                        <small class="text-muted">المدة: {{ $lesson->video_duration }}</small>
                                    @endif
                                </div>
                            @endif
                            
                            @if($lesson->type === 'pdf' && $lesson->pdf_file)
                                <div class="mt-4">
                                    <h5>ملف PDF:</h5>
                                    <a href="{{ Storage::url($lesson->pdf_file) }}" class="btn btn-outline-primary" target="_blank">
                                        <i class="bi bi-file-pdf"></i>
                                        عرض الملف
                                    </a>
                                </div>
                            @endif
                            
                            @if($lesson->type === 'text' && $lesson->text_content)
                                <div class="mt-4">
                                    <h5>محتوى النص:</h5>
                                    <div class="border rounded p-3 bg-light">
                                        {!! nl2br(e($lesson->text_content)) !!}
                                    </div>
                                </div>
                            @endif
                            
                            @if($lesson->type === 'live_session')
                                <div class="mt-4">
                                    <h5>تفاصيل المحاضرة المباشرة:</h5>
                                    <div class="row">
                                        @if($lesson->live_session_date)
                                            <div class="col-md-6 mb-2">
                                                <strong>الموعد:</strong>
                                                <p>{{ $lesson->live_session_date->format('Y-m-d H:i') }}</p>
                                            </div>
                                        @endif
                                        
                                        @if($lesson->google_meet_link)
                                            <div class="col-md-6 mb-2">
                                                <strong>رابط Google Meet:</strong>
                                                <p><a href="{{ $lesson->google_meet_link }}" target="_blank">{{ $lesson->google_meet_link }}</a></p>
                                            </div>
                                        @endif
                                        
                                        @if($lesson->meeting_id)
                                            <div class="col-md-6 mb-2">
                                                <strong>معرف الاجتماع:</strong>
                                                <p>{{ $lesson->meeting_id }}</p>
                                            </div>
                                        @endif
                                        
                                        @if($lesson->meeting_password)
                                            <div class="col-md-6 mb-2">
                                                <strong>كلمة المرور:</strong>
                                                <p>{{ $lesson->meeting_password }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">معلومات الدرس</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <strong>النوع:</strong>
                                        <span class="badge bg-secondary">{{ $lesson->type_text }}</span>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <strong>المدة:</strong>
                                        <p>{{ $lesson->duration_minutes ?? 0 }} دقيقة</p>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <strong>الحالة:</strong>
                                        @if($lesson->is_published)
                                            <span class="badge bg-success">منشور</span>
                                        @else
                                            <span class="badge bg-warning">مسودة</span>
                                        @endif
                                    </div>
                                    
                                    <div class="mb-3">
                                        <strong>السعر:</strong>
                                        @if($lesson->is_free)
                                            <span class="badge bg-success">مجاني</span>
                                        @else
                                            <span class="text-muted">مدفوع</span>
                                        @endif
                                    </div>
                                    
                                    <div class="mb-3">
                                        <strong>الترتيب:</strong>
                                        <p>{{ $lesson->sort_order }}</p>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <strong>تاريخ الإنشاء:</strong>
                                        <p>{{ $lesson->created_at->format('Y-m-d H:i') }}</p>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <strong>آخر تحديث:</strong>
                                        <p>{{ $lesson->updated_at->format('Y-m-d H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- الكويزات المرتبطة -->
            @if($lesson->quizzes->count() > 0)
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">الكويزات المرتبطة ({{ $lesson->quizzes->count() }})</h3>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            @foreach($lesson->quizzes as $quiz)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">{{ $quiz->title_ar }}</h6>
                                        @if($quiz->title_en)
                                            <small class="text-muted">{{ $quiz->title_en }}</small>
                                        @endif
                                        <div class="mt-1">
                                            <span class="badge bg-info">{{ $quiz->duration_minutes }} دقيقة</span>
                                            <span class="badge bg-warning">{{ $quiz->passing_score }}% للنجاح</span>
                                            <span class="badge bg-primary">{{ $quiz->questions->count() }} سؤال</span>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.quizzes.show', $quiz) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                            عرض
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
        
        <div class="col-lg-4">
            <!-- إحصائيات الدرس -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">إحصائيات الدرس</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <div class="border rounded p-3">
                                <h4 class="text-primary">{{ $lesson->views_count }}</h4>
                                <small class="text-muted">المشاهدات</small>
                            </div>
                        </div>
                        
                        <div class="col-6 mb-3">
                            <div class="border rounded p-3">
                                <h4 class="text-success">{{ $lesson->completed_count }}</h4>
                                <small class="text-muted">المكتمل</small>
                            </div>
                        </div>
                        
                        <div class="col-6 mb-3">
                            <div class="border rounded p-3">
                                <h4 class="text-info">{{ $lesson->quizzes->count() }}</h4>
                                <small class="text-muted">الكويزات</small>
                            </div>
                        </div>
                        
                        <div class="col-6 mb-3">
                            <div class="border rounded p-3">
                                <h4 class="text-warning">{{ $lesson->course->enrollments->count() }}</h4>
                                <small class="text-muted">الطلاب المسجلين</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- الإجراءات -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title">الإجراءات</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.quizzes.create', $lesson->course) }}" class="btn btn-success">
                            <i class="bi bi-plus-circle"></i>
                            إضافة كويز للدرس
                        </a>
                        
                        <form method="POST" action="{{ route('admin.lessons.delete', $lesson) }}" 
                              onsubmit="return confirm('هل أنت متأكد من حذف هذا الدرس؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="bi bi-trash"></i>
                                حذف الدرس
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.badge {
    font-size: 0.75rem;
    padding: 0.375rem 0.75rem;
}

.list-group-item {
    border: 1px solid #e5e7eb;
    margin-bottom: 0.5rem;
    border-radius: 8px;
}

.list-group-item:hover {
    background-color: #f8fafc;
}

.ratio {
    border-radius: 8px;
    overflow: hidden;
}

.card {
    border-radius: 8px;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}
</style>
@endsection 