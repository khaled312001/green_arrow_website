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
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
            $table->string('question_ar');
            $table->string('question_en')->nullable();
            $table->enum('type', ['multiple_choice', 'true_false', 'fill_blank', 'essay'])->default('multiple_choice');
            $table->json('options')->nullable(); // للأسئلة متعددة الخيارات
            $table->string('correct_answer')->nullable();
            $table->text('explanation_ar')->nullable();
            $table->text('explanation_en')->nullable();
            $table->integer('points')->default(1);
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['quiz_id', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_questions');
    }
};
