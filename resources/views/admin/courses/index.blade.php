@extends('layouts.admin')

@section('title', 'إدارة الدورات - لوحة الإدارة')

@section('content')
<div class="content-area">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="card-title">إدارة الدورات</h2>
                <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    إضافة دورة جديدة
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <!-- Search and Filter -->
            <div class="mb-4">
                <form method="GET" action="{{ route('admin.courses') }}" class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               class="form-control" placeholder="البحث في الدورات">
                    </div>
                    <div class="col-md-2">
                        <select name="category" class="form-select">
                            <option value="">جميع الأقسام</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name_ar }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="status" class="form-select">
                            <option value="">جميع الحالات</option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>مسودة</option>
                            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>منشورة</option>
                            <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>مؤرشفة</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="instructor" class="form-select">
                            <option value="">جميع المدربين</option>
                            @foreach($instructors as $instructor)
                                <option value="{{ $instructor->id }}" {{ request('instructor') == $instructor->id ? 'selected' : '' }}>
                                    {{ $instructor->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-secondary w-100">
                            <i class="bi bi-search"></i>
                            بحث
                        </button>
                    </div>
                </form>
            </div>

            <!-- Courses Table -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>الدورة</th>
                            <th>القسم</th>
                            <th>المدرب</th>
                            <th>السعر</th>
                            <th>الحالة</th>
                            <th>الطلاب</th>
                            <th>تاريخ الإنشاء</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $course)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="course-image me-3">
                                        @if($course->image)
                                            <img src="{{ asset('storage/' . $course->image) }}" 
                                                 alt="{{ $course->title_ar }}" class="rounded" width="50" height="50" style="object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                 style="width: 50px; height: 50px;">
                                                <i class="bi bi-book text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $course->title_ar }}</div>
                                        @if($course->title_en)
                                            <small class="text-muted">{{ $course->title_en }}</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($course->category)
                                    <span class="badge" style="background-color: {{ $course->category->color }}; color: white;">
                                        {{ $course->category->name_ar }}
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($course->instructor)
                                    <div class="d-flex align-items-center">
                                        @if($course->instructor->profile_photo)
                                            <img src="{{ asset('storage/' . $course->instructor->profile_photo) }}" 
                                                 alt="{{ $course->instructor->name }}" class="rounded-circle me-2" width="30" height="30">
                                        @else
                                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" 
                                                 style="width: 30px; height: 30px; font-size: 12px;">
                                                {{ strtoupper(substr($course->instructor->name, 0, 1)) }}
                                            </div>
                                        @endif
                                        <span>{{ $course->instructor->name }}</span>
                                    </div>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($course->price > 0)
                                    <span class="fw-bold text-success">{{ number_format($course->price, 2) }} ريال</span>
                                @else
                                    <span class="badge bg-success">مجاني</span>
                                @endif
                            </td>
                            <td>
                                @if($course->status === 'published')
                                    <span class="badge bg-success">منشورة</span>
                                @elseif($course->status === 'draft')
                                    <span class="badge bg-warning">مسودة</span>
                                @else
                                    <span class="badge bg-secondary">مؤرشفة</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $course->enrollments_count ?? 0 }} طالب</span>
                            </td>
                            <td>{{ $course->created_at->format('Y-m-d') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.courses.show', $course) }}" 
                                       class="btn btn-sm btn-outline-info" title="عرض">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.courses.edit', $course) }}" 
                                       class="btn btn-sm btn-outline-primary" title="تعديل">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.courses.delete', $course) }}" 
                                          style="display: inline;" onsubmit="return confirm('هل أنت متأكد من حذف هذه الدورة؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="حذف">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="bi bi-book-x fs-1 d-block mb-3"></i>
                                    لا توجد دورات
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($courses->hasPages())
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="صفحات الدورات">
                    {{ $courses->appends(request()->query())->links('pagination::bootstrap-5') }}
                </nav>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
.course-image img {
    object-fit: cover;
}

.table th {
    font-weight: 600;
    color: #374151;
    border-bottom: 2px solid #e5e7eb;
}

.table td {
    vertical-align: middle;
    border-bottom: 1px solid #f3f4f6;
}

.btn-group .btn {
    margin: 0 2px;
}

.badge {
    font-size: 0.75rem;
    padding: 0.375rem 0.75rem;
}

.form-control, .form-select {
    border-radius: 8px;
    border: 1px solid #d1d5db;
    padding: 0.5rem 0.75rem;
}

.form-control:focus, .form-select:focus {
    border-color: #10b981;
    box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
}
</style>
@endsection 