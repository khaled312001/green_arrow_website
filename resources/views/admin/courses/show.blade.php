@extends('layouts.admin')

@section('title', 'تفاصيل الدورة - لوحة الإدارة')

@section('content')
<div class="content-area">
    <div class="row">
        <!-- Course Details -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="card-title">تفاصيل الدورة</h2>
                        <a href="{{ route('admin.courses') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-right"></i>
                            العودة للدورات
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if($course->image)
                                <img src="{{ asset('storage/' . $course->image) }}" 
                                     alt="{{ $course->title_ar }}" class="img-fluid rounded">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                     style="height: 200px;">
                                    <i class="bi bi-book text-muted" style="font-size: 3rem;"></i>
                                </div>
                            @endif
                        </div>
                        
                        <div class="col-md-8">
                            <h3>{{ $course->title_ar }}</h3>
                            @if($course->title_en)
                                <p class="text-muted">{{ $course->title_en }}</p>
                            @endif
                            
                            <div class="row mt-3">
                                <div class="col-6">
                                    <strong>القسم:</strong>
                                    @if($course->category)
                                        <span class="badge" style="background-color: {{ $course->category->color }}; color: white;">
                                            {{ $course->category->name_ar }}
                                        </span>
                                    @else
                                        <span class="text-muted">غير محدد</span>
                                    @endif
                                </div>
                                
                                <div class="col-6">
                                    <strong>المدرب:</strong>
                                    @if($course->instructor)
                                        <span>{{ $course->instructor->name }}</span>
                                    @else
                                        <span class="text-muted">غير محدد</span>
                                    @endif
                                </div>
                                
                                <div class="col-6 mt-2">
                                    <strong>السعر:</strong>
                                    @if($course->price > 0)
                                        <span class="fw-bold text-success">{{ number_format($course->price, 2) }} ريال</span>
                                    @else
                                        <span class="badge bg-success">مجاني</span>
                                    @endif
                                </div>
                                
                                <div class="col-6 mt-2">
                                    <strong>الحالة:</strong>
                                    @if($course->status === 'published')
                                        <span class="badge bg-success">منشورة</span>
                                    @elseif($course->status === 'draft')
                                        <span class="badge bg-warning">مسودة</span>
                                    @else
                                        <span class="badge bg-secondary">مؤرشفة</span>
                                    @endif
                                </div>
                            </div>
                            
                            @if($course->description_ar)
                                <div class="mt-3">
                                    <strong>الوصف:</strong>
                                    <p>{{ $course->description_ar }}</p>
                                </div>
                            @endif
                            
                            @if($course->description_en)
                                <div class="mt-3">
                                    <strong>Description:</strong>
                                    <p>{{ $course->description_en }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Lessons -->
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">الدروس ({{ $course->lessons->count() }})</h3>
                    <a href="{{ route('admin.courses.lessons', $course) }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle"></i>
                        إدارة الدروس
                    </a>
                </div>
                
                <div class="card-body">
                    @if($course->lessons->count() > 0)
                        <div class="list-group">
                            @foreach($course->lessons->take(5) as $lesson)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">{{ $lesson->title_ar }}</h6>
                                        @if($lesson->title_en)
                                            <small class="text-muted">{{ $lesson->title_en }}</small>
                                        @endif
                                        <div class="mt-1">
                                            <span class="badge bg-secondary">{{ $lesson->type_text }}</span>
                                            @if($lesson->is_free)
                                                <span class="badge bg-success">مجاني</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-primary rounded-pill">{{ $lesson->duration_minutes ?? 0 }} دقيقة</span>
                                        <div class="mt-1">
                                            <small class="text-muted">{{ $lesson->quizzes->count() }} كويز</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($course->lessons->count() > 5)
                            <div class="text-center mt-3">
                                <a href="{{ route('admin.courses.lessons', $course) }}" class="btn btn-outline-primary">
                                    عرض جميع الدروس ({{ $course->lessons->count() }})
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-book text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-2">لا توجد دروس لهذه الدورة</p>
                            <a href="{{ route('admin.lessons.create', $course) }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i>
                                إضافة درس جديد
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quizzes -->
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">الكويزات ({{ $course->quizzes->count() }})</h3>
                    <a href="{{ route('admin.courses.quizzes', $course) }}" class="btn btn-success btn-sm">
                        <i class="bi bi-plus-circle"></i>
                        إدارة الكويزات
                    </a>
                </div>
                
                <div class="card-body">
                    @if($course->quizzes->count() > 0)
                        <div class="list-group">
                            @foreach($course->quizzes->take(5) as $quiz)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">{{ $quiz->title_ar }}</h6>
                                        @if($quiz->title_en)
                                            <small class="text-muted">{{ $quiz->title_en }}</small>
                                        @endif
                                        <div class="mt-1">
                                            <span class="badge bg-info">{{ $quiz->duration_minutes }} دقيقة</span>
                                            <span class="badge bg-warning">{{ $quiz->passing_score }}% للنجاح</span>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-success rounded-pill">{{ $quiz->questions->count() }} سؤال</span>
                                        <div class="mt-1">
                                            <small class="text-muted">{{ $quiz->total_points }} نقطة</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($course->quizzes->count() > 5)
                            <div class="text-center mt-3">
                                <a href="{{ route('admin.courses.quizzes', $course) }}" class="btn btn-outline-success">
                                    عرض جميع الكويزات ({{ $course->quizzes->count() }})
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-question-circle text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-2">لا توجد كويزات لهذه الدورة</p>
                            <a href="{{ route('admin.quizzes.create', $course) }}" class="btn btn-success">
                                <i class="bi bi-plus-circle"></i>
                                إضافة كويز جديد
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Course Stats -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">إحصائيات الدورة</h3>
                </div>
                
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <div class="border rounded p-3">
                                <h4 class="text-primary">{{ $course->enrollments->count() }}</h4>
                                <small class="text-muted">الطلاب المسجلين</small>
                            </div>
                        </div>
                        
                        <div class="col-6 mb-3">
                            <div class="border rounded p-3">
                                <h4 class="text-success">{{ $course->lessons->count() }}</h4>
                                <small class="text-muted">عدد الدروس</small>
                            </div>
                        </div>
                        
                        <div class="col-6 mb-3">
                            <div class="border rounded p-3">
                                <h4 class="text-info">{{ $course->created_at->format('Y-m-d') }}</h4>
                                <small class="text-muted">تاريخ الإنشاء</small>
                            </div>
                        </div>
                        
                        <div class="col-6 mb-3">
                            <div class="border rounded p-3">
                                <h4 class="text-warning">{{ $course->updated_at->format('Y-m-d') }}</h4>
                                <small class="text-muted">آخر تحديث</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">الإجراءات</h3>
                </div>
                
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-primary">
                            <i class="bi bi-pencil"></i>
                            تعديل الدورة
                        </a>
                        
                        <form method="POST" action="{{ route('admin.courses.status', $course) }}" class="d-grid">
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-select mb-2" onchange="this.form.submit()">
                                <option value="draft" {{ $course->status === 'draft' ? 'selected' : '' }}>مسودة</option>
                                <option value="published" {{ $course->status === 'published' ? 'selected' : '' }}>منشورة</option>
                                <option value="archived" {{ $course->status === 'archived' ? 'selected' : '' }}>مؤرشفة</option>
                            </select>
                        </form>
                        
                        <form method="POST" action="{{ route('admin.courses.delete', $course) }}" 
                              onsubmit="return confirm('هل أنت متأكد من حذف هذه الدورة؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="bi bi-trash"></i>
                                حذف الدورة
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

.form-select {
    border-radius: 8px;
    border: 1px solid #d1d5db;
    padding: 0.5rem 0.75rem;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
}
</style>
@endsection 