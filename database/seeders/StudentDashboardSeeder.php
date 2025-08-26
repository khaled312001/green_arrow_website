<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\LessonCompletion;
use App\Models\QuizAttempt;
use App\Models\Quiz;
use App\Models\Lesson;
use App\Models\Category;
use App\Models\Certificate;
use Illuminate\Support\Facades\Hash;

class StudentDashboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إنشاء فئات للدورات
        $categories = [
            ['name_ar' => 'البرمجة', 'name_en' => 'Programming', 'slug' => 'programming'],
            ['name_ar' => 'التصميم', 'name_en' => 'Design', 'slug' => 'design'],
            ['name_ar' => 'التسويق', 'name_en' => 'Marketing', 'slug' => 'marketing'],
            ['name_ar' => 'الأعمال', 'name_en' => 'Business', 'slug' => 'business'],
        ];

        foreach ($categories as $categoryData) {
            Category::firstOrCreate(['slug' => $categoryData['slug']], $categoryData);
        }

        // إنشاء مدرسين
        $teachers = [
            [
                'name' => 'أحمد محمد',
                'email' => 'ahmed@example.com',
                'password' => Hash::make('password'),
                'phone' => '0501234567',
                'bio' => 'مدرس محترف في مجال البرمجة',
                'is_active' => true,
            ],
            [
                'name' => 'فاطمة علي',
                'email' => 'fatima@example.com',
                'password' => Hash::make('password'),
                'phone' => '0501234568',
                'bio' => 'مدرسة محترفة في مجال التصميم',
                'is_active' => true,
            ],
        ];

        foreach ($teachers as $teacherData) {
            $teacher = User::firstOrCreate(['email' => $teacherData['email']], $teacherData);
            $teacher->assignRole('teacher');
        }

        // إنشاء طالب
        $student = User::firstOrCreate(
            ['email' => 'student@example.com'],
            [
                'name' => 'محمد الطالب',
                'password' => Hash::make('password'),
                'phone' => '0501234569',
                'bio' => 'طالب مهتم بالتعلم',
                'is_active' => true,
            ]
        );
        $student->assignRole('student');

        // إنشاء دورات
        $courses = [
            [
                'title_ar' => 'مقدمة في البرمجة',
                'title_en' => 'Introduction to Programming',
                'slug' => 'intro-programming',
                'description_ar' => 'دورة شاملة لتعلم أساسيات البرمجة',
                'description_en' => 'Comprehensive course for learning programming basics',
                'instructor_id' => User::where('email', 'ahmed@example.com')->first()->id,
                'category_id' => Category::where('slug', 'programming')->first()->id,
                'price' => 299,
                'is_free' => false,
                'status' => 'published',
            ],
            [
                'title_ar' => 'تصميم المواقع الإلكترونية',
                'title_en' => 'Web Design',
                'slug' => 'web-design',
                'description_ar' => 'تعلم تصميم المواقع الإلكترونية الحديثة',
                'description_en' => 'Learn modern web design',
                'instructor_id' => User::where('email', 'fatima@example.com')->first()->id,
                'category_id' => Category::where('slug', 'design')->first()->id,
                'price' => 199,
                'is_free' => false,
                'status' => 'published',
            ],
            [
                'title_ar' => 'التسويق الرقمي',
                'title_en' => 'Digital Marketing',
                'slug' => 'digital-marketing',
                'description_ar' => 'استراتيجيات التسويق الرقمي الفعالة',
                'description_en' => 'Effective digital marketing strategies',
                'instructor_id' => User::where('email', 'ahmed@example.com')->first()->id,
                'category_id' => Category::where('slug', 'marketing')->first()->id,
                'price' => 399,
                'is_free' => false,
                'status' => 'published',
            ],
        ];

        foreach ($courses as $courseData) {
            Course::firstOrCreate(['slug' => $courseData['slug']], $courseData);
        }

        // إنشاء دروس للدورات
        $lessons = [
            // دروس دورة البرمجة
            [
                'course_id' => Course::where('slug', 'intro-programming')->first()->id,
                'title_ar' => 'مقدمة في البرمجة',
                'title_en' => 'Introduction to Programming',
                'description_ar' => 'محتوى الدرس الأول',
                'description_en' => 'Lesson 1 content',
                'slug' => 'intro-programming-lesson-1',
                'sort_order' => 1,
                'duration_minutes' => 30,
                'type' => 'video',
            ],
            [
                'course_id' => Course::where('slug', 'intro-programming')->first()->id,
                'title_ar' => 'المتغيرات والبيانات',
                'title_en' => 'Variables and Data Types',
                'description_ar' => 'محتوى الدرس الثاني',
                'description_en' => 'Lesson 2 content',
                'slug' => 'intro-programming-lesson-2',
                'sort_order' => 2,
                'duration_minutes' => 45,
                'type' => 'video',
            ],
            [
                'course_id' => Course::where('slug', 'intro-programming')->first()->id,
                'title_ar' => 'محاضرة مباشرة - حل المشاكل',
                'title_en' => 'Live Session - Problem Solving',
                'description_ar' => 'محاضرة مباشرة',
                'description_en' => 'Live session',
                'slug' => 'intro-programming-live-session',
                'sort_order' => 3,
                'duration_minutes' => 60,
                'type' => 'live_session',
                'live_session_date' => now()->addDays(1)->setTime(14, 0, 0),
            ],
        ];

        foreach ($lessons as $lessonData) {
            Lesson::firstOrCreate([
                'course_id' => $lessonData['course_id'],
                'title_ar' => $lessonData['title_ar'],
            ], $lessonData);
        }

        // إنشاء اختبارات
        $quizzes = [
            [
                'course_id' => Course::where('slug', 'intro-programming')->first()->id,
                'title_ar' => 'اختبار أساسيات البرمجة',
                'title_en' => 'Programming Basics Quiz',
                'description_ar' => 'اختبار شامل لأساسيات البرمجة',
                'description_en' => 'Comprehensive quiz for programming basics',
                'duration_minutes' => 30,
                'passing_score' => 70,
                'is_active' => true,
            ],
        ];

        foreach ($quizzes as $quizData) {
            Quiz::firstOrCreate([
                'course_id' => $quizData['course_id'],
                'title_ar' => $quizData['title_ar'],
            ], $quizData);
        }

        // تسجيل الطالب في الدورات
        $enrollments = [
            [
                'user_id' => $student->id,
                'course_id' => Course::where('slug', 'intro-programming')->first()->id,
                'status' => 'active',
                'enrolled_at' => now()->subDays(10),
                'progress_percentage' => 65,
                'lessons_completed' => 2,
                'total_lessons' => 3,
                'total_hours_watched' => 1.25,
            ],
            [
                'user_id' => $student->id,
                'course_id' => Course::where('slug', 'web-design')->first()->id,
                'status' => 'active',
                'enrolled_at' => now()->subDays(5),
                'progress_percentage' => 30,
                'lessons_completed' => 1,
                'total_lessons' => 5,
                'total_hours_watched' => 0.5,
            ],
        ];

        foreach ($enrollments as $enrollmentData) {
            Enrollment::firstOrCreate([
                'user_id' => $enrollmentData['user_id'],
                'course_id' => $enrollmentData['course_id'],
            ], $enrollmentData);
        }

        // إضافة إكمال الدروس
        $lessonCompletions = [
            [
                'user_id' => $student->id,
                'enrollment_id' => Enrollment::where('user_id', $student->id)
                    ->where('course_id', Course::where('slug', 'intro-programming')->first()->id)
                    ->first()->id,
                'lesson_id' => Lesson::where('title_ar', 'مقدمة في البرمجة')->first()->id,
                'completed_at' => now()->subDays(8),
                'time_spent_minutes' => 30,
            ],
            [
                'user_id' => $student->id,
                'enrollment_id' => Enrollment::where('user_id', $student->id)
                    ->where('course_id', Course::where('slug', 'intro-programming')->first()->id)
                    ->first()->id,
                'lesson_id' => Lesson::where('title_ar', 'المتغيرات والبيانات')->first()->id,
                'completed_at' => now()->subDays(5),
                'time_spent_minutes' => 45,
            ],
        ];

        foreach ($lessonCompletions as $completionData) {
            LessonCompletion::firstOrCreate([
                'user_id' => $completionData['user_id'],
                'lesson_id' => $completionData['lesson_id'],
            ], $completionData);
        }

        // إضافة محاولات الاختبارات
        $quizAttempts = [
            [
                'user_id' => $student->id,
                'quiz_id' => Quiz::where('title_ar', 'اختبار أساسيات البرمجة')->first()->id,
                'score' => 85,
                'total_points' => 100,
                'percentage' => 85.00,
                'is_passed' => true,
                'started_at' => now()->subDays(3),
                'completed_at' => now()->subDays(3)->addMinutes(25),
            ],
        ];

        foreach ($quizAttempts as $attemptData) {
            QuizAttempt::firstOrCreate([
                'user_id' => $attemptData['user_id'],
                'quiz_id' => $attemptData['quiz_id'],
            ], $attemptData);
        }

        // إضافة شهادة
        $certificate = Certificate::firstOrCreate([
            'user_id' => $student->id,
            'course_id' => Course::where('slug', 'intro-programming')->first()->id,
        ], [
            'enrollment_id' => Enrollment::where('user_id', $student->id)
                ->where('course_id', Course::where('slug', 'intro-programming')->first()->id)
                ->first()->id,
            'certificate_number' => 'CERT-' . strtoupper(uniqid()),
            'issued_at' => now()->subDays(2),
            'verification_code' => strtoupper(substr(md5(uniqid()), 0, 8)),
            'is_verified' => true,
        ]);

        $this->command->info('تم إنشاء بيانات تجريبية للوحة تحكم الطالب بنجاح!');
        $this->command->info('بيانات تسجيل الدخول:');
        $this->command->info('البريد الإلكتروني: student@example.com');
        $this->command->info('كلمة المرور: password');
    }
}
