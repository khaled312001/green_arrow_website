<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Course;
use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Database\Seeders\NotificationSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // إنشاء الأدوار والصلاحيات
        $this->createRolesAndPermissions();
        
        // إنشاء المستخدمين
        $this->createUsers();
        
        // إنشاء الأقسام
        $this->createCategories();
        
        // إنشاء الدورات
        $this->createCourses();
        
        // إنشاء المقالات
        $this->createBlogPosts();
        
        // إنشاء الإشعارات
        $this->call(NotificationSeeder::class);
    }
    
    private function createRolesAndPermissions()
    {
        // إنشاء الأدوار الأساسية
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $teacherRole = Role::firstOrCreate(['name' => 'teacher', 'guard_name' => 'web']);
        $studentRole = Role::firstOrCreate(['name' => 'student', 'guard_name' => 'web']);
        $moderatorRole = Role::firstOrCreate(['name' => 'moderator', 'guard_name' => 'web']);
        $contentCreatorRole = Role::firstOrCreate(['name' => 'content_creator', 'guard_name' => 'web']);
        $supportRole = Role::firstOrCreate(['name' => 'support', 'guard_name' => 'web']);
        
        // إنشاء جميع الصلاحيات حسب المواصفات
        
        // صلاحيات إدارة المستخدمين
        $userPermissions = [
            'view-users',
            'create-users',
            'edit-users',
            'delete-users',
            'manage-user-roles',
            'view-user-profiles',
            'export-users',
            'import-users',
            'manage-user-status',
        ];
        
        // صلاحيات إدارة الدورات
        $coursePermissions = [
            'view-courses',
            'create-courses',
            'edit-courses',
            'delete-courses',
            'publish-courses',
            'unpublish-courses',
            'manage-course-content',
            'manage-course-enrollments',
            'view-course-analytics',
            'export-course-data',
            'manage-course-pricing',
            'manage-course-discounts',
            'approve-course-submissions',
        ];
        
        // صلاحيات إدارة المحاضرات والدروس
        $lessonPermissions = [
            'view-lessons',
            'create-lessons',
            'edit-lessons',
            'delete-lessons',
            'upload-lesson-files',
            'manage-video-content',
            'schedule-live-sessions',
            'manage-assignments',
            'grade-assignments',
            'view-student-progress',
            'manage-quizzes',
            'create-quizzes',
            'edit-quizzes',
            'delete-quizzes',
            'grade-quizzes',
        ];
        
        // صلاحيات إدارة الأقسام والفئات
        $categoryPermissions = [
            'view-categories',
            'create-categories',
            'edit-categories',
            'delete-categories',
            'manage-category-hierarchy',
        ];
        
        // صلاحيات إدارة المدفوعات والفواتير
        $paymentPermissions = [
            'view-payments',
            'process-payments',
            'refund-payments',
            'manage-payment-gateways',
            'view-financial-reports',
            'export-payment-reports',
            'manage-invoices',
            'generate-invoices',
            'manage-payment-settings',
        ];
        
        // صلاحيات إدارة المدونة والمحتوى
        $blogPermissions = [
            'view-blog-posts',
            'create-blog-posts',
            'edit-blog-posts',
            'delete-blog-posts',
            'publish-blog-posts',
            'manage-blog-categories',
            'manage-blog-comments',
            'approve-blog-comments',
            'manage-seo-content',
        ];
        
        // صلاحيات إدارة الإعدادات والنظام
        $systemPermissions = [
            'manage-system-settings',
            'manage-site-configuration',
            'manage-email-settings',
            'manage-notification-settings',
            'manage-backup-settings',
            'view-system-logs',
            'manage-api-settings',
            'manage-security-settings',
        ];
        
        // صلاحيات إدارة التقارير والإحصائيات
        $reportPermissions = [
            'view-dashboard',
            'view-analytics',
            'generate-reports',
            'export-reports',
            'view-student-reports',
            'view-instructor-reports',
            'view-financial-reports',
            'view-course-reports',
            'view-enrollment-reports',
        ];
        
        // صلاحيات إدارة الشهادات
        $certificatePermissions = [
            'view-certificates',
            'create-certificates',
            'edit-certificates',
            'delete-certificates',
            'issue-certificates',
            'manage-certificate-templates',
            'download-certificates',
        ];
        
        // صلاحيات إدارة الإشعارات والرسائل
        $notificationPermissions = [
            'send-notifications',
            'manage-notification-templates',
            'view-notification-logs',
            'manage-email-templates',
            'send-bulk-emails',
            'manage-sms-notifications',
        ];
        
        // صلاحيات إدارة التسجيل في الدورات
        $enrollmentPermissions = [
            'enroll-in-courses',
            'cancel-enrollments',
            'view-enrollment-history',
            'manage-enrollment-status',
            'access-course-content',
            'submit-assignments',
            'view-grades',
            'participate-in-discussions',
        ];
        
        // صلاحيات إدارة المحادثات المباشرة
        $liveSessionPermissions = [
            'join-live-sessions',
            'host-live-sessions',
            'manage-live-session-settings',
            'record-live-sessions',
            'manage-attendance',
            'view-live-session-reports',
        ];
        
        // صلاحيات إدارة التقييمات والمراجعات
        $reviewPermissions = [
            'view-reviews',
            'create-reviews',
            'edit-reviews',
            'delete-reviews',
            'approve-reviews',
            'manage-review-settings',
        ];
        
        // صلاحيات إدارة الكوبونات والعروض
        $couponPermissions = [
            'view-coupons',
            'create-coupons',
            'edit-coupons',
            'delete-coupons',
            'manage-coupon-usage',
            'view-coupon-reports',
        ];
        
        // صلاحيات إدارة الملف الشخصي
        $profilePermissions = [
            'view-own-profile',
            'edit-own-profile',
            'upload-avatar',
            'manage-privacy-settings',
            'view-activity-history',
        ];
        
        // دمج جميع الصلاحيات
        $allPermissions = array_merge(
            $userPermissions,
            $coursePermissions,
            $lessonPermissions,
            $categoryPermissions,
            $paymentPermissions,
            $blogPermissions,
            $systemPermissions,
            $reportPermissions,
            $certificatePermissions,
            $notificationPermissions,
            $enrollmentPermissions,
            $liveSessionPermissions,
            $reviewPermissions,
            $couponPermissions,
            $profilePermissions
        );
        
        // إنشاء جميع الصلاحيات
        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }
        
        // تعيين الصلاحيات للمدير (جميع الصلاحيات)
        $adminRole->givePermissionTo(Permission::all());
        
        // تعيين الصلاحيات للمدرب
        $teacherRole->givePermissionTo([
            // إدارة الدورات الخاصة به
            'view-courses', 'create-courses', 'edit-courses', 'publish-courses', 'unpublish-courses',
            'manage-course-content', 'view-course-analytics', 'manage-course-pricing',
            
            // إدارة المحاضرات والدروس
            'view-lessons', 'create-lessons', 'edit-lessons', 'delete-lessons',
            'upload-lesson-files', 'manage-video-content', 'schedule-live-sessions',
            'manage-assignments', 'grade-assignments', 'view-student-progress',
            'manage-quizzes', 'create-quizzes', 'edit-quizzes', 'delete-quizzes', 'grade-quizzes',
            
            // إدارة الطلاب والتقييمات
            'view-user-profiles', 'view-student-reports',
            'view-reviews', 'create-reviews', 'edit-reviews',
            
            // المحادثات المباشرة
            'host-live-sessions', 'manage-live-session-settings', 'record-live-sessions',
            'manage-attendance', 'view-live-session-reports',
            
            // الشهادات
            'view-certificates', 'issue-certificates',
            
            // الإشعارات
            'send-notifications',
            
            // الملف الشخصي
            'view-own-profile', 'edit-own-profile', 'upload-avatar', 'manage-privacy-settings',
            'view-activity-history',
            
            // لوحة التحكم
            'view-dashboard', 'view-analytics',
        ]);
        
        // تعيين الصلاحيات للطالب
        $studentRole->givePermissionTo([
            // التسجيل في الدورات
            'enroll-in-courses', 'cancel-enrollments', 'view-enrollment-history',
            'access-course-content', 'submit-assignments', 'view-grades',
            'participate-in-discussions',
            
            // المحادثات المباشرة
            'join-live-sessions',
            
            // التقييمات
            'view-reviews', 'create-reviews', 'edit-reviews',
            
            // الشهادات
            'view-certificates', 'download-certificates',
            
            // الملف الشخصي
            'view-own-profile', 'edit-own-profile', 'upload-avatar', 'manage-privacy-settings',
            'view-activity-history',
            
            // لوحة التحكم
            'view-dashboard',
        ]);
        
        // تعيين الصلاحيات للمشرف
        $moderatorRole->givePermissionTo([
            'view-users', 'edit-users', 'manage-user-status',
            'view-courses', 'edit-courses', 'approve-course-submissions',
            'view-lessons', 'edit-lessons',
            'view-categories', 'edit-categories',
            'view-payments', 'process-payments', 'refund-payments',
            'view-blog-posts', 'edit-blog-posts', 'approve-blog-comments',
            'view-reviews', 'approve-reviews',
            'view-dashboard', 'view-analytics', 'generate-reports',
            'send-notifications',
        ]);
        
        // تعيين الصلاحيات لمنشئ المحتوى
        $contentCreatorRole->givePermissionTo([
            'view-courses', 'create-courses', 'edit-courses',
            'view-lessons', 'create-lessons', 'edit-lessons',
            'view-categories', 'create-categories', 'edit-categories',
            'view-blog-posts', 'create-blog-posts', 'edit-blog-posts', 'publish-blog-posts',
            'manage-seo-content',
            'view-dashboard',
        ]);
        
        // تعيين الصلاحيات لفريق الدعم
        $supportRole->givePermissionTo([
            'view-users', 'view-user-profiles',
            'view-courses', 'view-lessons',
            'view-payments', 'process-payments', 'refund-payments',
            'view-enrollment-history', 'manage-enrollment-status',
            'send-notifications',
            'view-dashboard',
        ]);
    }
    
    private function createUsers()
    {
        // إنشاء المدير
        $admin = User::create([
            'name' => 'مدير الأكاديمية',
            'email' => 'admin@greenarrowacademy.com',
            'password' => Hash::make('password'),
            'phone' => '+966501234567',
            'city' => 'مكة المكرمة',
            'country' => 'السعودية',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');
        
        // إنشاء المشرف
        $moderator = User::create([
            'name' => 'أحمد علي المشرف',
            'email' => 'moderator@greenarrowacademy.com',
            'password' => Hash::make('password'),
            'phone' => '+966501234568',
            'city' => 'مكة المكرمة',
            'country' => 'السعودية',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $moderator->assignRole('moderator');
        
        // إنشاء منشئ المحتوى
        $contentCreator = User::create([
            'name' => 'سارة أحمد منشئة المحتوى',
            'email' => 'content@greenarrowacademy.com',
            'password' => Hash::make('password'),
            'phone' => '+966501234569',
            'city' => 'مكة المكرمة',
            'country' => 'السعودية',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $contentCreator->assignRole('content_creator');
        
        // إنشاء فريق الدعم
        $support = User::create([
            'name' => 'خالد محمد فريق الدعم',
            'email' => 'support@greenarrowacademy.com',
            'password' => Hash::make('password'),
            'phone' => '+966501234570',
            'city' => 'مكة المكرمة',
            'country' => 'السعودية',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $support->assignRole('support');
        
        // إنشاء المدربين
        $instructors = [
            [
                'name' => 'أحمد محمد السعدي',
                'email' => 'ahmed@greenarrowacademy.com',
                'bio' => 'مدرب متخصص في البرمجة وتطوير المواقع مع خبرة أكثر من 10 سنوات',
                'speciality' => 'البرمجة وتطوير المواقع'
            ],
            [
                'name' => 'فاطمة علي الحربي',
                'email' => 'fatima@greenarrowacademy.com',
                'bio' => 'خبيرة في الإدارة والقيادة مع شهادات دولية معتمدة',
                'speciality' => 'الإدارة والقيادة'
            ],
            [
                'name' => 'محمد عبدالله القحطاني',
                'email' => 'mohammed@greenarrowacademy.com',
                'bio' => 'متخصص في اللغة الإنجليزية والترجمة مع خبرة 8 سنوات',
                'speciality' => 'اللغة الإنجليزية'
            ],
            [
                'name' => 'نورا سالم الزهراني',
                'email' => 'nora@greenarrowacademy.com',
                'bio' => 'مدربة تقنية متخصصة في الذكاء الاصطناعي وعلوم البيانات',
                'speciality' => 'التقنية والذكاء الاصطناعي'
            ],
            [
                'name' => 'عبدالرحمن سعد الغامدي',
                'email' => 'abdulrahman@greenarrowacademy.com',
                'bio' => 'مدرب متخصص في التسويق الرقمي وإدارة وسائل التواصل الاجتماعي',
                'speciality' => 'التسويق الرقمي'
            ],
            [
                'name' => 'ريم عبدالله الشهري',
                'email' => 'reem@greenarrowacademy.com',
                'bio' => 'مدربة متخصصة في تصميم الجرافيك والتصميم الرقمي',
                'speciality' => 'تصميم الجرافيك'
            ]
        ];
        
        foreach ($instructors as $instructorData) {
            $instructor = User::create([
                'name' => $instructorData['name'],
                'email' => $instructorData['email'],
                'password' => Hash::make('password'),
                'bio' => $instructorData['bio'],
                'phone' => '+9665012345' . rand(10, 99),
                'city' => 'مكة المكرمة',
                'country' => 'السعودية',
                'is_active' => true,
                'email_verified_at' => now(),
            ]);
            $instructor->assignRole('teacher');
        }
        
        // إنشاء طلاب تجريبيين
        for ($i = 1; $i <= 20; $i++) {
            $student = User::create([
                'name' => "الطالب رقم {$i}",
                'email' => "student{$i}@example.com",
                'password' => Hash::make('password'),
                'phone' => '+9665012345' . sprintf('%02d', $i),
                'city' => 'مكة المكرمة',
                'country' => 'السعودية',
                'is_active' => true,
                'email_verified_at' => now(),
            ]);
            $student->assignRole('student');
        }
    }
    
    private function createCategories()
    {
        $categories = [
            [
                'name_ar' => 'البرمجة وتطوير المواقع',
                'name_en' => 'Programming & Web Development',
                'description_ar' => 'تعلم أحدث تقنيات البرمجة وتطوير المواقع الإلكترونية والتطبيقات مع خبراء متخصصين في المجال. تشمل الدورات لغات البرمجة الحديثة وأطر العمل المتقدمة.',
                'description_en' => 'Learn the latest programming technologies and web development with expert instructors. Courses include modern programming languages and advanced frameworks.',
                'icon' => 'bi-code-slash',
                'color' => '#3B82F6',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name_ar' => 'الإدارة والقيادة',
                'name_en' => 'Management & Leadership',
                'description_ar' => 'طور مهاراتك القيادية والإدارية مع دورات متخصصة في إدارة المشاريع والفرق والاستراتيجيات الحديثة. تعلم فن القيادة الفعالة.',
                'description_en' => 'Develop your leadership and management skills with specialized courses in project management, team leadership, and modern strategies.',
                'icon' => 'bi-people',
                'color' => '#10B981',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name_ar' => 'اللغات الأجنبية',
                'name_en' => 'Foreign Languages',
                'description_ar' => 'تعلم اللغات الأجنبية مع مدربين متخصصين ومناهج حديثة مصممة لتحقيق الطلاقة اللغوية. دورات تفاعلية وممارسة عملية.',
                'description_en' => 'Learn foreign languages with specialized instructors and modern curricula designed to achieve linguistic fluency.',
                'icon' => 'bi-translate',
                'color' => '#F59E0B',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name_ar' => 'التقنية والذكاء الاصطناعي',
                'name_en' => 'Technology & AI',
                'description_ar' => 'اكتشف عالم الذكاء الاصطناعي والتعلم الآلي وعلوم البيانات مع أحدث التقنيات والمناهج. تعلم تطبيقات AI العملية.',
                'description_en' => 'Discover the world of artificial intelligence, machine learning, and data science with the latest technologies and methodologies.',
                'icon' => 'bi-cpu',
                'color' => '#8B5CF6',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name_ar' => 'دورات الأطفال',
                'name_en' => 'Kids Courses',
                'description_ar' => 'برامج تعليمية مخصصة للأطفال تطور مهاراتهم الإبداعية والذهنية بطريقة ممتعة وتفاعلية. تعلم من خلال اللعب والأنشطة.',
                'description_en' => 'Educational programs designed for children to develop their creative and mental skills in a fun and interactive way.',
                'icon' => 'bi-emoji-smile',
                'color' => '#EF4444',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name_ar' => 'التسويق الرقمي',
                'name_en' => 'Digital Marketing',
                'description_ar' => 'تعلم استراتيجيات التسويق الرقمي الحديثة وإدارة وسائل التواصل الاجتماعي والتسويق الإلكتروني. استراتيجيات فعالة للعصر الرقمي.',
                'description_en' => 'Learn modern digital marketing strategies, social media management, and e-marketing techniques.',
                'icon' => 'bi-megaphone',
                'color' => '#06B6D4',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'name_ar' => 'تصميم الجرافيك والوسائط',
                'name_en' => 'Graphic Design & Media',
                'description_ar' => 'طور مهاراتك في التصميم الجرافيكي والوسائط المتعددة مع أحدث البرامج والتقنيات. تعلم التصميم الإبداعي والاحترافي.',
                'description_en' => 'Develop your skills in graphic design and multimedia with the latest software and technologies.',
                'icon' => 'bi-palette',
                'color' => '#EC4899',
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'name_ar' => 'الأعمال والريادة',
                'name_en' => 'Business & Entrepreneurship',
                'description_ar' => 'تعلم أساسيات إدارة الأعمال والريادة وبناء المشاريع الناجحة مع خبراء في المجال. تطوير المشاريع الريادية.',
                'description_en' => 'Learn the fundamentals of business management, entrepreneurship, and building successful projects.',
                'icon' => 'bi-briefcase',
                'color' => '#84CC16',
                'sort_order' => 8,
                'is_active' => true,
            ],
        ];
        
        foreach ($categories as $categoryData) {
            Category::firstOrCreate(
                ['name_ar' => $categoryData['name_ar']],
                $categoryData
            );
        }
    }
    
    private function createCourses()
    {
        $categories = Category::all();
        $instructors = User::role('teacher')->get();
        
        $courses = [
            [
                'title_ar' => 'تطوير المواقع باستخدام Laravel',
                'title_en' => 'Web Development with Laravel',
                'description_ar' => 'دورة شاملة في تطوير المواقع باستخدام إطار العمل Laravel مع التطبيق العملي',
                'objectives_ar' => 'تعلم أساسيات Laravel، إنشاء تطبيقات ويب متكاملة، التعامل مع قواعد البيانات',
                'requirements_ar' => 'معرفة أساسية بـ PHP و HTML و CSS',
                'category_id' => 1,
                'price' => 1500,
                'duration_hours' => 40,
                'level' => 'intermediate',
                'is_featured' => true,
                'status' => 'published'
            ],
            [
                'title_ar' => 'إدارة الفرق والقيادة الفعالة',
                'title_en' => 'Team Management & Effective Leadership',
                'description_ar' => 'تطوير مهارات القيادة والإدارة الحديثة مع التطبيق العملي',
                'objectives_ar' => 'تعلم أساليب القيادة الحديثة، إدارة الفرق، حل المشكلات',
                'requirements_ar' => 'لا توجد متطلبات مسبقة',
                'category_id' => 2,
                'price' => 1200,
                'duration_hours' => 30,
                'level' => 'beginner',
                'is_featured' => true,
                'status' => 'published'
            ],
            [
                'title_ar' => 'اللغة الإنجليزية للمبتدئين',
                'title_en' => 'English for Beginners',
                'description_ar' => 'تعلم أساسيات اللغة الإنجليزية من الصفر مع التركيز على المحادثة',
                'objectives_ar' => 'إتقان أساسيات اللغة، التحدث بثقة، فهم النصوص البسيطة',
                'requirements_ar' => 'لا توجد متطلبات مسبقة',
                'category_id' => 3,
                'price' => 800,
                'duration_hours' => 50,
                'level' => 'beginner',
                'is_featured' => false,
                'status' => 'published'
            ],
            [
                'title_ar' => 'مقدمة في الذكاء الاصطناعي',
                'title_en' => 'Introduction to Artificial Intelligence',
                'description_ar' => 'فهم أساسيات الذكاء الاصطناعي وتطبيقاته في الحياة العملية',
                'objectives_ar' => 'فهم مفاهيم الذكاء الاصطناعي، التعلم الآلي، التطبيقات العملية',
                'requirements_ar' => 'معرفة أساسية بالرياضيات والبرمجة',
                'category_id' => 4,
                'price' => 2000,
                'duration_hours' => 35,
                'level' => 'intermediate',
                'is_featured' => true,
                'status' => 'published'
            ],
            [
                'title_ar' => 'البرمجة للأطفال مع Scratch',
                'title_en' => 'Kids Programming with Scratch',
                'description_ar' => 'تعليم الأطفال أساسيات البرمجة بطريقة مرحة وتفاعلية',
                'objectives_ar' => 'فهم مفاهيم البرمجة الأساسية، إنشاء ألعاب بسيطة، تطوير التفكير المنطقي',
                'requirements_ar' => 'العمر من 8-14 سنة',
                'category_id' => 5,
                'price' => 600,
                'duration_hours' => 20,
                'level' => 'beginner',
                'is_featured' => false,
                'status' => 'published'
            ],
            [
                'title_ar' => 'التسويق عبر وسائل التواصل الاجتماعي',
                'title_en' => 'Social Media Marketing',
                'description_ar' => 'استراتيجيات التسويق الحديثة عبر منصات التواصل الاجتماعي',
                'objectives_ar' => 'إنشاء حملات تسويقية فعالة، تحليل البيانات، زيادة التفاعل',
                'requirements_ar' => 'معرفة أساسية بوسائل التواصل الاجتماعي',
                'category_id' => 6,
                'price' => 1000,
                'duration_hours' => 25,
                'level' => 'beginner',
                'is_featured' => true,
                'status' => 'published'
            ]
        ];
        
        foreach ($courses as $index => $courseData) {
            $courseData['instructor_id'] = $instructors->random()->id;
            $courseData['enrolled_count'] = rand(10, 45);
            $courseData['rating'] = rand(40, 50) / 10; // 4.0 to 5.0
            $courseData['reviews_count'] = rand(5, 25);
            $courseData['views_count'] = rand(100, 500);
            
            Course::create($courseData);
        }
    }
    
    private function createBlogPosts()
    {
        $authors = User::role(['admin', 'teacher'])->get();
        
        $posts = [
            [
                'title_ar' => 'أهمية التعلم المستمر في العصر الرقمي',
                'excerpt_ar' => 'في عالم يتطور بسرعة، أصبح التعلم المستمر ضرورة حتمية للنجاح المهني',
                'content_ar' => 'محتوى المقال هنا...',
                'category' => 'تعليم',
                'status' => 'published',
                'is_featured' => true,
                'published_at' => now()->subDays(2)
            ],
            [
                'title_ar' => 'كيفية اختيار الدورة التدريبية المناسبة',
                'excerpt_ar' => 'دليل شامل لمساعدتك في اختيار الدورة التدريبية التي تناسب أهدافك المهنية',
                'content_ar' => 'محتوى المقال هنا...',
                'category' => 'نصائح',
                'status' => 'published',
                'is_featured' => false,
                'published_at' => now()->subDays(5)
            ],
            [
                'title_ar' => 'مستقبل الذكاء الاصطناعي في التعليم',
                'excerpt_ar' => 'كيف سيغير الذكاء الاصطناعي طريقة التعلم والتدريس في المستقبل القريب',
                'content_ar' => 'محتوى المقال هنا...',
                'category' => 'تقنية',
                'status' => 'published',
                'is_featured' => true,
                'published_at' => now()->subWeek()
            ]
        ];
        
        foreach ($posts as $postData) {
            $postData['author_id'] = $authors->random()->id;
            $postData['views_count'] = rand(50, 200);
            $postData['reading_time'] = rand(3, 8);
            
            BlogPost::create($postData);
        }
    }
}
