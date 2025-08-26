<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إنشاء الأدوار الأساسية
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $teacherRole = Role::firstOrCreate(['name' => 'teacher', 'guard_name' => 'web']);
        $studentRole = Role::firstOrCreate(['name' => 'student', 'guard_name' => 'web']);
        
        echo "Roles created successfully!\n";
        echo "Admin role: " . ($adminRole ? 'Created' : 'Already exists') . "\n";
        echo "Teacher role: " . ($teacherRole ? 'Created' : 'Already exists') . "\n";
        echo "Student role: " . ($studentRole ? 'Created' : 'Already exists') . "\n";
    }
} 