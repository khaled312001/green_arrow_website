@extends('layouts.admin')

@section('title', 'إدارة المعلمين')

@section('content')
<div class="instructors-management">
    <!-- Header -->
    <div class="page-header">
        <div class="header-content">
            <h1>إدارة المعلمين</h1>
            <p>إدارة جميع المعلمين في الأكاديمية</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.instructors.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i>
                إضافة معلم جديد
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-cards">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-people"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $instructors->total() }}</h3>
                <p>إجمالي المعلمين</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-check-circle"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $activeInstructors }}</h3>
                <p>المعلمين النشطين</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-book"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $totalCourses }}</h3>
                <p>إجمالي الدورات</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-star"></i>
            </div>
            <div class="stat-content">
                <h3>{{ number_format($averageRating, 1) }}</h3>
                <p>متوسط التقييم</p>
            </div>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="filters-section">
        <form method="GET" action="{{ route('admin.instructors') }}" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="البحث بالاسم أو البريد الإلكتروني" value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">جميع الحالات</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>نشط</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>غير نشط</option>
                    <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>معلق</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="specialization" class="form-select">
                    <option value="">جميع التخصصات</option>
                    <option value="programming" {{ request('specialization') == 'programming' ? 'selected' : '' }}>برمجة</option>
                    <option value="design" {{ request('specialization') == 'design' ? 'selected' : '' }}>تصميم</option>
                    <option value="business" {{ request('specialization') == 'business' ? 'selected' : '' }}>إدارة أعمال</option>
                    <option value="language" {{ request('specialization') == 'language' ? 'selected' : '' }}>لغات</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-outline-primary w-100">
                    <i class="bi bi-search"></i>
                    بحث
                </button>
            </div>
        </form>
    </div>

    <!-- Bulk Actions -->
    <div class="bulk-actions">
        <div class="bulk-controls">
            <input type="checkbox" id="select-all" class="form-check-input">
            <label for="select-all" class="form-check-label">تحديد الكل</label>
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="bulkDelete()" disabled id="bulk-delete-btn">
                <i class="bi bi-trash"></i>
                حذف المحدد
            </button>
            <button type="button" class="btn btn-sm btn-outline-success" onclick="bulkActivate()" disabled id="bulk-activate-btn">
                <i class="bi bi-check-circle"></i>
                تفعيل المحدد
            </button>
            <button type="button" class="btn btn-sm btn-outline-warning" onclick="bulkDeactivate()" disabled id="bulk-deactivate-btn">
                <i class="bi bi-pause-circle"></i>
                إيقاف المحدد
            </button>
        </div>
    </div>

    <!-- Instructors Table -->
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width="50">
                        <input type="checkbox" class="form-check-input" id="select-all-table">
                    </th>
                    <th>المعلم</th>
                    <th>التخصص</th>
                    <th>معلومات الاتصال</th>
                    <th>الحالة</th>
                    <th>الدورات</th>
                    <th>التقييم</th>
                    <th>تاريخ التسجيل</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($instructors as $instructor)
                <tr>
                    <td>
                        <input type="checkbox" class="form-check-input instructor-checkbox" value="{{ $instructor->id }}">
                    </td>
                    <td>
                        <div class="instructor-info">
                            <div class="instructor-avatar">
                                @if($instructor->avatar)
                                    <img src="{{ asset('storage/' . $instructor->avatar) }}" alt="{{ $instructor->name }}">
                                @else
                                    <div class="avatar-placeholder">
                                        {{ strtoupper(substr($instructor->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <div class="instructor-details">
                                <div class="instructor-name">{{ $instructor->name }}</div>
                                <small class="text-muted">{{ $instructor->specialization }}</small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge bg-secondary">{{ $instructor->specialization }}</span>
                    </td>
                    <td>
                        <div class="contact-info">
                            <a href="mailto:{{ $instructor->email }}" class="text-decoration-none">
                                <i class="bi bi-envelope"></i>
                                {{ $instructor->email }}
                            </a>
                            @if($instructor->phone)
                                <br>
                                <a href="tel:{{ $instructor->phone }}" class="text-decoration-none">
                                    <i class="bi bi-telephone"></i>
                                    {{ $instructor->phone }}
                                </a>
                            @endif
                        </div>
                    </td>
                    <td>
                        @if($instructor->status == 'active')
                            <span class="badge bg-success">نشط</span>
                        @elseif($instructor->status == 'inactive')
                            <span class="badge bg-secondary">غير نشط</span>
                        @else
                            <span class="badge bg-warning">معلق</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-primary">{{ $instructor->courses_count ?? 0 }}</span>
                        @if($instructor->courses_count > 0)
                            <br>
                            <small class="text-muted">
                                {{ $instructor->courses->take(2)->pluck('title_ar')->implode(', ') }}
                            </small>
                            @if($instructor->courses_count > 2)
                                <br>
                                <small class="text-muted">+{{ $instructor->courses_count - 2 }} أكثر</small>
                            @endif
                        @endif
                    </td>
                    <td>
                        <div class="rating">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star{{ $i <= ($instructor->rating ?? 0) ? '-fill' : '' }}"></i>
                            @endfor
                            <br>
                            <span class="rating-text">{{ number_format($instructor->rating ?? 0, 1) }}</span>
                        </div>
                    </td>
                    <td>
                        <div>{{ $instructor->created_at->format('Y-m-d') }}</div>
                        <small class="text-muted">{{ $instructor->created_at->diffForHumans() }}</small>
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('admin.instructors.show', $instructor) }}" 
                               class="btn btn-sm btn-outline-primary" title="عرض">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.instructors.edit', $instructor) }}" 
                               class="btn btn-sm btn-outline-secondary" title="تعديل">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-danger" 
                                    onclick="deleteInstructor({{ $instructor->id }})" title="حذف">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center py-5">
                        <div class="empty-state">
                            <i class="bi bi-people fs-1 text-muted"></i>
                            <h4 class="mt-3">لا يوجد معلمين</h4>
                            <p class="text-muted">لم يتم العثور على معلمين مطابقين للبحث</p>
                            <a href="{{ route('admin.instructors.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i>
                                إضافة معلم جديد
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($instructors->hasPages())
    <div class="pagination-section">
        <div class="pagination-info">
            عرض {{ $instructors->firstItem() ?? 0 }} إلى {{ $instructors->lastItem() ?? 0 }}
            من أصل {{ $instructors->total() }} معلم
        </div>
        <div class="pagination-links">
            {{ $instructors->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>
    @endif
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
                <p>هل أنت متأكد من حذف هذا المعلم؟ هذا الإجراء لا يمكن التراجع عنه.</p>
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

<style>
.instructors-management {
    padding: 20px;
    max-width: 1400px;
    margin: 0 auto;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding: 20px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 15px;
}

.page-header h1 {
    margin: 0;
    font-size: 2rem;
    font-weight: 700;
}

.page-header p {
    margin: 5px 0 0 0;
    opacity: 0.9;
}

.stats-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    color: white;
    font-size: 1.2rem;
}

.stat-content h3 {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 700;
    color: #1f2937;
}

.stat-content p {
    margin: 0;
    color: #6b7280;
    font-size: 0.9rem;
}

.filters-section {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

.bulk-actions {
    background: white;
    padding: 15px 20px;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

.bulk-controls {
    display: flex;
    align-items: center;
    gap: 15px;
}

.bulk-controls .btn {
    font-size: 0.8rem;
    padding: 5px 10px;
}

.table {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.table th {
    background: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
    font-weight: 600;
    color: #495057;
}

.instructor-info {
    display: flex;
    align-items: center;
}

.instructor-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    overflow: hidden;
    margin-right: 10px;
}

.instructor-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.avatar-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
}

.instructor-name {
    font-weight: 600;
    color: #1f2937;
}

.contact-info a {
    color: #6b7280;
    font-size: 0.9rem;
}

.contact-info a:hover {
    color: #374151;
}

.rating {
    text-align: center;
}

.rating i {
    color: #fbbf24;
    font-size: 0.8rem;
}

.rating-text {
    font-size: 0.8rem;
    color: #6b7280;
}

.btn-group .btn {
    margin: 0 2px;
}

.empty-state {
    text-align: center;
    padding: 40px 20px;
}

.empty-state i {
    font-size: 3rem;
    color: #d1d5db;
}

.pagination-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}

.pagination-info {
    color: #6b7280;
    font-size: 0.9rem;
}

@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    
    .stats-cards {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .bulk-controls {
        flex-wrap: wrap;
    }
    
    .pagination-section {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
}
</style>

<script>
// Select all functionality
document.getElementById('select-all').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.instructor-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
    updateBulkButtons();
});

document.getElementById('select-all-table').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.instructor-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
    document.getElementById('select-all').checked = this.checked;
    updateBulkButtons();
});

// Individual checkbox change
document.querySelectorAll('.instructor-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', updateBulkButtons);
});

function updateBulkButtons() {
    const checkedBoxes = document.querySelectorAll('.instructor-checkbox:checked');
    const bulkDeleteBtn = document.getElementById('bulk-delete-btn');
    const bulkActivateBtn = document.getElementById('bulk-activate-btn');
    const bulkDeactivateBtn = document.getElementById('bulk-deactivate-btn');
    
    const hasChecked = checkedBoxes.length > 0;
    
    bulkDeleteBtn.disabled = !hasChecked;
    bulkActivateBtn.disabled = !hasChecked;
    bulkDeactivateBtn.disabled = !hasChecked;
}

// Delete instructor
function deleteInstructor(instructorId) {
    if (confirm('هل أنت متأكد من حذف هذا المعلم؟')) {
        const form = document.getElementById('deleteForm');
        form.action = `/admin/teachers/${instructorId}`;
        form.submit();
    }
}

// Bulk delete
function bulkDelete() {
    const checkedBoxes = document.querySelectorAll('.instructor-checkbox:checked');
    const instructorIds = Array.from(checkedBoxes).map(cb => cb.value);
    
    if (instructorIds.length === 0) {
        alert('يرجى تحديد معلمين للحذف');
        return;
    }
    
    if (confirm(`هل أنت متأكد من حذف ${instructorIds.length} معلم؟`)) {
        fetch('/admin/teachers/bulk-action', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                action: 'delete',
                instructor_ids: instructorIds
            })
        }).then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('حدث خطأ أثناء حذف المعلمين');
            }
        });
    }
}

// Bulk activate
function bulkActivate() {
    const checkedBoxes = document.querySelectorAll('.instructor-checkbox:checked');
    const instructorIds = Array.from(checkedBoxes).map(cb => cb.value);
    
    if (instructorIds.length === 0) {
        alert('يرجى تحديد معلمين للتفعيل');
        return;
    }
    
    fetch('/admin/teachers/bulk-action', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            action: 'activate',
            instructor_ids: instructorIds
        })
    }).then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('حدث خطأ أثناء تفعيل المعلمين');
        }
    });
}

// Bulk deactivate
function bulkDeactivate() {
    const checkedBoxes = document.querySelectorAll('.instructor-checkbox:checked');
    const instructorIds = Array.from(checkedBoxes).map(cb => cb.value);
    
    if (instructorIds.length === 0) {
        alert('يرجى تحديد معلمين للإيقاف');
        return;
    }
    
    fetch('/admin/teachers/bulk-action', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            action: 'deactivate',
            instructor_ids: instructorIds
        })
    }).then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('حدث خطأ أثناء إيقاف المعلمين');
        }
    });
}
</script>
@endsection 