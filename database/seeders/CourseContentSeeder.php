<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Category;
use App\Models\User;

class CourseContentSeeder extends Seeder
{
    public function run()
    {
        // تحديث الدورة رقم 2 بمحتوى كامل
        $course = Course::find(2);
        if (!$course) {
            $this->command->error('Course ID 2 not found!');
            return;
        }

        // تحديث معلومات الدورة
        $course->update([
            'title_ar' => 'إدارة الفرق والقيادة الفعالة',
            'title_en' => 'Team Management & Effective Leadership',
            'description_ar' => 'دورة شاملة في تطوير مهارات القيادة والإدارة الحديثة مع التركيز على إدارة الفرق بكفاءة وحل المشكلات وتحفيز الموظفين. ستتعلم أحدث أساليب القيادة الفعالة وأدوات إدارة المشاريع.',
            'objectives_ar' => '• فهم أساسيات القيادة الفعالة وأنماط القيادة المختلفة
• تطوير مهارات إدارة الفرق وتحفيز الموظفين
• تعلم أساليب حل المشكلات واتخاذ القرارات
• إتقان مهارات التواصل والتفاوض
• تطبيق أدوات إدارة المشاريع الحديثة
• تطوير الاستراتيجيات التنظيمية',
            'requirements_ar' => '• لا توجد متطلبات مسبقة - مناسبة لجميع المستويات
• الرغبة في تطوير المهارات القيادية
• الاستعداد للتعلم والتطبيق العملي
• خبرة عمل أساسية (مفضلة وليست مطلوبة)',
            'duration_hours' => 30,
            'level' => 'beginner',
            'is_featured' => true,
            'status' => 'published'
        ]);

        // حذف الدروس الموجودة مسبقاً
        $course->lessons()->delete();

        // إضافة الدروس الجديدة
        $lessons = [
            [
                'title_ar' => 'مقدمة في القيادة والإدارة',
                'description_ar' => 'نظرة عامة على مفهوم القيادة والإدارة، الفرق بين القائد والمدير، وأهمية القيادة الفعالة في المنظمات الحديثة.',
                'type' => 'video',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'duration_minutes' => 45,
                'sort_order' => 1,
                'is_published' => true,
                'is_free' => true
            ],
            [
                'title_ar' => 'أنماط القيادة المختلفة',
                'description_ar' => 'استكشاف أنماط القيادة المختلفة: القيادة الديمقراطية، الاستبدادية، الحرة، والتحويلية. متى وكيف تستخدم كل نمط.',
                'type' => 'video',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'duration_minutes' => 60,
                'sort_order' => 2,
                'is_published' => true,
                'is_free' => false
            ],
            [
                'title_ar' => 'بناء وإدارة الفرق الفعالة',
                'description_ar' => 'كيفية بناء فريق عمل فعال، مراحل تطور الفريق، أدوار أعضاء الفريق، وإدارة ديناميكيات الفريق.',
                'type' => 'video',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'duration_minutes' => 75,
                'sort_order' => 3,
                'is_published' => true,
                'is_free' => false
            ],
            [
                'title_ar' => 'مهارات التواصل القيادي',
                'description_ar' => 'تطوير مهارات التواصل الفعال، الاستماع النشط، تقديم التغذية الراجعة، والتواصل مع مختلف أنواع الشخصيات.',
                'type' => 'video',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'duration_minutes' => 50,
                'sort_order' => 4,
                'is_published' => true,
                'is_free' => false
            ],
            [
                'title_ar' => 'تحفيز الموظفين وإدارة الأداء',
                'description_ar' => 'نظريات التحفيز، كيفية تحفيز الموظفين، إدارة الأداء، وتطوير خطط التطوير المهني.',
                'type' => 'video',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'duration_minutes' => 65,
                'sort_order' => 5,
                'is_published' => true,
                'is_free' => false
            ],
            [
                'title_ar' => 'حل المشكلات واتخاذ القرارات',
                'description_ar' => 'طرق حل المشكلات المنهجية، أدوات اتخاذ القرارات، تحليل المخاطر، وتطوير الحلول الإبداعية.',
                'type' => 'video',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'duration_minutes' => 55,
                'sort_order' => 6,
                'is_published' => true,
                'is_free' => false
            ],
            [
                'title_ar' => 'إدارة الصراعات والتفاوض',
                'description_ar' => 'فهم مصادر الصراعات، استراتيجيات حل الصراعات، مهارات التفاوض، وإدارة الخلافات في مكان العمل.',
                'type' => 'video',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'duration_minutes' => 70,
                'sort_order' => 7,
                'is_published' => true,
                'is_free' => false
            ],
            [
                'title_ar' => 'إدارة التغيير والابتكار',
                'description_ar' => 'كيفية قيادة التغيير في المنظمة، إدارة مقاومة التغيير، تعزيز ثقافة الابتكار، والتكيف مع التحديات الجديدة.',
                'type' => 'video',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'duration_minutes' => 60,
                'sort_order' => 8,
                'is_published' => true,
                'is_free' => false
            ],
            [
                'title_ar' => 'التخطيط الاستراتيجي وإدارة المشاريع',
                'description_ar' => 'أساسيات التخطيط الاستراتيجي، إدارة المشاريع، تحديد الأهداف، وقياس النتائج.',
                'type' => 'video',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'duration_minutes' => 80,
                'sort_order' => 9,
                'is_published' => true,
                'is_free' => false
            ],
            [
                'title_ar' => 'الذكاء العاطفي في القيادة',
                'description_ar' => 'تطوير الذكاء العاطفي، إدارة المشاعر، فهم مشاعر الآخرين، وبناء علاقات قوية في العمل.',
                'type' => 'video',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'duration_minutes' => 45,
                'sort_order' => 10,
                'is_published' => true,
                'is_free' => false
            ],
            [
                'title_ar' => 'إدارة الوقت وتحديد الأولويات',
                'description_ar' => 'تقنيات إدارة الوقت الفعالة، تحديد الأولويات، التخطيط اليومي، وتجنب التسويف.',
                'type' => 'video',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'duration_minutes' => 50,
                'sort_order' => 11,
                'is_published' => true,
                'is_free' => false
            ],
            [
                'title_ar' => 'التطوير المهني والقيادة المستدامة',
                'description_ar' => 'تطوير خطة التطوير المهني، القيادة المستدامة، التوازن بين العمل والحياة، والاستمرار في التعلم.',
                'type' => 'video',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'duration_minutes' => 60,
                'sort_order' => 12,
                'is_published' => true,
                'is_free' => false
            ],
            [
                'title_ar' => 'دليل القيادة الفعالة - PDF',
                'description_ar' => 'دليل شامل يحتوي على جميع النقاط المهمة في القيادة الفعالة، نماذج عملية، وقوالب جاهزة للاستخدام.',
                'type' => 'pdf',
                'text_content' => 'هذا الدليل يحتوي على:
• ملخص شامل لجميع الدروس
• نماذج عملية للقيادة
• قوالب جاهزة للاستخدام
• نصائح وتوصيات عملية
• مراجع إضافية للقراءة',
                'duration_minutes' => 30,
                'sort_order' => 13,
                'is_published' => true,
                'is_free' => false
            ],
            [
                'title_ar' => 'ورشة عمل تطبيقية - إدارة الفرق',
                'description_ar' => 'ورشة عمل تفاعلية لتطبيق ما تم تعلمه في إدارة الفرق، مع حالات عملية وتمارين جماعية.',
                'type' => 'video',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'duration_minutes' => 90,
                'sort_order' => 14,
                'is_published' => true,
                'is_free' => false
            ],
            [
                'title_ar' => 'الاختبار النهائي والتقييم',
                'description_ar' => 'اختبار شامل لتقييم مدى استيعاب المحتوى، مع مراجعة شاملة للمفاهيم الرئيسية.',
                'type' => 'text',
                'text_content' => 'الاختبار النهائي يتضمن:
• أسئلة متعددة الخيارات
• حالات عملية للتحليل
• تقييم ذاتي للمهارات
• خطة تطوير شخصية
• شهادة إتمام الدورة',
                'duration_minutes' => 45,
                'sort_order' => 15,
                'is_published' => true,
                'is_free' => false
            ]
        ];

        foreach ($lessons as $lessonData) {
            $lesson = new Lesson($lessonData);
            $lesson->course_id = $course->id;
            $lesson->save();
        }

        $this->command->info('Course content has been successfully updated!');
        $this->command->info('Added ' . count($lessons) . ' lessons to course: ' . $course->title_ar);
    }
} 