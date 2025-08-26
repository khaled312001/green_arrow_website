@extends('layouts.admin')

@section('title', 'إدارة الطلاب - لوحة الإدارة')

@section('content')
<div class="content-area">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="card-title">إدارة الطلاب</h2>
                <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
                    <i class="bi bi-person-plus"></i>
                    إضافة طالب جديد
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <!-- Search and Filters -->
            <div class="filters-section mb-4">
                <form method="GET" action="{{ route('admin.students') }}" class="row g-3">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="search" 
                               value="{{ request('search') }}" placeholder="البحث بالاسم أو البريد الإلكتروني...">
                    </div>
                    <div class="col-md-2">
                        <select class="form-select" name="status">
                            <option value="">جميع الحالات</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>نشط</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>غير نشط</option>
                            <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>معلق</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="date" class="form-control" name="enrolled_from" 
                               value="{{ request('enrolled_from') }}" placeholder="من تاريخ">
                    </div>
                    <div class="col-md-2">
                        <input type="date" class="form-control" name="enrolled_to" 
                               value="{{ request('enrolled_to') }}" placeholder="إلى تاريخ">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-outline-primary w-100">
                            <i class="bi bi-search"></i>
                            بحث
                        </button>
                    </div>
                </form>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="stat-card bg-primary text-white">
                        <div class="stat-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ $students->total() }}</h3>
                            <p>إجمالي الطلاب</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card bg-success text-white">
                        <div class="stat-icon">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ $activeStudents }}</h3>
                            <p>طلاب نشطين</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card bg-warning text-white">
                        <div class="stat-icon">
                            <i class="bi bi-clock"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ $newStudentsThisMonth }}</h3>
                            <p>جدد هذا الشهر</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card bg-info text-white">
                        <div class="stat-icon">
                            <i class="bi bi-mortarboard"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ $totalEnrollments }}</h3>
                            <p>إجمالي التسجيلات</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Students Table -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>
                                <input type="checkbox" id="selectAll" class="form-check-input">
                            </th>
                            <th>الطالب</th>
                            <th>البريد الإلكتروني</th>
                            <th>الهاتف</th>
                            <th>الحالة</th>
                            <th>الدورات المسجلة</th>
                            <th>تاريخ التسجيل</th>
                            <th>آخر نشاط</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input student-checkbox" value="{{ $student->id }}">
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ $student->avatar_url }}" alt="{{ $student->name }}" 
                                         class="rounded-circle me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                    <div>
                                        <div class="fw-bold">{{ $student->name }}</div>
                                        <small class="text-muted">ID: {{ $student->id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="mailto:{{ $student->email }}" class="text-decoration-none">
                                    {{ $student->email }}
                                </a>
                            </td>
                            <td>
                                @if($student->phone)
                                    <a href="tel:{{ $student->phone }}" class="text-decoration-none">
                                        {{ $student->phone }}
                                    </a>
                                @else
                                    <span class="text-muted">غير محدد</span>
                                @endif
                            </td>
                            <td>
                                @if($student->status == 'active')
                                    <span class="badge bg-success">نشط</span>
                                @elseif($student->status == 'inactive')
                                    <span class="badge bg-secondary">غير نشط</span>
                                @else
                                    <span class="badge bg-danger">معلق</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ $student->enrollments_count ?? 0 }}</span>
                                @if($student->enrollments_count > 0)
                                    <small class="text-muted d-block">
                                        {{ $student->enrollments->take(2)->pluck('course.title_ar')->implode(', ') }}
                                        @if($student->enrollments_count > 2)
                                            +{{ $student->enrollments_count - 2 }} أكثر
                                        @endif
                                    </small>
                                @endif
                            </td>
                            <td>
                                <div>{{ $student->created_at->format('Y-m-d') }}</div>
                                <small class="text-muted">{{ $student->created_at->diffForHumans() }}</small>
                            </td>
                            <td>
                                @if($student->last_login_at)
                                    <div>{{ $student->last_login_at->format('Y-m-d H:i') }}</div>
                                    <small class="text-muted">{{ $student->last_login_at->diffForHumans() }}</small>
                                @else
                                    <span class="text-muted">لم يسجل دخول</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.students.show', $student) }}" 
                                       class="btn btn-sm btn-outline-primary" title="عرض">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.students.edit', $student) }}" 
                                       class="btn btn-sm btn-outline-secondary" title="تعديل">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                            onclick="deleteStudent({{ $student->id }})" title="حذف">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <div class="empty-state">
                                    <i class="bi bi-people" style="font-size: 3rem; color: #6c757d;"></i>
                                    <h5 class="mt-3">لا يوجد طلاب</h5>
                                    <p class="text-muted">لم يتم العثور على طلاب مطابقين للبحث</p>
                                    <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
                                        <i class="bi bi-person-plus"></i>
                                        إضافة طالب جديد
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Bulk Actions -->
            <div class="bulk-actions mt-3" style="display: none;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="selected-count">0 طالب محدد</span>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-success" onclick="bulkAction('activate')">
                            <i class="bi bi-check-circle"></i>
                            تفعيل
                        </button>
                        <button type="button" class="btn btn-outline-warning" onclick="bulkAction('suspend')">
                            <i class="bi bi-pause-circle"></i>
                            تعليق
                        </button>
                        <button type="button" class="btn btn-outline-danger" onclick="bulkAction('delete')">
                            <i class="bi bi-trash"></i>
                            حذف
                        </button>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="pagination-info">
                    عرض {{ $students->firstItem() ?? 0 }} إلى {{ $students->lastItem() ?? 0 }} 
                    من أصل {{ $students->total() }} طالب
                </div>
                <div>
                    {{ $students->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تأكيد الحذف</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>هل أنت متأكد من حذف هذا الطالب؟ لا يمكن التراجع عن هذا الإجراء.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">حذف</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Select All functionality
document.getElementById('selectAll').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.student-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
    updateBulkActions();
});

// Individual checkbox change
document.querySelectorAll('.student-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', updateBulkActions);
});

function updateBulkActions() {
    const checkedBoxes = document.querySelectorAll('.student-checkbox:checked');
    const bulkActions = document.querySelector('.bulk-actions');
    const selectedCount = document.querySelector('.selected-count');
    
    if (checkedBoxes.length > 0) {
        bulkActions.style.display = 'block';
        selectedCount.textContent = `${checkedBoxes.length} طالب محدد`;
    } else {
        bulkActions.style.display = 'none';
    }
}

function deleteStudent(studentId) {
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    const form = document.getElementById('deleteForm');
    form.action = `/admin/students/${studentId}`;
    modal.show();
}

function bulkAction(action) {
    const checkedBoxes = document.querySelectorAll('.student-checkbox:checked');
    const studentIds = Array.from(checkedBoxes).map(cb => cb.value);
    
    if (studentIds.length === 0) {
        alert('يرجى تحديد طلاب أولاً');
        return;
    }
    
    if (action === 'delete') {
        if (!confirm('هل أنت متأكد من حذف الطلاب المحددين؟')) {
            return;
        }
    }
    
    // Send bulk action request
    fetch('/admin/students/bulk-action', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            action: action,
            student_ids: studentIds
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('حدث خطأ أثناء تنفيذ الإجراء');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('حدث خطأ أثناء تنفيذ الإجراء');
    });
}
</script>

<style>
.stat-card {
    border-radius: 10px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.stat-icon {
    font-size: 2rem;
    opacity: 0.8;
}

.stat-content h3 {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 700;
}

.stat-content p {
    margin: 0;
    opacity: 0.9;
}

.empty-state {
    text-align: center;
    padding: 40px 20px;
}

.bulk-actions {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 15px;
}

.selected-count {
    font-weight: 600;
    color: #495057;
}

.table th {
    font-weight: 600;
    color: #495057;
    border-bottom: 2px solid #dee2e6;
}

.table td {
    vertical-align: middle;
}

.btn-group .btn {
    margin: 0 2px;
}

.pagination-info {
    color: #6c757d;
    font-size: 0.9rem;
}

.filters-section {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 20px;
    border: 1px solid #dee2e6;
}

@media (max-width: 768px) {
    .filters-section .row {
        margin: 0;
    }
    
    .filters-section .col-md-4,
    .filters-section .col-md-2 {
        padding: 5px;
    }
    
    .table-responsive {
        font-size: 0.9rem;
    }
    
    .btn-group .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.8rem;
    }
}
</style>
@endsection 