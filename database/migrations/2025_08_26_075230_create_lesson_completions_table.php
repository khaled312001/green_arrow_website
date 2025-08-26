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
        Schema::create('lesson_completions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_id')->constrained()->onDelete('cascade');
            $table->foreignId('lesson_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamp('completed_at');
            $table->integer('time_spent_minutes')->nullable(); // الوقت المستغرق في الدروس
            $table->decimal('progress_percentage', 5, 2)->default(0); // نسبة التقدم في الدرس
            $table->json('quiz_results')->nullable(); // نتائج الاختبارات إذا وجدت
            $table->timestamps();

            // منع تكرار اكتمال نفس الدرس لنفس التسجيل
            $table->unique(['enrollment_id', 'lesson_id']);
            
            // فهارس للبحث السريع
            $table->index(['user_id', 'lesson_id']);
            $table->index(['enrollment_id', 'completed_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_completions');
    }
};
