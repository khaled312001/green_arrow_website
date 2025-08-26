<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\LessonCompletion;
use App\Models\User;

class LessonCompletionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // الحصول على المستخدم رقم 12 (الطالب)
        $user = User::find(12);
        if (!$user) {
            $this->command->error('User with ID 12 not found!');
            return;
        }

        // الحصول على تسجيل الطالب في الدورة رقم 2
        $enrollment = Enrollment::where('user_id', $user->id)
                               ->where('course_id', 2)
                               ->first();
        
        if (!$enrollment) {
            $this->command->error('Enrollment for user 12 in course 2 not found!');
            return;
        }

        // الحصول على دروس الدورة
        $lessons = Lesson::where('course_id', 2)
                        ->where('is_published', true)
                        ->orderBy('sort_order')
                        ->take(5) // إكمال أول 5 دروس فقط
                        ->get();

        foreach ($lessons as $lesson) {
            // التحقق من عدم وجود تسجيل مسبق
            $existingCompletion = LessonCompletion::where('enrollment_id', $enrollment->id)
                                                 ->where('lesson_id', $lesson->id)
                                                 ->exists();
            
            if (!$existingCompletion) {
                LessonCompletion::create([
                    'enrollment_id' => $enrollment->id,
                    'lesson_id' => $lesson->id,
                    'user_id' => $user->id,
                    'completed_at' => now()->subDays(rand(1, 7)), // اكتمال في الأيام الماضية
                    'time_spent_minutes' => rand(15, 45), // وقت عشوائي بين 15-45 دقيقة
                    'progress_percentage' => 100, // اكتمال 100%
                    'quiz_results' => null
                ]);
            }
        }

        // تحديث إحصائيات التسجيل
        $completedCount = LessonCompletion::where('enrollment_id', $enrollment->id)->count();
        $totalLessons = Lesson::where('course_id', 2)->where('is_published', true)->count();
        $progressPercentage = $totalLessons > 0 ? round(($completedCount / $totalLessons) * 100) : 0;

        $enrollment->update([
            'lessons_completed' => $completedCount,
            'total_lessons' => $totalLessons,
            'progress_percentage' => $progressPercentage,
            'last_lesson_id' => $lessons->last()->id ?? null
        ]);

        $this->command->info("Created {$completedCount} lesson completions for user {$user->name} in course 2");
        $this->command->info("Progress: {$progressPercentage}%");
    }
}
