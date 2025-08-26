<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // إنشاء أو العثور على دور المدرب
        $teacherRole = Role::firstOrCreate(['name' => 'teacher', 'guard_name' => 'web']);
        
        // إنشاء المدرب خالد احمد إذا لم يكن موجوداً
        $khalidAhmed = DB::table('users')->where('name', 'خالد احمد')->first();
        
        if (!$khalidAhmed) {
            $khalidId = DB::table('users')->insertGetId([
                'name' => 'خالد احمد',
                'email' => 'khalid.ahmed@greenarrowacademy.com',
                'password' => Hash::make('password'),
                'phone' => '+966501234571',
                'bio' => 'مدرب محترف متخصص في مجال التدريب والتعليم، يمتلك خبرة واسعة في تقديم الدورات التدريبية عالية الجودة.',
                'city' => 'مكة المكرمة',
                'country' => 'السعودية',
                'is_active' => true,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            // تعيين دور المدرب له
            DB::table('model_has_roles')->insert([
                'role_id' => $teacherRole->id,
                'model_type' => 'App\\Models\\User',
                'model_id' => $khalidId,
            ]);
        } else {
            $khalidId = $khalidAhmed->id;
        }
        
        // تحديث جميع الدورات لتكون منسوبة لخالد احمد
        DB::table('courses')->update([
            'instructor_id' => $khalidId,
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // لا يمكن التراجع عن هذا التغيير بأمان لأنه سيؤثر على البيانات
        // يمكن إضافة منطق التراجع هنا إذا لزم الأمر
    }
};
