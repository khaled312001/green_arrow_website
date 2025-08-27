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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // الطالب
            $table->foreignId('course_id')->constrained()->onDelete('cascade'); // الدورة
            $table->foreignId('payment_id')->nullable(); // الدفعة - سيتم إضافة القيد لاحقاً
            
            // حالة التسجيل
            $table->enum('status', ['pending', 'active', 'completed', 'cancelled', 'expired'])->default('pending');
            $table->datetime('enrolled_at'); // تاريخ التسجيل
            $table->datetime('expires_at')->nullable(); // تاريخ انتهاء الصلاحية
            $table->datetime('completed_at')->nullable(); // تاريخ إكمال الدورة
            
            // التقدم في الدورة
            $table->integer('progress_percentage')->default(0); // نسبة التقدم
            $table->integer('lessons_completed')->default(0); // عدد الدروس المكتملة
            $table->integer('total_lessons')->default(0); // إجمالي الدروس
            $table->integer('quiz_attempts')->default(0); // عدد محاولات الاختبارات
            $table->decimal('quiz_average', 5, 2)->nullable(); // متوسط درجات الاختبارات
            
            // الحضور للمحاضرات المباشرة
            $table->integer('live_sessions_attended')->default(0);
            $table->integer('total_live_sessions')->default(0);
            
            // تقييم الدورة
            $table->integer('rating')->nullable(); // تقييم الطالب للدورة (1-5)
            $table->text('review')->nullable(); // مراجعة الطالب
            $table->datetime('reviewed_at')->nullable();
            
            // الشهادة
            $table->boolean('certificate_issued')->default(false);
            $table->datetime('certificate_issued_at')->nullable();
            $table->string('certificate_number')->nullable()->unique();
            
            // آخر نشاط
            $table->datetime('last_accessed_at')->nullable();
            $table->foreignId('last_lesson_id')->nullable()->constrained('lessons')->onDelete('set null');
            
            $table->timestamps();
            
            // فهارس لتحسين الأداء
            $table->unique(['user_id', 'course_id']);
            $table->index(['status', 'enrolled_at']);
            $table->index(['progress_percentage']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
