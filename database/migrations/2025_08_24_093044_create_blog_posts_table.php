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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade'); // الكاتب
            
            // المحتوى
            $table->string('title_ar'); // العنوان بالعربية
            $table->string('title_en')->nullable(); // العنوان بالإنجليزية
            $table->string('slug')->unique();
            $table->text('excerpt_ar')->nullable(); // مقتطف بالعربية
            $table->text('excerpt_en')->nullable(); // مقتطف بالإنجليزية
            $table->longText('content_ar'); // المحتوى بالعربية
            $table->longText('content_en')->nullable(); // المحتوى بالإنجليزية
            
            // الوسائط
            $table->string('featured_image')->nullable(); // الصورة البارزة
            $table->json('gallery')->nullable(); // معرض صور
            
            // التصنيف
            $table->string('category')->default('general'); // التصنيف
            $table->json('tags')->nullable(); // الكلمات المفتاحية
            
            // الإعدادات
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->boolean('is_featured')->default(false); // مقال مميز
            $table->boolean('comments_enabled')->default(true);
            $table->datetime('published_at')->nullable();
            
            // SEO
            $table->string('meta_title_ar')->nullable();
            $table->string('meta_title_en')->nullable();
            $table->text('meta_description_ar')->nullable();
            $table->text('meta_description_en')->nullable();
            $table->text('meta_keywords_ar')->nullable();
            $table->text('meta_keywords_en')->nullable();
            
            // إحصائيات
            $table->integer('views_count')->default(0);
            $table->integer('likes_count')->default(0);
            $table->integer('shares_count')->default(0);
            $table->decimal('reading_time', 4, 1)->default(0); // وقت القراءة بالدقائق
            
            $table->timestamps();
            
            // فهارس
            $table->index(['status', 'published_at']);
            $table->index(['category', 'status']);
            $table->index(['is_featured', 'published_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
