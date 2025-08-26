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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('title_ar'); // عنوان الدرس بالعربية
            $table->string('title_en')->nullable(); // عنوان الدرس بالإنجليزية
            $table->string('slug');
            $table->text('description_ar')->nullable(); // وصف الدرس بالعربية
            $table->text('description_en')->nullable(); // وصف الدرس بالإنجليزية
            
            // نوع المحتوى
            $table->enum('type', ['video', 'pdf', 'text', 'quiz', 'assignment', 'live_session'])->default('video');
            
            // المحتوى
            $table->string('video_url')->nullable(); // رابط الفيديو
            $table->string('video_duration')->nullable(); // مدة الفيديو
            $table->string('pdf_file')->nullable(); // ملف PDF
            $table->longText('text_content')->nullable(); // محتوى نصي
            $table->json('attachments')->nullable(); // مرفقات إضافية
            
            // المحاضرات المباشرة
            $table->datetime('live_session_date')->nullable(); // موعد المحاضرة المباشرة
            $table->string('google_meet_link')->nullable(); // رابط Google Meet
            $table->string('meeting_id')->nullable(); // معرف الاجتماع
            $table->string('meeting_password')->nullable(); // كلمة مرور الاجتماع
            
            // الإعدادات
            $table->boolean('is_free')->default(false); // درس مجاني
            $table->boolean('is_published')->default(true); // منشور
            $table->integer('sort_order')->default(0); // ترتيب الدرس
            $table->integer('duration_minutes')->default(0); // مدة الدرس بالدقائق
            
            // إحصائيات
            $table->integer('views_count')->default(0);
            $table->integer('completed_count')->default(0);
            
            $table->timestamps();
            
            $table->index(['course_id', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
