<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CourseResource;
use App\Models\Course;
use App\Models\Lesson;

class CourseResourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::all();

        foreach ($courses as $course) {
            // ملحقات عامة للدورة
            CourseResource::create([
                'course_id' => $course->id,
                'lesson_id' => null,
                'title_ar' => 'ملف PDF شامل للدورة',
                'title_en' => 'Complete Course PDF',
                'description_ar' => 'ملف PDF يحتوي على جميع محتويات الدورة بشكل منظم',
                'description_en' => 'A comprehensive PDF containing all course content in an organized manner',
                'type' => 'pdf',
                'file_path' => 'course-resources/sample-course.pdf',
                'file_name' => 'course-complete.pdf',
                'file_size' => '2048576', // 2MB
                'is_free' => true,
                'is_published' => true,
                'sort_order' => 1,
            ]);

            CourseResource::create([
                'course_id' => $course->id,
                'lesson_id' => null,
                'title_ar' => 'ملاحظات مهمة',
                'title_en' => 'Important Notes',
                'description_ar' => 'ملاحظات وتلميحات مهمة للدورة',
                'description_en' => 'Important notes and tips for the course',
                'type' => 'document',
                'file_path' => 'course-resources/notes.docx',
                'file_name' => 'course-notes.docx',
                'file_size' => '512000', // 500KB
                'is_free' => true,
                'is_published' => true,
                'sort_order' => 2,
            ]);

            CourseResource::create([
                'course_id' => $course->id,
                'lesson_id' => null,
                'title_ar' => 'روابط مفيدة',
                'title_en' => 'Useful Links',
                'description_ar' => 'مجموعة من الروابط المفيدة للتعلم الإضافي',
                'description_en' => 'A collection of useful links for additional learning',
                'type' => 'link',
                'external_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'is_free' => true,
                'is_published' => true,
                'sort_order' => 3,
            ]);

            // ملحقات للدروس
            $lessons = $course->lessons()->take(3)->get();
            foreach ($lessons as $index => $lesson) {
                CourseResource::create([
                    'course_id' => $course->id,
                    'lesson_id' => $lesson->id,
                    'title_ar' => "ملف PDF للدرس {$lesson->title_ar}",
                    'title_en' => "PDF for lesson {$lesson->title_en}",
                    'description_ar' => "ملف PDF يحتوي على محتوى الدرس {$lesson->title_ar}",
                    'description_en' => "PDF file containing the content of lesson {$lesson->title_en}",
                    'type' => 'pdf',
                    'file_path' => "course-resources/lesson-{$lesson->id}.pdf",
                    'file_name' => "lesson-{$lesson->id}.pdf",
                    'file_size' => '1024000', // 1MB
                    'is_free' => true,
                    'is_published' => true,
                    'sort_order' => $index + 1,
                ]);

                CourseResource::create([
                    'course_id' => $course->id,
                    'lesson_id' => $lesson->id,
                    'title_ar' => "ملاحظات الدرس {$lesson->title_ar}",
                    'title_en' => "Notes for lesson {$lesson->title_en}",
                    'description_ar' => "ملاحظات مهمة من الدرس {$lesson->title_ar}",
                    'description_en' => "Important notes from lesson {$lesson->title_en}",
                    'type' => 'document',
                    'file_path' => "course-resources/lesson-notes-{$lesson->id}.docx",
                    'file_name' => "lesson-notes-{$lesson->id}.docx",
                    'file_size' => '256000', // 250KB
                    'is_free' => true,
                    'is_published' => true,
                    'sort_order' => $index + 2,
                ]);
            }

            // ملفات صوتية
            CourseResource::create([
                'course_id' => $course->id,
                'lesson_id' => null,
                'title_ar' => 'ملف صوتي للدورة',
                'title_en' => 'Course Audio File',
                'description_ar' => 'ملف صوتي يحتوي على شرح الدورة',
                'description_en' => 'Audio file containing course explanation',
                'type' => 'audio',
                'file_path' => 'course-resources/course-audio.mp3',
                'file_name' => 'course-audio.mp3',
                'file_size' => '52428800', // 50MB
                'is_free' => false,
                'is_published' => true,
                'sort_order' => 4,
            ]);

            // صور توضيحية
            CourseResource::create([
                'course_id' => $course->id,
                'lesson_id' => null,
                'title_ar' => 'صور توضيحية',
                'title_en' => 'Illustrative Images',
                'description_ar' => 'مجموعة من الصور التوضيحية للدورة',
                'description_en' => 'A collection of illustrative images for the course',
                'type' => 'image',
                'file_path' => 'course-resources/images.zip',
                'file_name' => 'course-images.zip',
                'file_size' => '10485760', // 10MB
                'is_free' => true,
                'is_published' => true,
                'sort_order' => 5,
            ]);
        }

        $this->command->info('تم إنشاء ملحقات الدورات بنجاح!');
    }
} 