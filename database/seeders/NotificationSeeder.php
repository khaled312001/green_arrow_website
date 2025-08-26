<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\User;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get admin users
        $adminUsers = User::role('admin')->get();
        
        if ($adminUsers->isEmpty()) {
            // If no admin users, create notifications for user with ID 1
            $adminUsers = User::where('id', 1)->get();
        }

        foreach ($adminUsers as $admin) {
            $testNotifications = [
                [
                    'title' => 'مرحباً بك في لوحة الإدارة',
                    'message' => 'تم تسجيل دخولك بنجاح إلى لوحة إدارة أكاديمية السهم الأخضر',
                    'type' => 'success',
                    'user_id' => $admin->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => 'دورة جديدة مضافة',
                    'message' => 'تم إضافة دورة "تعلم البرمجة من الصفر" بنجاح',
                    'type' => 'info',
                    'user_id' => $admin->id,
                    'created_at' => now()->subMinutes(30),
                    'updated_at' => now()->subMinutes(30)
                ],
                [
                    'title' => 'تسجيل طالب جديد',
                    'message' => 'انضم أحمد محمد إلى أكاديمية السهم الأخضر',
                    'type' => 'info',
                    'user_id' => $admin->id,
                    'created_at' => now()->subHours(2),
                    'updated_at' => now()->subHours(2)
                ],
                [
                    'title' => 'دفعة جديدة',
                    'message' => 'تم استلام دفعة بقيمة 500 ريال من الطالب محمد أحمد',
                    'type' => 'success',
                    'user_id' => $admin->id,
                    'created_at' => now()->subHours(5),
                    'updated_at' => now()->subHours(5)
                ],
                [
                    'title' => 'رسالة تواصل جديدة',
                    'message' => 'رسالة جديدة من سارة أحمد بخصوص دورة البرمجة',
                    'type' => 'warning',
                    'user_id' => $admin->id,
                    'created_at' => now()->subDay(),
                    'updated_at' => now()->subDay()
                ],
                [
                    'title' => 'تحديث النظام',
                    'message' => 'تم تحديث النظام إلى الإصدار الجديد بنجاح',
                    'type' => 'info',
                    'user_id' => $admin->id,
                    'created_at' => now()->subDays(2),
                    'updated_at' => now()->subDays(2)
                ]
            ];

            foreach ($testNotifications as $notification) {
                Notification::create($notification);
            }
        }

        $this->command->info('تم إنشاء الإشعارات التجريبية بنجاح!');
    }
}
