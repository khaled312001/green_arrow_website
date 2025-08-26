@extends('layouts.admin')

@section('title', 'إدارة دروس الدورة - لوحة الإدارة')

@section('content')
<div class="content-area">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="card-title">إدارة دروس الدورة</h2>
                            <p class="text-muted mb-0">{{ $course->title_ar }}</p>
                        </div>
                        <div>
                            <a href="{{ route('admin.courses.show', $course) }}" class="btn btn-secondary me-2">
                                <i class="bi bi-arrow-right"></i>
                                العودة للدورة
                            </a>
                            <a href="{{ route('admin.lessons.create', $course) }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i>
                                إضافة درس جديد
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    @if($lessons->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>العنوان</th>
                                        <th>النوع</th>
                                        <th>المدة</th>
                                        <th>الحالة</th>
                                        <th>الكويزات</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody id="lessonsTable">
                                    @foreach($lessons as $lesson)
                                        <tr data-id="{{ $lesson->id }}">
                                            <td>{{ $lesson->sort_order }}</td>
                                            <td>
                                                <div>
                                                    <strong>{{ $lesson->title_ar }}</strong>
                                                    @if($lesson->title_en)
                                                        <br><small class="text-muted">{{ $lesson->title_en }}</small>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $lesson->type_text }}</span>
                                                @if($lesson->is_free)
                                                    <span class="badge bg-success">مجاني</span>
                                                @endif
                                            </td>
                                            <td>{{ $lesson->duration_minutes ?? 0 }} دقيقة</td>
                                            <td>
                                                @if($lesson->is_published)
                                                    <span class="badge bg-success">منشور</span>
                                                @else
                                                    <span class="badge bg-warning">مسودة</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $lesson->quizzes->count() }}</span>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.lessons.show', $lesson) }}" 
                                                       class="btn btn-sm btn-outline-primary" title="عرض">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.lessons.edit', $lesson) }}" 
                                                       class="btn btn-sm btn-outline-warning" title="تعديل">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form method="POST" action="{{ route('admin.lessons.delete', $lesson) }}" 
                                                          class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا الدرس؟')">
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
                            <i class="bi bi-book text-muted" style="font-size: 4rem;"></i>
                            <h4 class="mt-3 text-muted">لا توجد دروس لهذه الدورة</h4>
                            <p class="text-muted">ابدأ بإضافة أول درس للدورة</p>
                            <a href="{{ route('admin.lessons.create', $course) }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i>
                                إضافة درس جديد
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if($lessons->count() > 0)
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tbody = document.getElementById('lessonsTable');
    
    new Sortable(tbody, {
        animation: 150,
        onEnd: function(evt) {
            const rows = Array.from(tbody.querySelectorAll('tr'));
            const orderData = rows.map((row, index) => ({
                id: row.dataset.id,
                sort_order: index + 1
            }));
            
            // تحديث ترتيب الدروس
            fetch('{{ route("admin.lessons.reorder", $lessons->first()) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ lessons: orderData })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // تحديث أرقام الترتيب في الجدول
                    rows.forEach((row, index) => {
                        row.querySelector('td:first-child').textContent = index + 1;
                    });
                }
            });
        }
    });
});
</script>
@endif

<style>
.table tbody tr {
    cursor: move;
}

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