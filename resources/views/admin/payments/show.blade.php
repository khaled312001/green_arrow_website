@extends('layouts.admin')

@section('title', 'تفاصيل الدفعة - لوحة الإدارة')

@section('content')
<div class="content-area">
    <div class="row">
        <!-- Payment Details -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="card-title">تفاصيل الدفعة</h2>
                        <a href="{{ route('admin.payments') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-right"></i>
                            العودة للمدفوعات
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>معلومات الدفعة</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>رقم الدفعة:</strong></td>
                                    <td>{{ $payment->payment_id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>رقم الفاتورة:</strong></td>
                                    <td>{{ $payment->invoice_number ?? 'غير محدد' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>المبلغ:</strong></td>
                                    <td class="text-success fw-bold">{{ number_format($payment->total_amount, 2) }} ريال</td>
                                </tr>
                                <tr>
                                    <td><strong>طريقة الدفع:</strong></td>
                                    <td><span class="badge bg-info">{{ $payment->payment_method }}</span></td>
                                </tr>
                                <tr>
                                    <td><strong>الحالة:</strong></td>
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
                                </tr>
                                <tr>
                                    <td><strong>تاريخ الدفع:</strong></td>
                                    <td>{{ $payment->created_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                                @if($payment->updated_at != $payment->created_at)
                                <tr>
                                    <td><strong>آخر تحديث:</strong></td>
                                    <td>{{ $payment->updated_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        
                        <div class="col-md-6">
                            <h5>معلومات الطالب</h5>
                            @if($payment->user)
                                <div class="d-flex align-items-center mb-3">
                                    @if($payment->user->profile_photo)
                                        <img src="{{ asset('storage/' . $payment->user->profile_photo) }}" 
                                             alt="{{ $payment->user->name }}" class="rounded-circle me-3" width="60" height="60">
                                    @else
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" 
                                             style="width: 60px; height: 60px; font-size: 24px;">
                                            {{ strtoupper(substr($payment->user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <h6 class="mb-1">{{ $payment->user->name }}</h6>
                                        <p class="text-muted mb-1">{{ $payment->user->email }}</p>
                                        <small class="text-muted">{{ $payment->user->phone ?? 'لا يوجد رقم هاتف' }}</small>
                                    </div>
                                </div>
                            @else
                                <p class="text-muted">لا توجد معلومات الطالب</p>
                            @endif
                            
                            <h5 class="mt-4">معلومات الدورة</h5>
                            @if($payment->course)
                                <div class="card border">
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $payment->course->title_ar }}</h6>
                                        @if($payment->course->title_en)
                                            <p class="text-muted small">{{ $payment->course->title_en }}</p>
                                        @endif
                                        @if($payment->course->category)
                                            <span class="badge" style="background-color: {{ $payment->course->category->color }}; color: white;">
                                                {{ $payment->course->category->name_ar }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <p class="text-muted">لا توجد معلومات الدورة</p>
                            @endif
                        </div>
                    </div>
                    
                    @if($payment->notes)
                        <div class="mt-4">
                            <h5>ملاحظات</h5>
                            <div class="alert alert-info">
                                {{ $payment->notes }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Payment Actions -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">الإجراءات</h3>
                </div>
                
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-primary" onclick="updatePaymentStatus({{ $payment->id }})">
                            <i class="bi bi-pencil"></i>
                            تحديث الحالة
                        </button>
                        
                        @if($payment->status === 'completed')
                            <button type="button" class="btn btn-warning" onclick="refundPayment({{ $payment->id }})">
                                <i class="bi bi-arrow-return-left"></i>
                                استرداد المبلغ
                            </button>
                        @endif
                        
                        <a href="{{ route('admin.payments') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-right"></i>
                            العودة للمدفوعات
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Payment History -->
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">سجل التغييرات</h3>
                </div>
                
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">تم إنشاء الدفعة</h6>
                                <small class="text-muted">{{ $payment->created_at->format('Y-m-d H:i') }}</small>
                            </div>
                        </div>
                        
                        @if($payment->updated_at != $payment->created_at)
                        <div class="timeline-item">
                            <div class="timeline-marker bg-info"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">تم تحديث الدفعة</h6>
                                <small class="text-muted">{{ $payment->updated_at->format('Y-m-d H:i') }}</small>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
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
                            <option value="pending" {{ $payment->status === 'pending' ? 'selected' : '' }}>في الانتظار</option>
                            <option value="completed" {{ $payment->status === 'completed' ? 'selected' : '' }}>مكتمل</option>
                            <option value="failed" {{ $payment->status === 'failed' ? 'selected' : '' }}>فشل</option>
                            <option value="cancelled" {{ $payment->status === 'cancelled' ? 'selected' : '' }}>ملغي</option>
                            <option value="refunded" {{ $payment->status === 'refunded' ? 'selected' : '' }}>مسترد</option>
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

function refundPayment(paymentId) {
    if (confirm('هل أنت متأكد من استرداد هذا المبلغ؟')) {
        // هنا يمكن إضافة منطق الاسترداد
        alert('سيتم إضافة ميزة الاسترداد قريباً');
    }
}
</script>

<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -35px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
}

.timeline-item:not(:last-child)::before {
    content: '';
    position: absolute;
    left: -29px;
    top: 17px;
    width: 2px;
    height: calc(100% + 10px);
    background-color: #e5e7eb;
}

.badge {
    font-size: 0.75rem;
    padding: 0.375rem 0.75rem;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
}

.table-borderless td {
    border: none;
    padding: 0.5rem 0;
}
</style>
@endsection 