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
        Schema::create('course_resources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->foreignId('lesson_id')->nullable()->constrained('lessons')->onDelete('cascade');
            $table->string('title_ar');
            $table->string('title_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->enum('type', ['pdf', 'video', 'link', 'document', 'image', 'audio'])->default('document');
            $table->string('file_path')->nullable();
            $table->string('file_name')->nullable();
            $table->string('file_size')->nullable();
            $table->string('external_url')->nullable();
            $table->boolean('is_free')->default(true);
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->integer('download_count')->default(0);
            $table->timestamps();
            
            // Indexes
            $table->index(['course_id', 'lesson_id']);
            $table->index(['type', 'is_published']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_resources');
    }
}; 