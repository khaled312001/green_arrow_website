@extends('layouts.admin')

@section('title', 'إدارة المدفوعات - لوحة الإدارة')

@section('content')
<div class="content-area">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="card-title">إدارة المدفوعات</h2>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-success" onclick="exportPayments()">
                        <i class="bi bi-download"></i>
                        تصدير
                    </button>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            <!-- Search and Filter -->
            <div class="mb-4">
                <form method="GET" action="{{ route('admin.payments') }}" class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               class="form-control" placeholder="البحث في المدفوعات">
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-select">
                            <option value="">جميع الحالات</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>في الانتظار</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>مكتمل</option>
                            <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>فشل</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>ملغي</option>
                            <option value="refunded" {{ request('status') == 'refunded' ? 'selected' : '' }}>مسترد</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="payment_method" class="form-select">
                            <option value="">جميع الطرق</option>
                            <option value="credit_card" {{ request('payment_method') == 'credit_card' ? 'selected' : '' }}>بطاقة ائتمان</option>
                            <option value="bank_transfer" {{ request('payment_method') == 'bank_transfer' ? 'selected' : '' }}>تحويل بنكي</option>
                            <option value="paypal" {{ request('payment_method') == 'paypal' ? 'selected' : '' }}>PayPal</option>
                            <option value="stripe" {{ request('payment_method') == 'stripe' ? 'selected' : '' }}>Stripe</option>
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

            <!-- Payments Table -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>رقم الدفعة</th>
                            <th>الطالب</th>
                            <th>الدورة</th>
                            <th>المبلغ</th>
                            <th>طريقة الدفع</th>
                            <th>الحالة</th>
                            <th>تاريخ الدفع</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $payment)
                        <tr>
                            <td>
                                <div>
                                    <strong>{{ $payment->payment_id }}</strong>
                                    @if($payment->invoice_number)
                                        <br><small class="text-muted">فاتورة: {{ $payment->invoice_number }}</small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if($payment->user)
                                    <div class="d-flex align-items-center">
                                        @if($payment->user->profile_photo)
                                            <img src="{{ asset('storage/' . $payment->user->profile_photo) }}" 
                                                 alt="{{ $payment->user->name }}" class="rounded-circle me-2" width="30" height="30">
                                        @else
                                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" 
                                                 style="width: 30px; height: 30px; font-size: 12px;">
                                                {{ strtoupper(substr($payment->user->name, 0, 1)) }}
                                            </div>
                                        @endif
                                        <div>
                                            <div class="fw-bold">{{ $payment->user->name }}</div>
                                            <small class="text-muted">{{ $payment->user->email }}</small>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($payment->course)
                                    <div>
                                        <div class="fw-bold">{{ $payment->course->title_ar }}</div>
                                        @if($payment->course->title_en)
                                            <small class="text-muted">{{ $payment->course->title_en }}</small>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="fw-bold text-success">{{ number_format($payment->total_amount, 2) }} ريال</span>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $payment->payment_method }}</span>
                            </td>
                            <td>
                                @if($payment->status === 'completed')
                                    <span class="badge bg-success">مكتمل</span>
                                @elseif($payment->status === 'pending')
                                    <span class="badge bg-warning">في الانتظار</span>
                                @elseif($payment->status === 'failed')
                                    <span class="badge bg-danger">فشل</span>
                                @elseif($payment->status === 'cancelled')
                                    <span class="badge bg-secondary">ملغي</span>
                                @else
                                    <span class="badge bg-info">مسترد</span>
                                @endif
                            </td>
                            <td>{{ $payment->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.payments.show', $payment) }}" 
                                       class="btn btn-sm btn-outline-info" title="عرض">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-primary" 
                                            onclick="updatePaymentStatus({{ $payment->id }})" title="تعديل الحالة">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="bi bi-credit-card-x fs-1 d-block mb-3"></i>
                                    لا توجد مدفوعات
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($payments->hasPages())
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="صفحات المدفوعات">
                    {{ $payments->appends(request()->query())->links('pagination::bootstrap-5') }}
                </nav>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Payment Status Modal -->
<div class="modal fade" id="paymentStatusModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تحديث حالة الدفعة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="paymentStatusForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="status" class="form-label">الحالة الجديدة</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="pending">في الانتظار</option>
                            <option value="completed">مكتمل</option>
                            <option value="failed">فشل</option>
                            <option value="cancelled">ملغي</option>
                            <option value="refunded">مسترد</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">تحديث</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function updatePaymentStatus(paymentId) {
    const form = document.getElementById('paymentStatusForm');
    form.action = `/admin/payments/${paymentId}/status`;
    
    const modal = new bootstrap.Modal(document.getElementById('paymentStatusModal'));
    modal.show();
}

function exportPayments() {
    // هنا يمكن إضافة منطق تصدير المدفوعات
    alert('سيتم إضافة ميزة التصدير قريباً');
}
</script>

<style>
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