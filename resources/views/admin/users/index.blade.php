@extends('layouts.admin')

@section('title', 'إدارة المستخدمين - لوحة الإدارة')

@section('content')
<div class="content-area">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="card-title">إدارة المستخدمين</h2>
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    إضافة مستخدم جديد
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <!-- Search and Filter -->
            <div class="mb-4">
                <form method="GET" action="{{ route('admin.users') }}" class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               class="form-control" placeholder="البحث بالاسم أو البريد الإلكتروني">
                    </div>
                    <div class="col-md-3">
                        <select name="role" class="form-select">
                            <option value="">جميع الأدوار</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>مدير</option>
                            <option value="instructor" {{ request('role') == 'instructor' ? 'selected' : '' }}>مدرس</option>
                            <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>طالب</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-select">
                            <option value="">جميع الحالات</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>نشط</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>غير نشط</option>
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

            <!-- Users Table -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>المستخدم</th>
                            <th>البريد الإلكتروني</th>
                            <th>الدور</th>
                            <th>الحالة</th>
                            <th>تاريخ التسجيل</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-3">
                                        @if($user->profile_photo)
                                            <img src="{{ asset('storage/' . $user->profile_photo) }}" 
                                                 alt="{{ $user->name }}" class="rounded-circle" width="40" height="40">
                                        @else
                                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                                                 style="width: 40px; height: 40px;">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $user->name }}</div>
                                        <small class="text-muted">{{ $user->phone ?? 'لا يوجد رقم هاتف' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach($user->roles as $role)
                                    <span class="badge bg-{{ $role->name == 'admin' ? 'danger' : ($role->name == 'teacher' ? 'warning' : 'info') }}">
                                        {{ $role->name == 'admin' ? 'مدير' : ($role->name == 'teacher' ? 'مدرس' : 'طالب') }}
                                    </span>
                                @endforeach
                            </td>
                            <td>
                                @if($user->is_active)
                                    <span class="badge bg-success">نشط</span>
                                @else
                                    <span class="badge bg-secondary">غير نشط</span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.users.edit', $user) }}" 
                                       class="btn btn-sm btn-outline-primary" title="تعديل">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.users.delete', $user) }}" 
                                          style="display: inline;" onsubmit="return confirm('هل أنت متأكد من حذف هذا المستخدم؟')">
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
                            <td colspan="6" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="bi bi-people fs-1 d-block mb-3"></i>
                                    لا يوجد مستخدمين
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($users->hasPages())
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="صفحات المستخدمين">
                    {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
                </nav>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
.avatar img {
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

/* Pagination Styling */
.pagination {
    margin: 0;
    padding: 0;
    list-style: none;
    display: flex;
    align-items: center;
    gap: 5px;
}

.pagination .page-item {
    margin: 0;
}

.pagination .page-link {
    padding: 8px 12px;
    border: 1px solid #d1d5db;
    background-color: white;
    color: #374151;
    text-decoration: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.2s ease;
    min-width: 40px;
    text-align: center;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.pagination .page-link:hover {
    background-color: #f3f4f6;
    border-color: #9ca3af;
    color: #1f2937;
}

.pagination .page-item.active .page-link {
    background-color: #10b981;
    border-color: #10b981;
    color: white;
}

.pagination .page-item.disabled .page-link {
    background-color: #f9fafb;
    border-color: #e5e7eb;
    color: #9ca3af;
    cursor: not-allowed;
}

.pagination .page-link:focus {
    box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
    outline: none;
}

/* Ensure pagination icons are properly sized */
.pagination .page-link svg,
.pagination .page-link i {
    width: 16px;
    height: 16px;
    font-size: 16px;
}

/* Responsive pagination */
@media (max-width: 768px) {
    .pagination {
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .pagination .page-link {
        padding: 6px 10px;
        font-size: 13px;
        min-width: 36px;
    }
}
</style>
@endsection 