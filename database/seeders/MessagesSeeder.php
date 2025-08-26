<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\User;
use App\Models\Course;

class MessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = User::role('student')->get();
        $teachers = User::role('teacher')->get();
        $admins = User::role('admin')->get();
        $courses = Course::all();

        if ($students->isEmpty() || $teachers->isEmpty()) {
            $this->command->warn('لا توجد طلاب أو معلمين لإنشاء المراسلات');
            return;
        }

        // رسائل من الطلاب للمعلمين
        foreach ($students as $student) {
            $enrolledCourses = $student->enrolledCourses;
            
            foreach ($enrolledCourses->take(2) as $course) {
                $teacher = $course->instructor;
                
                // رسالة سؤال عن الدورة
                Message::create([
                    'sender_id' => $student->id,
                    'receiver_id' => $teacher->id,
                    'course_id' => $course->id,
                    'subject' => 'سؤال عن الدورة: ' . $course->title_ar,
                    'content' => 'مرحباً، لدي سؤال حول الدرس الثالث في الدورة. هل يمكنك توضيح النقطة المتعلقة بـ...',
                    'type' => 'course_question',
                    'priority' => 'medium',
                    'status' => 'unread',
                ]);

                // رسالة دعم فني
                Message::create([
                    'sender_id' => $student->id,
                    'receiver_id' => $teacher->id,
                    'course_id' => $course->id,
                    'subject' => 'مشكلة تقنية في الدورة',
                    'content' => 'أواجه مشكلة في تحميل ملفات الدورة. هل يمكنك مساعدتي؟',
                    'type' => 'technical_support',
                    'priority' => 'high',
                    'status' => 'read',
                    'read_at' => now()->subHours(2),
                ]);

                // رسالة تقييم
                Message::create([
                    'sender_id' => $student->id,
                    'receiver_id' => $teacher->id,
                    'course_id' => $course->id,
                    'subject' => 'تقييم الدورة',
                    'content' => 'الدورة ممتازة جداً! أحببت طريقة الشرح والتنظيم. شكراً لك',
                    'type' => 'feedback',
                    'priority' => 'low',
                    'status' => 'replied',
                ]);

                // رد من المعلم
                Message::create([
                    'sender_id' => $teacher->id,
                    'receiver_id' => $student->id,
                    'course_id' => $course->id,
                    'subject' => 'رد: تقييم الدورة',
                    'content' => 'شكراً لك على التقييم الإيجابي! يسعدني أن الدورة نالت إعجابك. إذا كان لديك أي أسئلة أخرى، لا تتردد في التواصل معي.',
                    'type' => 'feedback',
                    'priority' => 'low',
                    'status' => 'unread',
                    'parent_id' => Message::where('sender_id', $student->id)
                        ->where('type', 'feedback')
                        ->where('course_id', $course->id)
                        ->first()->id,
                ]);
            }
        }

        // رسائل من الطلاب للإدارة
        foreach ($students->take(3) as $student) {
            Message::create([
                'sender_id' => $student->id,
                'receiver_id' => $admins->first()->id,
                'course_id' => null,
                'subject' => 'استفسار عام',
                'content' => 'أريد معرفة المزيد عن الدورات الجديدة المتاحة في الأكاديمية',
                'type' => 'general',
                'priority' => 'medium',
                'status' => 'unread',
            ]);
        }

        // رسائل من المعلمين للإدارة
        foreach ($teachers as $teacher) {
            Message::create([
                'sender_id' => $teacher->id,
                'receiver_id' => $admins->first()->id,
                'course_id' => null,
                'subject' => 'طلب إضافة دورة جديدة',
                'content' => 'أريد إضافة دورة جديدة في مجال تخصصي. هل يمكنني الحصول على الموافقة؟',
                'type' => 'general',
                'priority' => 'high',
                'status' => 'read',
                'read_at' => now()->subDays(1),
            ]);
        }

        // رسائل عاجلة
        Message::create([
            'sender_id' => $students->first()->id,
            'receiver_id' => $admins->first()->id,
            'course_id' => null,
            'subject' => 'مشكلة عاجلة في الحساب',
            'content' => 'لا أستطيع الوصول لحسابي منذ الصباح. هذه مشكلة عاجلة لأن لدي اختبار اليوم',
            'type' => 'technical_support',
            'priority' => 'urgent',
            'status' => 'unread',
        ]);

        $this->command->info('تم إنشاء المراسلات بنجاح!');
    }
}
