@extends('layouts.admin')

@section('title', 'إدارة كويزات الدورة - لوحة الإدارة')

@section('content')
<div class="content-area">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="card-title">إدارة كويزات الدورة</h2>
                            <p class="text-muted mb-0">{{ $course->title_ar }}</p>
                        </div>
                        <div>
                            <a href="{{ route('admin.courses.show', $course) }}" class="btn btn-secondary me-2">
                                <i class="bi bi-arrow-right"></i>
                                العودة للدورة
                            </a>
                            <a href="{{ route('admin.quizzes.create', $course) }}" class="btn btn-success">
                                <i class="bi bi-plus-circle"></i>
                                إضافة كويز جديد
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    @if($quizzes->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>العنوان</th>
                                        <th>الدرس المرتبط</th>
                                        <th>المدة</th>
                                        <th>الأسئلة</th>
                                        <th>النقاط</th>
                                        <th>نسبة النجاح</th>
                                        <th>الحالة</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($quizzes as $quiz)
                                        <tr>
                                            <td>
                                                <div>
                                                    <strong>{{ $quiz->title_ar }}</strong>
                                                    @if($quiz->title_en)
                                                        <br><small class="text-muted">{{ $quiz->title_en }}</small>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                @if($quiz->lesson)
                                                    <span class="badge bg-info">{{ $quiz->lesson->title_ar }}</span>
                                                @else
                                                    <span class="text-muted">غير مرتبط</span>
                                                @endif
                                            </td>
                                            <td>{{ $quiz->duration_minutes }} دقيقة</td>
                                            <td>
                                                <span class="badge bg-primary">{{ $quiz->questions->count() }}</span>
                                            </td>
                                            <td>{{ $quiz->total_points }}</td>
                                            <td>{{ $quiz->passing_score }}%</td>
                                            <td>
                                                @if($quiz->is_active)
                                                    <span class="badge bg-success">نشط</span>
                                                @else
                                                    <span class="badge bg-secondary">غير نشط</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.quizzes.show', $quiz) }}" 
                                                       class="btn btn-sm btn-outline-primary" title="عرض">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.quizzes.edit', $quiz) }}" 
                                                       class="btn btn-sm btn-outline-warning" title="تعديل">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <a href="{{ route('admin.quizzes.questions', $quiz) }}" 
                                                       class="btn btn-sm btn-outline-info" title="الأسئلة">
                                                        <i class="bi bi-question-circle"></i>
                                                    </a>
                                                    <form method="POST" action="{{ route('admin.quizzes.delete', $quiz) }}" 
                                                          class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا الكويز؟')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="حذف">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-question-circle text-muted" style="font-size: 4rem;"></i>
                            <h4 class="mt-3 text-muted">لا توجد كويزات لهذه الدورة</h4>
                            <p class="text-muted">ابدأ بإضافة أول كويز للدورة</p>
                            <a href="{{ route('admin.quizzes.create', $course) }}" class="btn btn-success">
                                <i class="bi bi-plus-circle"></i>
                                إضافة كويز جديد
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.table tbody tr:hover {
    background-color: #f8f9fa;
}

.btn-group .btn {
    margin-right: 2px;
}

.badge {
    font-size: 0.75rem;
}
</style>
@endsection 