<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // الحصول على دور المدرب
        $teacherRole = Role::where('name', 'teacher')->first();
        
        if ($teacherRole) {
            // الحصول على ID خالد احمد
            $khalidAhmed = DB::table('users')->where('name', 'خالد احمد')->first();
            
            if ($khalidAhmed) {
                // حذف جميع المدربين باستثناء خالد احمد
                $instructorsToDelete = DB::table('model_has_roles')
                    ->where('role_id', $teacherRole->id)
                    ->where('model_type', 'App\\Models\\User')
                    ->where('model_id', '!=', $khalidAhmed->id)
                    ->get();
                
                foreach ($instructorsToDelete as $instructorRole) {
                    // حذف الدور من المستخدم
                    DB::table('model_has_roles')
                        ->where('role_id', $teacherRole->id)
                        ->where('model_type', 'App\\Models\\User')
                        ->where('model_id', $instructorRole->model_id)
                        ->delete();
                    
                    // حذف المستخدم
                    DB::table('users')->where('id', $instructorRole->model_id)->delete();
                }
                
                echo "تم حذف " . count($instructorsToDelete) . " مدرب بنجاح. تم الاحتفاظ بخالد احمد فقط.\n";
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // لا يمكن التراجع عن حذف المستخدمين بأمان
        // يمكن إضافة منطق إعادة إنشاء المدربين هنا إذا لزم الأمر
    }
};
