@extends('layouts.admin')

@section('title', 'رسائل التواصل - لوحة الإدارة')

@section('content')
<div class="container-fluid">
    <!-- رأس الصفحة -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                <i class="bi bi-envelope-fill text-primary me-2"></i>
                رسائل التواصل
            </h1>
            <p class="text-muted">إدارة رسائل التواصل من العملاء والزوار</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.contact.export') }}" class="btn btn-outline-success">
                <i class="bi bi-download me-1"></i>
                تصدير البيانات
            </a>
        </div>
    </div>

    <!-- إحصائيات سريعة -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                إجمالي الرسائل
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-envelope-fill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                رسائل جديدة
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['new'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-envelope-exclamation-fill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                رسائل مقروءة
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['read'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-envelope-open-fill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                تم الرد عليها
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['replied'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-check-circle-fill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- جدول الرسائل -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">قائمة الرسائل</h6>
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-funnel me-1"></i>
                    تصفية
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('admin.contact.index') }}">جميع الرسائل</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.contact.index', ['status' => 'new']) }}">رسائل جديدة</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.contact.index', ['status' => 'read']) }}">رسائل مقروءة</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.contact.index', ['status' => 'replied']) }}">تم الرد عليها</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.contact.index', ['status' => 'closed']) }}">مغلقة</a></li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            @if($messages->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>الاسم</th>
                                <th>البريد الإلكتروني</th>
                                <th>الموضوع</th>
                                <th>الحالة</th>
                                <th>تاريخ الإرسال</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($messages as $message)
                            <tr class="{{ $message->status === 'new' ? 'table-warning' : '' }}">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2">
                                            <div class="avatar-title bg-primary rounded-circle">
                                                {{ strtoupper(substr($message->name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div>
                                            <strong>{{ $message->name }}</strong>
                                            @if($message->phone)
                                                <br><small class="text-muted">{{ $message->phone }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="mailto:{{ $message->email }}" class="text-decoration-none">
                                        {{ $message->email }}
                                    </a>
                                </td>
                                <td>
                                    <span class="fw-medium">{{ $message->subject }}</span>
                                    <br>
                                    <small class="text-muted">
                                        {{ Str::limit($message->message, 50) }}
                                    </small>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $message->status_color }}">
                                        {{ $message->status_text }}
                                    </span>
                                </td>
                                <td>
                                    <div>
                                        <small class="text-muted">{{ $message->created_at->format('Y-m-d') }}</small>
                                        <br>
                                        <small class="text-muted">{{ $message->created_at->format('H:i') }}</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.contact.show', $message) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-danger"
                                                onclick="deleteMessage({{ $message->id }})">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- ترقيم الصفحات -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $messages->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox-fill text-muted" style="font-size: 4rem;"></i>
                    <h5 class="mt-3 text-muted">لا توجد رسائل</h5>
                    <p class="text-muted">لم يتم إرسال أي رسائل تواصل بعد.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal حذف الرسالة -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تأكيد الحذف</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>هل أنت متأكد من حذف هذه الرسالة؟</p>
                <p class="text-muted">لا يمكن التراجع عن هذا الإجراء.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">حذف</button>
            </div>
        </div>
    </div>
</div>

<style>
.avatar-sm {
    width: 32px;
    height: 32px;
}

.avatar-title {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
}

.table-hover tbody tr:hover {
    background-color: rgba(0,0,0,.075);
}

.border-left-primary {
    border-left: 4px solid #4e73df !important;
}

.border-left-danger {
    border-left: 4px solid #e74a3b !important;
}

.border-left-warning {
    border-left: 4px solid #f6c23e !important;
}

.border-left-success {
    border-left: 4px solid #1cc88a !important;
}
</style>

<script>
function deleteMessage(messageId) {
    if (confirm('هل أنت متأكد من حذف هذه الرسالة؟')) {
        fetch(`/admin/contact/${messageId}`, {
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
                alert('حدث خطأ أثناء حذف الرسالة');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('حدث خطأ أثناء حذف الرسالة');
        });
    }
}
</script>
@endsection 