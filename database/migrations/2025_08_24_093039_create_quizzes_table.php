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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('lesson_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('title_ar');
            $table->string('title_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->integer('duration_minutes')->default(30);
            $table->integer('passing_score')->default(70);
            $table->boolean('is_active')->default(true);
            $table->boolean('allow_retake')->default(true);
            $table->integer('max_attempts')->default(3);
            $table->boolean('show_results')->default(true);
            $table->boolean('randomize_questions')->default(false);
            $table->datetime('due_date')->nullable();
            $table->integer('total_questions')->default(0);
            $table->integer('total_points')->default(0);
            $table->timestamps();
            
            $table->index(['course_id', 'lesson_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
