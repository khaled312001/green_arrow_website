<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AssignRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // تعيين دور المدير للمستخدم الأول
        $adminUser = User::where('email', 'admin@greenarrowacademy.com')->first();
        if ($adminUser) {
            $adminUser->assignRole('admin');
            echo "Admin role assigned to: " . $adminUser->email . "\n";
        }

        // تعيين دور المعلم للمستخدمين الذين لديهم دور معلم
        $teacherUsers = User::where('role', 'teacher')->get();
        foreach ($teacherUsers as $user) {
            $user->assignRole('teacher');
            echo "Teacher role assigned to: " . $user->email . "\n";
        }

        // تعيين دور الطالب للمستخدمين الذين لديهم دور طالب
        $studentUsers = User::where('role', 'student')->get();
        foreach ($studentUsers as $user) {
            $user->assignRole('student');
            echo "Student role assigned to: " . $user->email . "\n";
        }

        // تعيين دور الطالب لجميع المستخدمين الذين ليس لديهم دور محدد
        $usersWithoutRole = User::whereNull('role')->orWhere('role', '')->get();
        foreach ($usersWithoutRole as $user) {
            if (!$user->hasRole('admin') && !$user->hasRole('teacher')) {
                $user->assignRole('student');
                echo "Student role assigned to: " . $user->email . "\n";
            }
        }

        echo "Role assignment completed!\n";
    }
} 