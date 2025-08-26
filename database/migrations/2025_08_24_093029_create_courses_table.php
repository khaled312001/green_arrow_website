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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar'); // عنوان الدورة بالعربية
            $table->string('title_en')->nullable(); // عنوان الدورة بالإنجليزية
            $table->string('slug')->unique();
            $table->text('description_ar'); // وصف الدورة بالعربية
            $table->text('description_en')->nullable(); // وصف الدورة بالإنجليزية
            $table->text('objectives_ar')->nullable(); // أهداف الدورة بالعربية
            $table->text('objectives_en')->nullable(); // أهداف الدورة بالإنجليزية
            $table->text('requirements_ar')->nullable(); // متطلبات الدورة بالعربية
            $table->text('requirements_en')->nullable(); // متطلبات الدورة بالإنجليزية
            
            // العلاقات
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('instructor_id')->constrained('users')->onDelete('cascade');
            
            // التسعير
            $table->decimal('price', 8, 2)->default(0); // السعر
            $table->decimal('discount_price', 8, 2)->nullable(); // السعر بعد الخصم
            $table->boolean('is_free')->default(false); // دورة مجانية
            
            // الجدولة
            $table->datetime('start_date')->nullable(); // تاريخ البداية
            $table->datetime('end_date')->nullable(); // تاريخ النهاية
            $table->integer('duration_hours')->nullable(); // مدة الدورة بالساعات
            $table->integer('max_students')->default(50); // الحد الأقصى للطلاب
            
            // الوسائط
            $table->string('thumbnail')->nullable(); // صورة مصغرة
            $table->string('banner')->nullable(); // بانر الدورة
            $table->string('intro_video')->nullable(); // فيديو تعريفي
            
            // الإعدادات
            $table->enum('level', ['beginner', 'intermediate', 'advanced'])->default('beginner');
            $table->enum('type', ['online', 'offline', 'hybrid'])->default('online');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->boolean('is_featured')->default(false); // دورة مميزة
            $table->boolean('certificate_enabled')->default(true); // إصدار شهادة
            
            // SEO
            $table->string('meta_title_ar')->nullable();
            $table->string('meta_title_en')->nullable();
            $table->text('meta_description_ar')->nullable();
            $table->text('meta_description_en')->nullable();
            $table->text('meta_keywords_ar')->nullable();
            $table->text('meta_keywords_en')->nullable();
            
            // إحصائيات
            $table->integer('enrolled_count')->default(0);
            $table->decimal('rating', 2, 1)->default(0);
            $table->integer('reviews_count')->default(0);
            $table->integer('views_count')->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
