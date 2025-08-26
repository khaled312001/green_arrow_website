<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'course_id', 'payment_id', 'invoice_number',
        'amount', 'discount_amount', 'tax_amount', 'total_amount', 'currency',
        'payment_method', 'payment_gateway', 'status', 'paid_at', 'expires_at',
        'gateway_transaction_id', 'gateway_reference', 'gateway_response',
        'billing_data', 'payment_data', 'invoice_pdf', 'refunded_amount', 'refunded_at',
        'refund_reason', 'notes', 'failure_reason'
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'expires_at' => 'datetime',
        'refunded_at' => 'datetime',
        'billing_data' => 'array',
        'payment_data' => 'array',
        'gateway_response' => 'array',
        'amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'refunded_amount' => 'decimal:2',
    ];

    /**
     * المستخدم الذي دفع
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * الدورة المدفوعة
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * التسجيل المرتبط بالدفع
     */
    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }



    /**
     * التحقق من انتهاء صلاحية الدفعة
     */
    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    /**
     * التحقق من إمكانية الاسترداد
     */
    public function canRefund(): bool
    {
        return $this->status === 'completed' && 
               $this->refunded_amount < $this->total_amount;
    }

    /**
     * حساب المبلغ القابل للاسترداد
     */
    public function getRefundableAmountAttribute(): float
    {
        return $this->total_amount - $this->refunded_amount;
    }

    /**
     * الحصول على حالة الدفع بالعربية
     */
    public function getStatusTextAttribute(): string
    {
        return match($this->status) {
            'pending' => 'في الانتظار',
            'completed' => 'مكتمل',
            'failed' => 'فشل',
            'cancelled' => 'ملغي',
            'refunded' => 'مسترد',
            default => $this->status
        };
    }

    /**
     * الحصول على طريقة الدفع بالعربية
     */
    public function getPaymentMethodTextAttribute(): string
    {
        return match($this->payment_method) {
            'online' => 'دفع إلكتروني',
            'bank_transfer' => 'تحويل بنكي',
            'cash' => 'نقداً',
            'free' => 'مجاني',
            default => $this->payment_method
        };
    }

    /**
     * المدفوعات المكتملة فقط
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * المدفوعات في الانتظار
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * المدفوعات المنتهية الصلاحية
     */
    public function scopeExpired($query)
    {
        return $query->where('expires_at', '<', now());
    }
}
