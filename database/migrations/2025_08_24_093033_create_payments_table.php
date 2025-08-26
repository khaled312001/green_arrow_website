<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // الطالب
            $table->foreignId('course_id')->constrained()->onDelete('cascade'); // الدورة
            
            // بيانات الدفع
            $table->string('payment_id')->unique(); // معرف الدفعة الفريد
            $table->string('invoice_number')->unique(); // رقم الفاتورة
            $table->decimal('amount', 8, 2); // المبلغ
            $table->decimal('discount_amount', 8, 2)->default(0); // قيمة الخصم
            $table->decimal('tax_amount', 8, 2)->default(0); // قيمة الضريبة
            $table->decimal('total_amount', 8, 2); // المبلغ الإجمالي
            $table->string('currency', 3)->default('SAR'); // العملة
            
            // طريقة الدفع
            $table->enum('payment_method', ['online', 'bank_transfer', 'cash', 'free'])->default('online');
            $table->enum('payment_gateway', ['paytabs', 'hyperpay', 'stripe', 'manual'])->nullable();
            
            // حالة الدفع
            $table->enum('status', ['pending', 'completed', 'failed', 'cancelled', 'refunded'])->default('pending');
            $table->datetime('paid_at')->nullable(); // تاريخ الدفع
            $table->datetime('expires_at')->nullable(); // تاريخ انتهاء صلاحية الدفع
            
            // بيانات البوابة الخارجية
            $table->string('gateway_transaction_id')->nullable(); // معرف المعاملة من البوابة
            $table->string('gateway_reference')->nullable(); // مرجع البوابة
            $table->json('gateway_response')->nullable(); // استجابة البوابة
            
            // بيانات الفاتورة
            $table->json('billing_data')->nullable(); // بيانات الفوترة
            $table->string('invoice_pdf')->nullable(); // ملف الفاتورة PDF
            
            // الاسترداد
            $table->decimal('refunded_amount', 8, 2)->default(0);
            $table->datetime('refunded_at')->nullable();
            $table->string('refund_reason')->nullable();
            
            // ملاحظات
            $table->text('notes')->nullable(); // ملاحظات إدارية
            $table->text('failure_reason')->nullable(); // سبب فشل الدفع
            
            $table->timestamps();
            
            // فهارس
            $table->index(['status', 'paid_at']);
            $table->index(['payment_method', 'status']);
            $table->index(['user_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
