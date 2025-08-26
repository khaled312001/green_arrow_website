<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\LessonCompletion;
use App\Models\Certificate;

class TestCourseCompletionSeeder extends Seeder
{
    public function run()
    {
        // إنشاء طالب للاختبار
        $student = User::firstOrCreate(
            ['email' => 'test@student.com'],
            [
                'name' => 'طالب الاختبار',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        // إضافة دور الطالب
        $student->assignRole('student');

        // الحصول على دورة موجودة أو إنشاء واحدة
        $course = Course::first();
        if (!$course) {
            $course = Course::create([
                'title_ar' => 'دورة اختبار الإكمال',
                'title_en' => 'Test Completion Course',
                'slug' => 'test-completion-course',
                'description_ar' => 'دورة لاختبار نظام إكمال الدورة',
                'description_en' => 'Course to test completion system',
                'category_id' => 1,
                'instructor_id' => 1,
                'price' => 100,
                'is_free' => false,
                'status' => 'published',
                'certificate_enabled' => true,
            ]);
        }

        // إنشاء دروس للدورة
        $lessons = [];
        for ($i = 1; $i <= 5; $i++) {
            $lesson = Lesson::firstOrCreate(
                [
                    'course_id' => $course->id,
                    'title_ar' => "درس اختبار {$i}",
                    'sort_order' => $i,
                ],
                [
                    'title_en' => "Test Lesson {$i}",
                    'slug' => "test-lesson-{$i}",
                    'description_ar' => "وصف درس اختبار {$i}",
                    'description_en' => "Description for test lesson {$i}",
                    'type' => 'video',
                    'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                    'duration_minutes' => 30,
                    'is_published' => true,
                ]
            );
            $lessons[] = $lesson;
        }

        // إنشاء تسجيل في الدورة
        $enrollment = Enrollment::firstOrCreate(
            [
                'user_id' => $student->id,
                'course_id' => $course->id,
            ],
            [
                'status' => 'active',
                'enrolled_at' => now(),
                'progress_percentage' => 0,
                'lessons_completed' => 0,
                'total_lessons' => count($lessons),
                'activated_at' => now(),
            ]
        );

        // إكمال جميع الدروس
        foreach ($lessons as $lesson) {
            LessonCompletion::firstOrCreate(
                [
                    'user_id' => $student->id,
                    'enrollment_id' => $enrollment->id,
                    'lesson_id' => $lesson->id,
                ],
                [
                    'completed_at' => now(),
                ]
            );
        }

        // تحديث التقدم إلى 100%
        $enrollment->update([
            'progress_percentage' => 100,
            'lessons_completed' => count($lessons),
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        // إنشاء شهادة
        $certificate = Certificate::firstOrCreate(
            [
                'user_id' => $student->id,
                'course_id' => $course->id,
                'enrollment_id' => $enrollment->id,
            ],
            [
                'certificate_number' => 'GA-' . date('Y') . '-' . str_pad($enrollment->id, 6, '0', STR_PAD_LEFT),
                'issued_at' => now(),
                'verification_code' => strtoupper(substr(md5(uniqid()), 0, 8)),
            ]
        );

        // تحديث حالة الشهادة في التسجيل
        $enrollment->update([
            'certificate_issued' => true,
            'certificate_issued_at' => now(),
            'certificate_number' => $certificate->certificate_number,
        ]);

        $this->command->info('تم إنشاء بيانات اختبار إكمال الدورة بنجاح!');
        $this->command->info("الطالب: {$student->email}");
        $this->command->info("الدورة: {$course->title_ar}");
        $this->command->info("نسبة الإكمال: 100%");
        $this->command->info("رقم الشهادة: {$certificate->certificate_number}");
    }
} 