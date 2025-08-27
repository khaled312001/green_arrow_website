<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CourseResourceController;
use App\Http\Controllers\MessageController;

// الصفحات العامة
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// صفحات الشروط والسياسات
Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy');

Route::get('/terms-of-service', function () {
    return view('terms-of-service');
})->name('terms-of-service');

Route::get('/sitemap', function () {
    return view('sitemap');
})->name('sitemap');

// التحقق من الشهادات (عام - لا يحتاج تسجيل دخول)
Route::get('/certificates/verify', [CertificateController::class, 'showVerificationForm'])->name('certificates.verify');
Route::post('/certificates/verify', [CertificateController::class, 'verify'])->name('certificates.verify.post');
Route::get('/certificates/verify/{certificateNumber}', [CertificateController::class, 'verifyByNumber'])->name('certificates.verify.number');

Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [HomeController::class, 'blogPost'])->name('blog.post');
Route::get('/register-now', [HomeController::class, 'register'])->name('register.page');
Route::post('/register-now', [HomeController::class, 'submitRegistration'])->name('register.submit');

// صفحات الدورات
Route::get('/courses', [CourseController::class, 'index'])->name('courses');
Route::get('/courses/category/{slug}', [CourseController::class, 'category'])->name('courses.category');
Route::get('/courses/{slug}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/instructors', [CourseController::class, 'instructors'])->name('instructors');
Route::get('/instructors/{id}', [CourseController::class, 'instructor'])->name('instructors.show');

// المصادقة
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
    
    // تسجيل الدخول بجوجل
    Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // التسجيل في الدورات
    Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
    Route::get('/payment/{course}', [CourseController::class, 'payment'])->name('payment');
    Route::post('/payment/{course}', [CourseController::class, 'processPayment'])->name('payment.process');
    
    // صفحات الدفع
    Route::get('/payment/success/{payment}', [CourseController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/payment/cancel/{payment}', [CourseController::class, 'paymentCancel'])->name('payment.cancel');
    Route::get('/payment/bank-transfer/{payment}', [CourseController::class, 'bankTransferDetails'])->name('payment.bank-transfer');
    Route::get('/payment/cash/{payment}', [CourseController::class, 'cashPaymentDetails'])->name('payment.cash');
    Route::post('/payment/confirm/{payment}', [CourseController::class, 'confirmPayment'])->name('payment.confirm');
    
    // لوحة تحكم الطالب
    Route::prefix('student')->name('student.')->group(function () {
        // توجيه /student/ إلى لوحة التحكم أو تسجيل الدخول
        Route::get('/', function () {
            if (auth()->check() && auth()->user()->hasRole('student')) {
                return redirect()->route('student.dashboard');
            }
            return redirect()->route('login');
        })->name('index');
        
        Route::middleware('role:student')->group(function () {
            Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
            Route::get('/courses', [StudentController::class, 'courses'])->name('courses');
            Route::get('/courses/{course}', [StudentController::class, 'course'])->name('courses.show');
            Route::get('/courses/{course}/player/{lesson?}', [StudentController::class, 'coursePlayer'])->name('courses.player');
            Route::get('/courses/{course}/completion-celebration', [StudentController::class, 'courseCompletionCelebration'])->name('courses.completion-celebration');
            Route::get('/lessons', [StudentController::class, 'lessons'])->name('lessons');
            Route::get('/progress', [StudentController::class, 'progress'])->name('progress');
            Route::get('/settings', [StudentController::class, 'settings'])->name('settings');
            Route::put('/settings', [StudentController::class, 'updateSettings'])->name('settings.update');
            Route::get('/courses/{course}/lessons/{lesson}', [StudentController::class, 'lesson'])->name('lessons.show');
            Route::post('/lessons/{lesson}/complete', [StudentController::class, 'completeLesson'])->name('lessons.complete');
            Route::get('/certificates', [StudentController::class, 'certificates'])->name('certificates');
            Route::get('/certificates/{certificate}/download', [StudentController::class, 'downloadCertificate'])->name('certificates.download');
            
            Route::get('/payments', [StudentController::class, 'payments'])->name('payments');
            Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
            Route::put('/profile', [StudentController::class, 'updateProfile'])->name('profile.update');
            
            // مسارات الاختبارات
            Route::get('/quizzes/{quiz}/take', [StudentController::class, 'takeQuiz'])->name('quizzes.take');
            Route::post('/quizzes/{quiz}/submit', [StudentController::class, 'submitQuiz'])->name('quizzes.submit');
            Route::get('/quizzes/{quiz}/results', [StudentController::class, 'quizResults'])->name('quizzes.results');
        });
    });
    
    // لوحة تحكم المعلم
    Route::prefix('teacher')->name('teacher.')->group(function () {
        // توجيه /teacher/ إلى لوحة التحكم أو تسجيل الدخول
        Route::get('/', function () {
            if (auth()->check() && auth()->user()->hasRole('teacher')) {
                return redirect()->route('teacher.dashboard');
            }
            return redirect()->route('login');
        })->name('index');
        
        Route::middleware('role:teacher')->group(function () {
            Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('dashboard');
        
        // إدارة الدورات
        Route::get('/courses', [TeacherController::class, 'courses'])->name('courses.index');
        Route::get('/courses/create', [TeacherController::class, 'createCourse'])->name('courses.create');
        Route::post('/courses', [TeacherController::class, 'storeCourse'])->name('courses.store');
        Route::get('/courses/{course}', [TeacherController::class, 'showCourse'])->name('courses.show');
        Route::get('/courses/{course}/edit', [TeacherController::class, 'editCourse'])->name('courses.edit');
        Route::put('/courses/{course}', [TeacherController::class, 'updateCourse'])->name('courses.update');
        Route::delete('/courses/{course}', [TeacherController::class, 'destroyCourse'])->name('courses.destroy');
        Route::post('/courses/{course}/publish', [TeacherController::class, 'publishCourse'])->name('courses.publish');
        Route::post('/courses/{course}/unpublish', [TeacherController::class, 'unpublishCourse'])->name('courses.unpublish');
        
        // إدارة الدروس
        Route::get('/lessons', [TeacherController::class, 'lessons'])->name('lessons.index');
        Route::get('/lessons/create', [TeacherController::class, 'createLesson'])->name('lessons.create');
        Route::post('/lessons', [TeacherController::class, 'storeLesson'])->name('lessons.store');
        Route::get('/lessons/{lesson}/edit', [TeacherController::class, 'editLesson'])->name('lessons.edit');
        Route::put('/lessons/{lesson}', [TeacherController::class, 'updateLesson'])->name('lessons.update');
        Route::delete('/lessons/{lesson}', [TeacherController::class, 'destroyLesson'])->name('lessons.destroy');
        
        // إدارة الطلاب
        Route::get('/students', [TeacherController::class, 'students'])->name('students.index');
        Route::get('/students/{student}', [TeacherController::class, 'showStudent'])->name('students.show');
        Route::get('/students/{student}/progress', [TeacherController::class, 'studentProgress'])->name('students.progress');
        Route::get('/students/{student}/certificates', [TeacherController::class, 'studentCertificates'])->name('students.certificates');
        
        // إدارة التسجيلات
        Route::get('/enrollments', [TeacherController::class, 'enrollments'])->name('enrollments.index');
        Route::get('/enrollments/{enrollment}', [TeacherController::class, 'showEnrollment'])->name('enrollments.show');
        Route::put('/enrollments/{enrollment}/status', [TeacherController::class, 'updateEnrollmentStatus'])->name('enrollments.status');
        
        // التقارير والتحليلات
        Route::get('/reports', [TeacherController::class, 'reports'])->name('reports.index');
        Route::get('/reports/students', [TeacherController::class, 'studentReports'])->name('reports.students');
        Route::get('/reports/courses', [TeacherController::class, 'courseReports'])->name('reports.courses');
        Route::get('/reports/revenue', [TeacherController::class, 'revenueReports'])->name('reports.revenue');
        Route::get('/analytics', [TeacherController::class, 'analytics'])->name('analytics.index');
        
        // الملف الشخصي والإعدادات
        Route::get('/profile', [TeacherController::class, 'profile'])->name('profile');
        Route::put('/profile', [TeacherController::class, 'updateProfile'])->name('profile.update');
        Route::get('/settings', [TeacherController::class, 'settings'])->name('settings.index');
        Route::put('/settings', [TeacherController::class, 'updateSettings'])->name('settings.update');
        });
    });
    
    // لوحة تحكم المدير
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        
        Route::middleware('role:admin')->group(function () {
            Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // إدارة المستخدمين
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
        Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
        
        // إدارة الأقسام
        Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
        Route::get('/categories/create', [AdminController::class, 'createCategory'])->name('categories.create');
        Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
        Route::get('/categories/{category}/edit', [AdminController::class, 'editCategory'])->name('categories.edit');
        Route::put('/categories/{category}', [AdminController::class, 'updateCategory'])->name('categories.update');
        Route::delete('/categories/{category}', [AdminController::class, 'deleteCategory'])->name('categories.delete');
        
        // إدارة الدورات
        Route::get('/courses', [AdminController::class, 'courses'])->name('courses');
        Route::get('/courses/create', [AdminController::class, 'createCourse'])->name('courses.create');
        Route::post('/courses', [AdminController::class, 'storeCourse'])->name('courses.store');
        Route::get('/courses/{course}', [AdminController::class, 'course'])->name('courses.show');
        Route::get('/courses/{course}/edit', [AdminController::class, 'editCourse'])->name('courses.edit');
        Route::put('/courses/{course}', [AdminController::class, 'updateCourse'])->name('courses.update');
        Route::delete('/courses/{course}', [AdminController::class, 'deleteCourse'])->name('courses.delete');
        Route::put('/courses/{course}/status', [AdminController::class, 'updateCourseStatus'])->name('courses.status');
        
        // إدارة الدروس
        Route::get('/courses/{course}/lessons', [AdminController::class, 'courseLessons'])->name('courses.lessons');
        Route::get('/courses/{course}/lessons/create', [AdminController::class, 'createLesson'])->name('lessons.create');
        Route::post('/lessons', [AdminController::class, 'storeLesson'])->name('lessons.store');
        Route::get('/lessons/{lesson}', [AdminController::class, 'showLesson'])->name('lessons.show');
        Route::get('/lessons/{lesson}/edit', [AdminController::class, 'editLesson'])->name('lessons.edit');
        Route::put('/lessons/{lesson}', [AdminController::class, 'updateLesson'])->name('lessons.update');
        Route::delete('/lessons/{lesson}', [AdminController::class, 'deleteLesson'])->name('lessons.delete');
        Route::post('/lessons/{lesson}/reorder', [AdminController::class, 'reorderLessons'])->name('lessons.reorder');
        
        // إدارة الكويزات
        Route::get('/courses/{course}/quizzes', [AdminController::class, 'courseQuizzes'])->name('courses.quizzes');
        Route::get('/courses/{course}/quizzes/create', [AdminController::class, 'createQuiz'])->name('quizzes.create');
        Route::post('/quizzes', [AdminController::class, 'storeQuiz'])->name('quizzes.store');
        Route::get('/quizzes/{quiz}', [AdminController::class, 'showQuiz'])->name('quizzes.show');
        Route::get('/quizzes/{quiz}/edit', [AdminController::class, 'editQuiz'])->name('quizzes.edit');
        Route::put('/quizzes/{quiz}', [AdminController::class, 'updateQuiz'])->name('quizzes.update');
        Route::delete('/quizzes/{quiz}', [AdminController::class, 'deleteQuiz'])->name('quizzes.delete');
        
        // إدارة أسئلة الكويز
        Route::get('/quizzes/{quiz}/questions', [AdminController::class, 'quizQuestions'])->name('quizzes.questions');
        Route::post('/quizzes/{quiz}/questions', [AdminController::class, 'storeQuizQuestion'])->name('quizzes.questions.store');
        Route::put('/quizzes/{quiz}/questions/{question}', [AdminController::class, 'updateQuizQuestion'])->name('quizzes.questions.update');
        Route::delete('/quizzes/{quiz}/questions/{question}', [AdminController::class, 'deleteQuizQuestion'])->name('quizzes.questions.delete');
        Route::post('/quizzes/{quiz}/questions/reorder', [AdminController::class, 'reorderQuizQuestions'])->name('quizzes.questions.reorder');
        
        // إدارة الطلاب
        Route::get('/students', [AdminController::class, 'students'])->name('students');
        Route::get('/students/create', [AdminController::class, 'createStudent'])->name('students.create');
        Route::post('/students', [AdminController::class, 'storeStudent'])->name('students.store');
        Route::get('/students/{student}', [AdminController::class, 'student'])->name('students.show');
        Route::get('/students/{student}/edit', [AdminController::class, 'editStudent'])->name('students.edit');
        Route::put('/students/{student}', [AdminController::class, 'updateStudent'])->name('students.update');
        Route::delete('/students/{student}', [AdminController::class, 'deleteStudent'])->name('students.delete');
        
        // إدارة المدربين
        Route::get('/teachers', [AdminController::class, 'instructors'])->name('instructors');
        Route::get('/teachers/create', [AdminController::class, 'createInstructor'])->name('instructors.create');
        Route::post('/teachers', [AdminController::class, 'storeInstructor'])->name('instructors.store');
        Route::get('/teachers/{instructor}', [AdminController::class, 'instructor'])->name('instructors.show');
        Route::get('/teachers/{instructor}/edit', [AdminController::class, 'editInstructor'])->name('instructors.edit');
        Route::put('/teachers/{instructor}', [AdminController::class, 'updateInstructor'])->name('instructors.update');
        Route::delete('/teachers/{instructor}', [AdminController::class, 'deleteInstructor'])->name('instructors.delete');
        Route::post('/teachers/bulk-action', [AdminController::class, 'bulkActionInstructors'])->name('instructors.bulk-action');
        
        // إدارة المدفوعات
        Route::get('/payments', [AdminController::class, 'payments'])->name('payments');
        Route::get('/payments/{payment}', [AdminController::class, 'payment'])->name('payments.show');

        // إدارة رسائل التواصل
        Route::get('/contact', [AdminController::class, 'contactMessages'])->name('contact.index');
        Route::get('/contact/{message}', [AdminController::class, 'showContactMessage'])->name('contact.show');
        Route::post('/contact/{message}/status', [AdminController::class, 'updateContactMessageStatus'])->name('contact.status');
        Route::delete('/contact/{message}', [AdminController::class, 'deleteContactMessage'])->name('contact.delete');
        Route::get('/contact/export', [AdminController::class, 'exportContactMessages'])->name('contact.export');
        Route::put('/payments/{payment}/status', [AdminController::class, 'updatePaymentStatus'])->name('payments.status');
        
        // إدارة المحتوى
        Route::get('/blog', [AdminController::class, 'blog'])->name('blog');
        Route::get('/blog/create', [AdminController::class, 'createBlogPost'])->name('blog.create');
        Route::post('/blog', [AdminController::class, 'storeBlogPost'])->name('blog.store');
        Route::get('/blog/{post}/edit', [AdminController::class, 'editBlogPost'])->name('blog.edit');
        Route::put('/blog/{post}', [AdminController::class, 'updateBlogPost'])->name('blog.update');
        Route::delete('/blog/{post}', [AdminController::class, 'deleteBlogPost'])->name('blog.delete');
        
        // التقارير
        Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
        Route::get('/reports/export', [AdminController::class, 'exportReports'])->name('reports.export');
        
        // إدارة SEO
        Route::get('/seo', [AdminController::class, 'seo'])->name('seo');
        Route::put('/seo', [AdminController::class, 'updateSeo'])->name('seo.update');
        Route::post('/seo/generate-sitemap', [AdminController::class, 'generateSitemap'])->name('seo.sitemap');
        Route::post('/seo/submit-search-engines', [AdminController::class, 'submitToSearchEngines'])->name('seo.submit');
        Route::post('/seo/analyze-keywords', [AdminController::class, 'analyzeKeywords'])->name('seo.analyze-keywords');
        Route::post('/seo/check-page-speed', [AdminController::class, 'checkPageSpeed'])->name('seo.check-page-speed');
        Route::post('/seo/generate-robots-txt', [AdminController::class, 'generateRobotsTxt'])->name('seo.generate-robots-txt');
        Route::post('/seo/research-keyword', [AdminController::class, 'researchKeyword'])->name('seo.research-keyword');
        
        // إدارة الإشعارات
        Route::get('/notifications', [AdminController::class, 'notifications'])->name('notifications');
        Route::get('/notifications/{notification}', [AdminController::class, 'showNotification'])->name('notifications.show');
        Route::put('/notifications/{notification}/read', [AdminController::class, 'markNotificationRead'])->name('notifications.read');
        Route::put('/notifications/mark-all-read', [AdminController::class, 'markAllNotificationsRead'])->name('notifications.mark-all-read');
        Route::delete('/notifications/{notification}', [AdminController::class, 'deleteNotification'])->name('notifications.delete');
        
        // الإعدادات
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        Route::put('/settings', [AdminController::class, 'updateSettings'])->name('admin.settings.update');
    Route::get('/social-links', [AdminController::class, 'socialLinks'])->name('social-links');
        Route::post('/settings/clear-cache', [AdminController::class, 'clearCache'])->name('admin.settings.clear-cache');
        Route::post('/settings/backup-database', [AdminController::class, 'backupDatabase'])->name('admin.settings.backup-database');
        Route::post('/settings/optimize-database', [AdminController::class, 'optimizeDatabase'])->name('admin.settings.optimize-database');
        Route::post('/settings/maintenance-mode', [AdminController::class, 'maintenanceMode'])->name('admin.settings.maintenance-mode');
        
        // Dashboard API endpoints
        Route::get('/dashboard/stats', [AdminController::class, 'getDashboardStats'])->name('dashboard.stats');
        Route::get('/dashboard/activity', [AdminController::class, 'getRecentActivity'])->name('dashboard.activity');
        Route::get('/dashboard/system-status', [AdminController::class, 'getSystemStatus'])->name('dashboard.system-status');
        
                            // API routes for notifications
                            Route::get('/notifications/api', [AdminController::class, 'getNotifications'])->name('notifications.api');
        });
    });
});

// API Routes for AJAX requests
Route::prefix('api')->middleware('auth:sanctum')->group(function () {
    Route::get('/courses/{course}/lessons', [CourseController::class, 'apiLessons']);
    Route::post('/lessons/{lesson}/progress', [StudentController::class, 'updateProgress']);
    Route::get('/notifications', [HomeController::class, 'notifications']);
    Route::post('/notifications/{notification}/read', [HomeController::class, 'markNotificationRead']);
});

// Certificate routes
Route::get('/certificates/verify', [CertificateController::class, 'verify'])->name('certificates.verify');
Route::post('/certificates/verify', [CertificateController::class, 'verifyPost'])->name('certificates.verify.post');
Route::get('/certificates/verify/{number}', [CertificateController::class, 'verifyNumber'])->name('certificates.verify.number');

// Course Resources routes
Route::get('/course-resources/{id}/download', [CourseResourceController::class, 'download'])->name('course-resources.download');

// Messages routes
Route::middleware(['auth'])->group(function () {
    Route::get('/messages/inbox', [MessageController::class, 'inbox'])->name('messages.inbox');
    Route::get('/messages/sent', [MessageController::class, 'sent'])->name('messages.sent');
    Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{message}/reply', [MessageController::class, 'reply'])->name('messages.reply');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
    Route::patch('/messages/{message}/status', [MessageController::class, 'updateStatus'])->name('messages.update-status');
    Route::get('/messages/search', [MessageController::class, 'search'])->name('messages.search');
    Route::post('/courses/{course}/send-message', [MessageController::class, 'sendFromCourse'])->name('messages.send-from-course');
    Route::get('/messages/unread-count', [MessageController::class, 'unreadCount'])->name('messages.unread-count');
});
