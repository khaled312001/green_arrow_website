@extends('layouts.teacher')

@section('title', 'إدارة الدروس - لوحة تحكم المدرب')

@section('content')
<div class="dashboard-container">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 class="page-title">إدارة الدروس</h1>
            <p class="text-muted">إدارة جميع الدروس الخاصة بك</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('teacher.lessons.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i>
                إضافة درس جديد
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon bg-primary">
                    <i class="bi bi-book"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $lessons->total() }}</h3>
                    <p>إجمالي الدروس</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon bg-success">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $lessons->where('status', 'published')->count() }}</h3>
                    <p>الدروس المنشورة</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon bg-warning">
                    <i class="bi bi-clock"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $lessons->where('status', 'draft')->count() }}</h3>
                    <p>الدروس المسودة</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon bg-info">
                    <i class="bi bi-eye"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $lessons->sum('views') }}</h3>
                    <p>إجمالي المشاهدات</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Lessons Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">قائمة الدروس</h5>
            <div class="card-actions">
                <div class="search-box">
                    <input type="text" id="searchInput" class="form-control" placeholder="البحث في الدروس...">
                    <i class="bi bi-search"></i>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($lessons->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>الدرس</th>
                                <th>الدورة</th>
                                <th>الحالة</th>
                                <th>الترتيب</th>
                                <th>المشاهدات</th>
                                <th>تاريخ الإنشاء</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lessons as $lesson)
                            <tr>
                                <td>
                                    <div class="lesson-info">
                                        <div class="lesson-title">{{ $lesson->title_ar }}</div>
                                        <div class="lesson-subtitle">{{ Str::limit($lesson->description, 50) }}</div>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('teacher.courses.show', $lesson->course) }}" class="course-link">
                                        {{ $lesson->course->title_ar }}
                                    </a>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $lesson->status === 'published' ? 'success' : 'warning' }}">
                                        {{ $lesson->status === 'published' ? 'منشور' : 'مسودة' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="order-badge">{{ $lesson->order }}</span>
                                </td>
                                <td>
                                    <div class="views-info">
                                        <i class="bi bi-eye"></i>
                                        {{ $lesson->views ?? 0 }}
                                    </div>
                                </td>
                                <td>
                                    <div class="date-info">
                                        <div>{{ $lesson->created_at->format('Y-m-d') }}</div>
                                        <small>{{ $lesson->created_at->format('H:i') }}</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('teacher.lessons.show', $lesson) }}" 
                                           class="btn btn-sm btn-outline-primary" 
                                           title="عرض">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('teacher.lessons.edit', $lesson) }}" 
                                           class="btn btn-sm btn-outline-warning" 
                                           title="تعديل">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-danger" 
                                                onclick="deleteLesson({{ $lesson->id }})"
                                                title="حذف">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $lessons->links() }}
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="bi bi-book"></i>
                    </div>
                    <h4>لا توجد دروس</h4>
                    <p>لم تقم بإنشاء أي دروس بعد. ابدأ بإنشاء درس جديد.</p>
                    <a href="{{ route('teacher.lessons.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i>
                        إضافة درس جديد
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
/* Statistics Cards */
.stat-card {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.bg-primary { background: linear-gradient(135deg, #667eea, #764ba2); }
.bg-success { background: linear-gradient(135deg, #10b981, #059669); }
.bg-warning { background: linear-gradient(135deg, #f59e0b, #d97706); }
.bg-info { background: linear-gradient(135deg, #3b82f6, #1d4ed8); }

.stat-content h3 {
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    color: #1f2937;
}

.stat-content p {
    margin: 0;
    color: #6b7280;
    font-size: 0.9rem;
}

/* Card Styles */
.card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    border: none;
}

.card-header {
    background: none;
    border-bottom: 1px solid #e5e7eb;
    padding: 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-title {
    margin: 0;
    font-weight: 600;
    color: #1f2937;
}

.card-actions {
    display: flex;
    gap: 1rem;
}

.search-box {
    position: relative;
}

.search-box input {
    padding-right: 2.5rem;
    border-radius: 25px;
    border: 2px solid #e5e7eb;
    transition: all 0.3s ease;
}

.search-box input:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.search-box i {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
}

/* Table Styles */
.table {
    margin: 0;
}

.table th {
    border: none;
    background: #f9fafb;
    color: #374151;
    font-weight: 600;
    padding: 1rem;
}

.table td {
    border: none;
    padding: 1rem;
    vertical-align: middle;
}

.lesson-info {
    display: flex;
    flex-direction: column;
}

.lesson-title {
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.25rem;
}

.lesson-subtitle {
    color: #6b7280;
    font-size: 0.875rem;
}

.course-link {
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
}

.course-link:hover {
    color: #5a67d8;
    text-decoration: underline;
}

.badge {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 500;
}

.order-badge {
    background: #f3f4f6;
    color: #374151;
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-weight: 600;
    font-size: 0.875rem;
}

.views-info {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #6b7280;
}

.views-info i {
    color: #9ca3af;
}

.date-info {
    display: flex;
    flex-direction: column;
}

.date-info small {
    color: #9ca3af;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
}

.action-buttons .btn {
    width: 32px;
    height: 32px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 3rem 1rem;
}

.empty-icon {
    width: 80px;
    height: 80px;
    background: #f3f4f6;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 2rem;
    color: #9ca3af;
}

.empty-state h4 {
    color: #374151;
    margin-bottom: 0.5rem;
}

.empty-state p {
    color: #6b7280;
    margin-bottom: 1.5rem;
}

/* Responsive */
@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .card-header {
        flex-direction: column;
        gap: 1rem;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .table-responsive {
        font-size: 0.875rem;
    }
}
</style>

<script>
// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const tableRows = document.querySelectorAll('tbody tr');
    
    tableRows.forEach(row => {
        const lessonTitle = row.querySelector('.lesson-title').textContent.toLowerCase();
        const courseTitle = row.querySelector('.course-link').textContent.toLowerCase();
        
        if (lessonTitle.includes(searchTerm) || courseTitle.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
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
                location.reload();
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