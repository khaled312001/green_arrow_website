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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('avatar')->nullable()->after('phone');
            $table->text('bio')->nullable()->after('avatar');
            $table->date('birth_date')->nullable()->after('bio');
            $table->enum('gender', ['male', 'female'])->nullable()->after('birth_date');
            $table->string('city')->nullable()->after('gender');
            $table->string('country')->default('Saudi Arabia')->after('city');
            $table->boolean('is_active')->default(true)->after('country');
            $table->timestamp('last_login_at')->nullable()->after('is_active');
            $table->string('google_id')->nullable()->after('last_login_at');
            $table->string('status')->default('active')->after('google_id'); // active, suspended, banned
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone', 'avatar', 'bio', 'birth_date', 'gender', 
                'city', 'country', 'is_active', 'last_login_at', 
                'google_id', 'status'
            ]);
        });
    }
};
