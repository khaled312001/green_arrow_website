<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\QuizQuestion;

class CourseQuizzesSeeder extends Seeder
{
    public function run()
    {
        $course = Course::find(2);
        if (!$course) {
            $this->command->error('Course ID 2 not found!');
            return;
        }

        // إضافة كويز للدرس الأول
        $quiz1 = Quiz::create([
            'course_id' => $course->id,
            'lesson_id' => $course->lessons()->where('sort_order', 1)->first()->id,
            'title_ar' => 'كويز: مقدمة في القيادة والإدارة',
            'description_ar' => 'اختبار قصير لتقييم فهمك لمفاهيم القيادة والإدارة الأساسية',
            'duration_minutes' => 15,
            'passing_score' => 70,
            'is_active' => true
        ]);

        $questions1 = [
            [
                'question' => 'ما هو الفرق الرئيسي بين القائد والمدير؟',
                'options' => [
                    'القائد يركز على الأهداف، المدير يركز على المهام',
                    'لا يوجد فرق بينهما',
                    'القائد يتبع التعليمات، المدير يعطي التعليمات',
                    'المدير أكثر أهمية من القائد'
                ],
                'correct_answer' => 'القائد يركز على الأهداف، المدير يركز على المهام'
            ],
            [
                'question' => 'أي من التالي يعتبر من خصائص القيادة الفعالة؟',
                'options' => [
                    'التحكم المطلق في جميع القرارات',
                    'التواصل الفعال مع الفريق',
                    'تجاهل آراء الآخرين',
                    'العمل الفردي فقط'
                ],
                'correct_answer' => 'التواصل الفعال مع الفريق'
            ],
            [
                'question' => 'ما هي أهمية القيادة في المنظمات الحديثة؟',
                'options' => [
                    'لا أهمية لها',
                    'تساعد في تحقيق الأهداف وتطوير الفريق',
                    'تزيد من البيروقراطية فقط',
                    'تقلل من الإنتاجية'
                ],
                'correct_answer' => 'تساعد في تحقيق الأهداف وتطوير الفريق'
            ]
        ];

        foreach ($questions1 as $q) {
            QuizQuestion::create([
                'quiz_id' => $quiz1->id,
                'question_ar' => $q['question'],
                'type' => 'multiple_choice',
                'options' => $q['options'],
                'correct_answer' => $q['correct_answer'],
                'points' => 10,
                'sort_order' => 1
            ]);
        }

        // إضافة كويز للدرس الثاني
        $quiz2 = Quiz::create([
            'course_id' => $course->id,
            'lesson_id' => $course->lessons()->where('sort_order', 2)->first()->id,
            'title_ar' => 'كويز: أنماط القيادة المختلفة',
            'description_ar' => 'اختبار لتقييم فهمك لأنماط القيادة المختلفة ومتى تستخدم كل نمط',
            'duration_minutes' => 20,
            'passing_score' => 75,
            'is_active' => true
        ]);

        $questions2 = [
            [
                'question' => 'أي نمط قيادة يتيح للموظفين المشاركة في اتخاذ القرارات؟',
                'options' => [
                    'القيادة الاستبدادية',
                    'القيادة الديمقراطية',
                    'القيادة الحرة',
                    'القيادة التحويلية'
                ],
                'correct_answer' => 'القيادة الديمقراطية'
            ],
            [
                'question' => 'متى يكون نمط القيادة الاستبدادية مناسباً؟',
                'options' => [
                    'في جميع المواقف',
                    'في حالات الطوارئ والأزمات',
                    'في المشاريع الإبداعية',
                    'في الفرق المتمرسة'
                ],
                'correct_answer' => 'في حالات الطوارئ والأزمات'
            ],
            [
                'question' => 'ما هي مميزات القيادة التحويلية؟',
                'options' => [
                    'التركيز على المهام الروتينية فقط',
                    'تحفيز الفريق وتطوير رؤية مشتركة',
                    'تجاهل مشاعر الموظفين',
                    'التركيز على الأهداف قصيرة المدى فقط'
                ],
                'correct_answer' => 'تحفيز الفريق وتطوير رؤية مشتركة'
            ],
            [
                'question' => 'أي من التالي يعتبر من عيوب القيادة الحرة؟',
                'options' => [
                    'زيادة الإبداع',
                    'عدم وضوح الأدوار والمسؤوليات',
                    'تحسين التواصل',
                    'زيادة الإنتاجية'
                ],
                'correct_answer' => 'عدم وضوح الأدوار والمسؤوليات'
            ]
        ];

        foreach ($questions2 as $index => $q) {
            QuizQuestion::create([
                'quiz_id' => $quiz2->id,
                'question_ar' => $q['question'],
                'type' => 'multiple_choice',
                'options' => $q['options'],
                'correct_answer' => $q['correct_answer'],
                'points' => 10,
                'sort_order' => $index + 1
            ]);
        }

        // إضافة كويز نهائي شامل
        $finalQuiz = Quiz::create([
            'course_id' => $course->id,
            'lesson_id' => $course->lessons()->where('sort_order', 15)->first()->id,
            'title_ar' => 'الاختبار النهائي الشامل',
            'description_ar' => 'اختبار شامل لتقييم جميع المفاهيم والمهارات التي تم تعلمها في الدورة',
            'duration_minutes' => 60,
            'passing_score' => 80,
            'is_active' => true
        ]);

        $finalQuestions = [
            [
                'question' => 'ما هي المراحل الخمس لتطور الفريق؟',
                'options' => [
                    'التشكيل، العصف الذهني، المعايير، الأداء، الإنهاء',
                    'التخطيط، التنفيذ، المراقبة، التقييم، الإغلاق',
                    'البداية، الوسط، النهاية',
                    'لا توجد مراحل محددة'
                ],
                'correct_answer' => 'التشكيل، العصف الذهني، المعايير، الأداء، الإنهاء'
            ],
            [
                'question' => 'أي من التالي يعتبر من مهارات التواصل القيادي؟',
                'options' => [
                    'الاستماع النشط فقط',
                    'تقديم التغذية الراجعة فقط',
                    'الاستماع النشط، تقديم التغذية الراجعة، والتواصل الفعال',
                    'التحدث فقط'
                ],
                'correct_answer' => 'الاستماع النشط، تقديم التغذية الراجعة، والتواصل الفعال'
            ],
            [
                'question' => 'ما هي نظرية التحفيز التي تركز على الاحتياجات الأساسية؟',
                'options' => [
                    'نظرية ماسلو للاحتياجات',
                    'نظرية التوقع',
                    'نظرية العدالة',
                    'نظرية التعزيز'
                ],
                'correct_answer' => 'نظرية ماسلو للاحتياجات'
            ],
            [
                'question' => 'ما هي الخطوات الخمس لحل المشكلات؟',
                'options' => [
                    'تحديد المشكلة، تحليلها، تطوير الحلول، تنفيذ الحل، تقييم النتائج',
                    'تجاهل المشكلة، الانتظار، الحل التلقائي',
                    'التسرع في الحل، التنفيذ، النسيان',
                    'لا توجد خطوات محددة'
                ],
                'correct_answer' => 'تحديد المشكلة، تحليلها، تطوير الحلول، تنفيذ الحل، تقييم النتائج'
            ],
            [
                'question' => 'ما هو الذكاء العاطفي في القيادة؟',
                'options' => [
                    'القدرة على فهم وإدارة المشاعر الشخصية ومشاعر الآخرين',
                    'الذكاء الأكاديمي فقط',
                    'المهارات التقنية',
                    'الخبرة العملية'
                ],
                'correct_answer' => 'القدرة على فهم وإدارة المشاعر الشخصية ومشاعر الآخرين'
            ],
            [
                'question' => 'ما هي استراتيجية إدارة التغيير الفعالة؟',
                'options' => [
                    'تجاهل مقاومة التغيير',
                    'التواصل الواضح، المشاركة، التدريب، الدعم المستمر',
                    'الإجبار فقط',
                    'الانتظار حتى يحدث التغيير تلقائياً'
                ],
                'correct_answer' => 'التواصل الواضح، المشاركة، التدريب، الدعم المستمر'
            ],
            [
                'question' => 'ما هي عناصر التخطيط الاستراتيجي؟',
                'options' => [
                    'الرؤية، الرسالة، الأهداف، الاستراتيجيات، التنفيذ',
                    'التخطيط اليومي فقط',
                    'الأهداف قصيرة المدى فقط',
                    'لا توجد عناصر محددة'
                ],
                'correct_answer' => 'الرؤية، الرسالة، الأهداف، الاستراتيجيات، التنفيذ'
            ],
            [
                'question' => 'ما هي فوائد إدارة الوقت الفعالة؟',
                'options' => [
                    'زيادة الإنتاجية، تقليل التوتر، تحسين جودة العمل',
                    'زيادة ساعات العمل فقط',
                    'تقليل الراحة',
                    'لا توجد فوائد'
                ],
                'correct_answer' => 'زيادة الإنتاجية، تقليل التوتر، تحسين جودة العمل'
            ]
        ];

        foreach ($finalQuestions as $index => $q) {
            QuizQuestion::create([
                'quiz_id' => $finalQuiz->id,
                'question_ar' => $q['question'],
                'type' => 'multiple_choice',
                'options' => $q['options'],
                'correct_answer' => $q['correct_answer'],
                'points' => 12.5,
                'sort_order' => $index + 1
            ]);
        }

        $this->command->info('Course quizzes have been successfully created!');
        $this->command->info('Created 3 quizzes for course: ' . $course->title_ar);
    }
} 