@extends('layouts.admin')

@section('title', 'عرض الرسالة - لوحة الإدارة')

@section('content')
<div class="container-fluid">
    <!-- رأس الصفحة -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                <i class="bi bi-envelope-open-fill text-primary me-2"></i>
                عرض الرسالة
            </h1>
            <p class="text-muted">تفاصيل رسالة التواصل</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.contact.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>
                العودة للقائمة
            </a>
        </div>
    </div>

    <div class="row">
        <!-- تفاصيل الرسالة -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">تفاصيل الرسالة</h6>
                    <span class="badge bg-{{ $message->status_color }} fs-6">
                        {{ $message->status_text }}
                    </span>
                </div>
                <div class="card-body">
                    <!-- معلومات المرسل -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-lg me-3">
                                    <div class="avatar-title bg-primary rounded-circle">
                                        {{ strtoupper(substr($message->name, 0, 1)) }}
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-1">{{ $message->name }}</h5>
                                    <p class="text-muted mb-0">
                                        <i class="bi bi-envelope me-1"></i>
                                        <a href="mailto:{{ $message->email }}" class="text-decoration-none">
                                            {{ $message->email }}
                                        </a>
                                    </p>
                                    @if($message->phone)
                                        <p class="text-muted mb-0">
                                            <i class="bi bi-telephone me-1"></i>
                                            <a href="tel:{{ $message->phone }}" class="text-decoration-none">
                                                {{ $message->phone }}
                                            </a>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-md-end">
                                <p class="text-muted mb-1">
                                    <strong>تاريخ الإرسال:</strong><br>
                                    {{ $message->created_at->format('Y-m-d H:i:s') }}
                                </p>
                                @if($message->read_at)
                                    <p class="text-muted mb-1">
                                        <strong>تاريخ القراءة:</strong><br>
                                        {{ $message->read_at->format('Y-m-d H:i:s') }}
                                    </p>
                                @endif
                                @if($message->replied_at)
                                    <p class="text-muted mb-1">
                                        <strong>تاريخ الرد:</strong><br>
                                        {{ $message->replied_at->format('Y-m-d H:i:s') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- الموضوع -->
                    <div class="mb-4">
                        <h6 class="text-primary mb-2">الموضوع:</h6>
                        <div class="p-3 bg-light rounded">
                            <strong>{{ $message->subject }}</strong>
                        </div>
                    </div>

                    <!-- محتوى الرسالة -->
                    <div class="mb-4">
                        <h6 class="text-primary mb-2">محتوى الرسالة:</h6>
                        <div class="p-3 bg-light rounded" style="min-height: 150px;">
                            {!! nl2br(e($message->message)) !!}
                        </div>
                    </div>

                    <!-- ملاحظات المدير -->
                    @if($message->admin_notes)
                        <div class="mb-4">
                            <h6 class="text-warning mb-2">ملاحظات المدير:</h6>
                            <div class="p-3 bg-warning bg-opacity-10 rounded">
                                {!! nl2br(e($message->admin_notes)) !!}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- لوحة التحكم -->
        <div class="col-lg-4">
            <!-- تحديث الحالة -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">تحديث الحالة</h6>
                </div>
                <div class="card-body">
                    <form id="statusForm">
                        <div class="mb-3">
                            <label for="status" class="form-label">الحالة</label>
                            <select class="form-select" id="status" name="status">
                                <option value="new" {{ $message->status === 'new' ? 'selected' : '' }}>جديد</option>
                                <option value="read" {{ $message->status === 'read' ? 'selected' : '' }}>مقروء</option>
                                <option value="replied" {{ $message->status === 'replied' ? 'selected' : '' }}>تم الرد</option>
                                <option value="closed" {{ $message->status === 'closed' ? 'selected' : '' }}>مغلق</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="admin_notes" class="form-label">ملاحظات المدير</label>
                            <textarea class="form-control" id="admin_notes" name="admin_notes" rows="4" placeholder="أضف ملاحظاتك هنا...">{{ $message->admin_notes }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-check-circle me-1"></i>
                            تحديث الحالة
                        </button>
                    </form>
                </div>
            </div>

            <!-- إجراءات سريعة -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">إجراءات سريعة</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="mailto:{{ $message->email }}?subject=رد على: {{ $message->subject }}" 
                           class="btn btn-outline-primary">
                            <i class="bi bi-reply me-1"></i>
                            الرد عبر البريد الإلكتروني
                        </a>
                        @if($message->phone)
                            <a href="tel:{{ $message->phone }}" class="btn btn-outline-success">
                                <i class="bi bi-telephone me-1"></i>
                                الاتصال بالهاتف
                            </a>
                        @endif
                        <button type="button" class="btn btn-outline-danger" onclick="deleteMessage({{ $message->id }})">
                            <i class="bi bi-trash me-1"></i>
                            حذف الرسالة
                        </button>
                    </div>
                </div>
            </div>

            <!-- معلومات إضافية -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">معلومات إضافية</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <h4 class="text-primary mb-1">{{ $message->created_at->diffForHumans() }}</h4>
                                <small class="text-muted">منذ الإرسال</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <h4 class="text-success mb-1">{{ $message->id }}</h4>
                            <small class="text-muted">رقم الرسالة</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.avatar-lg {
    width: 60px;
    height: 60px;
}

.avatar-title {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 1.5rem;
}

.bg-opacity-10 {
    background-color: rgba(255, 193, 7, 0.1) !important;
}
</style>

<script>
document.getElementById('statusForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch(`/admin/contact/{{ $message->id }}/status`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            status: formData.get('status'),
            admin_notes: formData.get('admin_notes')
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // تحديث الحالة في الصفحة
            const statusBadge = document.querySelector('.badge');
            statusBadge.className = `badge bg-${data.status_color} fs-6`;
            statusBadge.textContent = data.status_text;
            
            // إظهار رسالة نجاح
            alert('تم تحديث حالة الرسالة بنجاح');
        } else {
            alert('حدث خطأ أثناء تحديث الحالة');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('حدث خطأ أثناء تحديث الحالة');
    });
});

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
                window.location.href = '{{ route("admin.contact.index") }}';
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