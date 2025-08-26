<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;

class CoursesSeeder extends Seeder
{
    public function run()
    {
        // Create categories
        $categories = [
            [
                'name_ar' => 'البرمجة وتطوير المواقع',
                'name_en' => 'Programming & Web Development',
                'description_ar' => 'تعلم أحدث تقنيات البرمجة وتطوير المواقع الإلكترونية والتطبيقات',
                'description_en' => 'Learn the latest programming technologies and web development',
                'icon' => 'bi-code-slash',
                'color' => '#3B82F6',
                'sort_order' => 1,
                'is_active' => true,
                'slug' => 'programming'
            ],
            [
                'name_ar' => 'الإدارة والقيادة',
                'name_en' => 'Management & Leadership',
                'description_ar' => 'طور مهاراتك القيادية والإدارية مع دورات متخصصة',
                'description_en' => 'Develop your leadership and management skills',
                'icon' => 'bi-people',
                'color' => '#10B981',
                'sort_order' => 2,
                'is_active' => true,
                'slug' => 'management'
            ],
            [
                'name_ar' => 'اللغات الأجنبية',
                'name_en' => 'Foreign Languages',
                'description_ar' => 'تعلم اللغات الأجنبية مع مدربين متخصصين ومناهج حديثة',
                'description_en' => 'Learn foreign languages with specialized instructors',
                'icon' => 'bi-translate',
                'color' => '#F59E0B',
                'sort_order' => 3,
                'is_active' => true,
                'slug' => 'languages'
            ],
            [
                'name_ar' => 'التقنية والذكاء الاصطناعي',
                'name_en' => 'Technology & AI',
                'description_ar' => 'اكتشف عالم الذكاء الاصطناعي والتعلم الآلي وعلوم البيانات',
                'description_en' => 'Discover AI, machine learning, and data science',
                'icon' => 'bi-cpu',
                'color' => '#8B5CF6',
                'sort_order' => 4,
                'is_active' => true,
                'slug' => 'ai-tech'
            ],
            [
                'name_ar' => 'دورات الأطفال',
                'name_en' => 'Kids Courses',
                'description_ar' => 'برامج تعليمية مخصصة للأطفال تطور مهاراتهم الإبداعية',
                'description_en' => 'Educational programs designed for children',
                'icon' => 'bi-emoji-smile',
                'color' => '#EF4444',
                'sort_order' => 5,
                'is_active' => true,
                'slug' => 'kids'
            ],
            [
                'name_ar' => 'التسويق الرقمي',
                'name_en' => 'Digital Marketing',
                'description_ar' => 'تعلم استراتيجيات التسويق الرقمي الحديثة',
                'description_en' => 'Learn modern digital marketing strategies',
                'icon' => 'bi-megaphone',
                'color' => '#06B6D4',
                'sort_order' => 6,
                'is_active' => true,
                'slug' => 'marketing'
            ],
            [
                'name_ar' => 'تصميم الجرافيك والوسائط',
                'name_en' => 'Graphic Design & Media',
                'description_ar' => 'طور مهاراتك في التصميم الجرافيكي والوسائط المتعددة',
                'description_en' => 'Develop your graphic design and multimedia skills',
                'icon' => 'bi-palette',
                'color' => '#EC4899',
                'sort_order' => 7,
                'is_active' => true,
                'slug' => 'design'
            ],
            [
                'name_ar' => 'الأعمال والريادة',
                'name_en' => 'Business & Entrepreneurship',
                'description_ar' => 'تعلم أساسيات إدارة الأعمال والريادة وبناء المشاريع',
                'description_en' => 'Learn business management and entrepreneurship',
                'icon' => 'bi-briefcase',
                'color' => '#84CC16',
                'sort_order' => 8,
                'is_active' => true,
                'slug' => 'business'
            ]
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        // Get instructors
        $instructors = User::role('teacher')->get();
        if ($instructors->isEmpty()) {
            // Create a default instructor if none exists
            $instructor = User::create([
                'name' => 'أحمد محمد',
                'email' => 'ahmed@example.com',
                'password' => bcrypt('password'),
                'phone' => '+966501234567',
                'city' => 'مكة المكرمة',
                'country' => 'السعودية',
                'is_active' => true,
                'email_verified_at' => now(),
            ]);
            $instructor->assignRole('teacher');
            $instructors = collect([$instructor]);
        }

        // Create courses
        $courses = [
            [
                'title_ar' => 'تطوير المواقع باستخدام Laravel',
                'title_en' => 'Web Development with Laravel',
                'description_ar' => 'دورة شاملة في تطوير المواقع باستخدام إطار العمل Laravel مع التطبيق العملي والمشاريع الحقيقية',
                'objectives_ar' => 'تعلم أساسيات Laravel، إنشاء تطبيقات ويب متكاملة، التعامل مع قواعد البيانات، تطوير واجهات المستخدم',
                'requirements_ar' => 'معرفة أساسية بـ PHP و HTML و CSS، فهم أساسيات البرمجة',
                'category_id' => 1,
                'price' => 1500,
                'duration_hours' => 40,
                'level' => 'intermediate',
                'is_featured' => true,
                'status' => 'published',
                'enrolled_count' => 45,
                'rating' => 4.8,
                'reviews_count' => 23,
                'views_count' => 450
            ],
            [
                'title_ar' => 'إدارة الفرق والقيادة الفعالة',
                'title_en' => 'Team Management & Effective Leadership',
                'description_ar' => 'تطوير مهارات القيادة والإدارة الحديثة مع التطبيق العملي في بيئات العمل المختلفة',
                'objectives_ar' => 'تعلم أساليب القيادة الحديثة، إدارة الفرق بكفاءة، حل المشكلات، تحفيز الموظفين',
                'requirements_ar' => 'لا توجد متطلبات مسبقة، مناسب لجميع المستويات',
                'category_id' => 2,
                'price' => 1200,
                'duration_hours' => 30,
                'level' => 'beginner',
                'is_featured' => true,
                'status' => 'published',
                'enrolled_count' => 38,
                'rating' => 4.9,
                'reviews_count' => 19,
                'views_count' => 380
            ],
            [
                'title_ar' => 'اللغة الإنجليزية للمبتدئين',
                'title_en' => 'English for Beginners',
                'description_ar' => 'تعلم أساسيات اللغة الإنجليزية من الصفر مع التركيز على المحادثة والتواصل اليومي',
                'objectives_ar' => 'إتقان أساسيات اللغة، التحدث بثقة، فهم النصوص البسيطة، كتابة الجمل الأساسية',
                'requirements_ar' => 'لا توجد متطلبات مسبقة، مناسب للمبتدئين تماماً',
                'category_id' => 3,
                'price' => 800,
                'duration_hours' => 50,
                'level' => 'beginner',
                'is_featured' => false,
                'status' => 'published',
                'enrolled_count' => 67,
                'rating' => 4.7,
                'reviews_count' => 34,
                'views_count' => 520
            ],
            [
                'title_ar' => 'مقدمة في الذكاء الاصطناعي',
                'title_en' => 'Introduction to Artificial Intelligence',
                'description_ar' => 'فهم أساسيات الذكاء الاصطناعي وتطبيقاته في الحياة العملية مع أمثلة عملية',
                'objectives_ar' => 'فهم مفاهيم الذكاء الاصطناعي، التعلم الآلي، التطبيقات العملية، أدوات AI الحديثة',
                'requirements_ar' => 'معرفة أساسية بالرياضيات والبرمجة، فهم أساسي للحاسوب',
                'category_id' => 4,
                'price' => 2000,
                'duration_hours' => 35,
                'level' => 'intermediate',
                'is_featured' => true,
                'status' => 'published',
                'enrolled_count' => 28,
                'rating' => 4.6,
                'reviews_count' => 15,
                'views_count' => 320
            ],
            [
                'title_ar' => 'البرمجة للأطفال مع Scratch',
                'title_en' => 'Kids Programming with Scratch',
                'description_ar' => 'تعليم الأطفال أساسيات البرمجة بطريقة مرحة وتفاعلية مع التركيز على تطوير التفكير المنطقي',
                'objectives_ar' => 'فهم مفاهيم البرمجة الأساسية، إنشاء ألعاب بسيطة، تطوير التفكير المنطقي، تعزيز الإبداع',
                'requirements_ar' => 'العمر من 8-14 سنة، حاسوب متصل بالإنترنت',
                'category_id' => 5,
                'price' => 600,
                'duration_hours' => 20,
                'level' => 'beginner',
                'is_featured' => false,
                'status' => 'published',
                'enrolled_count' => 89,
                'rating' => 4.9,
                'reviews_count' => 42,
                'views_count' => 680
            ],
            [
                'title_ar' => 'التسويق عبر وسائل التواصل الاجتماعي',
                'title_en' => 'Social Media Marketing',
                'description_ar' => 'استراتيجيات التسويق الحديثة عبر منصات التواصل الاجتماعي مع التركيز على النتائج العملية',
                'objectives_ar' => 'إنشاء حملات تسويقية فعالة، تحليل البيانات، زيادة التفاعل، بناء العلامة التجارية',
                'requirements_ar' => 'معرفة أساسية بوسائل التواصل الاجتماعي، حساب على المنصات المختلفة',
                'category_id' => 6,
                'price' => 1000,
                'duration_hours' => 25,
                'level' => 'beginner',
                'is_featured' => true,
                'status' => 'published',
                'enrolled_count' => 52,
                'rating' => 4.5,
                'reviews_count' => 28,
                'views_count' => 410
            ],
            [
                'title_ar' => 'تصميم الشعارات والهوية البصرية',
                'title_en' => 'Logo Design & Visual Identity',
                'description_ar' => 'تعلم تصميم الشعارات والهوية البصرية الاحترافية باستخدام أحدث البرامج والتقنيات',
                'objectives_ar' => 'تصميم شعارات احترافية، تطوير الهوية البصرية، استخدام برامج التصميم، فهم مبادئ التصميم',
                'requirements_ar' => 'حاسوب مع برامج التصميم، حس فني، رغبة في التعلم',
                'category_id' => 7,
                'price' => 1300,
                'duration_hours' => 30,
                'level' => 'beginner',
                'is_featured' => false,
                'status' => 'published',
                'enrolled_count' => 41,
                'rating' => 4.7,
                'reviews_count' => 22,
                'views_count' => 350
            ],
            [
                'title_ar' => 'إنشاء المشاريع الريادية',
                'title_en' => 'Entrepreneurship & Startup Creation',
                'description_ar' => 'تعلم أساسيات إنشاء وإدارة المشاريع الريادية من الفكرة إلى النجاح',
                'objectives_ar' => 'تطوير الأفكار التجارية، كتابة خطط الأعمال، إدارة الموارد، استراتيجيات النمو',
                'requirements_ar' => 'لا توجد متطلبات مسبقة، مناسب للرياديين والمستثمرين',
                'category_id' => 8,
                'price' => 1800,
                'duration_hours' => 35,
                'level' => 'intermediate',
                'is_featured' => true,
                'status' => 'published',
                'enrolled_count' => 33,
                'rating' => 4.8,
                'reviews_count' => 17,
                'views_count' => 290
            ]
        ];

        foreach ($courses as $courseData) {
            $courseData['instructor_id'] = $instructors->random()->id;
            Course::create($courseData);
        }

        echo "Categories and courses seeded successfully!\n";
    }
} 