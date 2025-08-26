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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('course_id')->nullable()->constrained('courses')->onDelete('cascade');
            $table->string('subject')->nullable();
            $table->text('content');
            $table->enum('type', ['general', 'course_question', 'technical_support', 'feedback'])->default('general');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->enum('status', ['unread', 'read', 'replied', 'closed'])->default('unread');
            $table->foreignId('parent_id')->nullable()->constrained('messages')->onDelete('cascade');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
            
            // Indexes for better performance
            $table->index(['sender_id', 'receiver_id']);
            $table->index(['course_id', 'status']);
            $table->index(['status', 'priority']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
