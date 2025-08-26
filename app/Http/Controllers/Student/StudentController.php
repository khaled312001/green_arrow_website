<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\Certificate;
use App\Models\Payment;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use Illuminate\Support\Facades\Auth;
use App\Models\LessonCompletion;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * لوحة تحكم الطالب
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // إحصائيات الطالب العامة
        $stats = [
            'enrolled_courses' => $user->enrollments()->count(),
            'active_courses' => $user->enrollments()->where('status', 'active')->count(),
            'completed_courses' => $user->enrollments()->where('status', 'completed')->count(),
            'completed_lessons' => LessonCompletion::where('user_id', $user->id)->count(),
            'certificates' => $user->certificates()->count(),
            'total_hours' => $user->enrollments()->sum('total_hours_watched') ?? 0,
            'total_progress' => $user->enrollments()->avg('progress_percentage') ?? 0,
            'total_quizzes_taken' => \App\Models\QuizAttempt::where('user_id', $user->id)->count(),
            'average_quiz_score' => \App\Models\QuizAttempt::where('user_id', $user->id)->avg('percentage') ?? 0,
        ];
        
        // إحصائيات النشاط اليومي
        $today_stats = [
            'quizzes_taken' => \App\Models\QuizAttempt::where('user_id', $user->id)
                ->whereDate('created_at', today())->count(),
        ];
        
        // الدورات النشطة
        $enrolledCourses = $user->enrollments()
            ->with(['course.category', 'course.instructor', 'course.lessons'])
            ->where('status', 'active')
            ->latest()
            ->limit(6)
            ->get();
        
        // آخر النشاطات - محاولات الاختبارات وإكمال الدروس
        $recentActivity = collect();
        
        // إضافة محاولات الاختبارات
        $quizAttempts = \App\Models\QuizAttempt::where('user_id', $user->id)
            ->with(['quiz.course'])
            ->latest('created_at')
            ->limit(5)
            ->get()
            ->map(function($attempt) {
                $attempt->activity_type = 'quiz_attempted';
                $attempt->activity_date = $attempt->created_at;
                return $attempt;
            });
        
        $recentActivity = $recentActivity->merge($quizAttempts);
        
        // إضافة إكمال الدروس
        $lessonCompletions = LessonCompletion::where('user_id', $user->id)
            ->with(['lesson.course'])
            ->latest('created_at')
            ->limit(5)
            ->get()
            ->map(function($completion) {
                $completion->activity_type = 'lesson_completed';
                $completion->activity_date = $completion->created_at;
                return $completion;
            });
        
        $recentActivity = $recentActivity->merge($lessonCompletions);
        
        // ترتيب النشاطات حسب التاريخ
        $recentActivity = $recentActivity->sortByDesc('activity_date')->take(10);
        
        // الدورات المقترحة (نفس الفئة)
        $enrolled_categories = $user->enrollments()
            ->with('course.category')
            ->get()
            ->pluck('course.category.id')
            ->unique();
            
        $recommendedCourses = collect();
        
        if ($enrolled_categories->count() > 0) {
            $recommendedCourses = Course::published()
                ->whereIn('category_id', $enrolled_categories)
                ->whereDoesntHave('enrollments', function($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->limit(6)
                ->get();
        } else {
            // إذا لم يكن الطالب مسجل في أي دورة، اعرض دورات عشوائية
            $recommendedCourses = Course::published()
                ->with('instructor')
                ->limit(6)
                ->get();
        }

        // الدروس المقررة اليوم (المحاضرات المباشرة)
        $today_live_lessons = collect();
        if ($user->enrollments()->count() > 0) {
            $today_live_lessons = Lesson::whereIn('course_id', $user->enrollments()->pluck('course_id'))
                ->where('type', 'live_session')
                ->whereDate('live_session_date', today())
                ->with(['course', 'course.instructor'])
                ->orderBy('live_session_date')
                ->get();
        }

        // الدروس المقررة هذا الأسبوع
        $week_live_lessons = collect();
        if ($user->enrollments()->count() > 0) {
            $week_live_lessons = Lesson::whereIn('course_id', $user->enrollments()->pluck('course_id'))
                ->where('type', 'live_session')
                ->whereBetween('live_session_date', [now()->startOfWeek(), now()->endOfWeek()])
                ->with(['course', 'course.instructor'])
                ->orderBy('live_session_date')
                ->get();
        }

        // الاختبارات المطلوبة
        $pending_quizzes = collect();
        if ($user->enrollments()->count() > 0) {
            $pending_quizzes = \App\Models\Quiz::whereIn('course_id', $user->enrollments()->pluck('course_id'))
                ->where('is_active', true)
                ->whereDoesntHave('attempts', function($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->with(['course', 'course.instructor'])
                ->limit(5)
                ->get();
        }

        // إحصائيات الأداء الشهرية
        $monthly_stats = [
            'quizzes_taken' => \App\Models\QuizAttempt::where('user_id', $user->id)
                ->whereYear('created_at', now()->year)
                ->select(
                    \Illuminate\Support\Facades\DB::raw('strftime("%m", created_at) as month'),
                    \Illuminate\Support\Facades\DB::raw('COUNT(*) as count')
                )
                ->groupBy('month')
                ->orderBy('month')
                ->get(),
        ];

        // أفضل الدورات أداءً
        $best_performing_courses = $user->enrollments()
            ->with(['course', 'course.category'])
            ->orderByDesc('progress_percentage')
            ->limit(5)
            ->get();

        // الشهادات الحديثة
        $recent_certificates = $user->certificates()
            ->with(['course', 'course.instructor'])
            ->latest()
            ->limit(5)
            ->get();

        // إشعارات الطالب
        $notifications = \App\Models\Notification::where('user_id', $user->id)
            ->latest()
            ->limit(10)
            ->get();

        // تقويم التعلم
        $learning_calendar = collect();
        
        // إضافة المحاضرات المباشرة
        $learning_calendar = $learning_calendar->merge(
            $week_live_lessons->map(function($lesson) {
                return [
                    'type' => 'live_lesson',
                    'title' => $lesson->title_ar,
                    'date' => $lesson->live_session_date,
                    'course' => $lesson->course->title_ar,
                    'instructor' => $lesson->course->instructor->name,
                ];
            })
        );
        
        // إضافة مواعيد الاختبارات
        $learning_calendar = $learning_calendar->merge(
            $pending_quizzes->map(function($quiz) {
                return [
                    'type' => 'quiz_due',
                    'title' => $quiz->title_ar,
                    'date' => $quiz->due_date,
                    'course' => $quiz->course->title_ar,
                ];
            })
        );
        
        $learning_calendar = $learning_calendar->sortBy('date');

        return view('student.dashboard', compact(
            'stats',
            'today_stats',
            'enrolledCourses',
            'recentActivity',
            'recommendedCourses',
            'today_live_lessons',
            'week_live_lessons',
            'pending_quizzes',
            'monthly_stats',
            'best_performing_courses',
            'recent_certificates',
            'notifications',
            'learning_calendar'
        ));
    }

    /**
     * دورات الطالب
     */
    public function courses(Request $request)
    {
        $user = Auth::user();
        
        $query = $user->enrollments()->with(['course.category', 'course.instructor']);
        
        // تصفية حسب الحالة
        if ($request->status) {
            $query->where('status', $request->status);
        }
        
        // البحث
        if ($request->search) {
            $query->whereHas('course', function($courseQuery) use ($request) {
                $courseQuery->where('title_ar', 'like', '%' . $request->search . '%')
                           ->orWhere('title_en', 'like', '%' . $request->search . '%');
            });
        }
        
        $enrollments = $query->latest()->paginate(12);
        
        return view('student.courses.index', compact('enrollments'));
    }

    /**
     * عرض جميع الدروس للطالب
     */
    public function lessons(Request $request)
    {
        $user = Auth::user();
        
        // جلب جميع الدروس من الدورات المسجل بها الطالب
        $query = Lesson::whereIn('course_id', $user->enrollments()->pluck('course_id'))
            ->with(['course', 'course.instructor'])
            ->published();
        
        // تصفية حسب الدورة
        if ($request->course_id) {
            $query->where('course_id', $request->course_id);
        }
        
        // تصفية حسب النوع
        if ($request->type) {
            $query->where('type', $request->type);
        }
        
        // البحث
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title_ar', 'like', '%' . $request->search . '%')
                  ->orWhere('title_en', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }
        
        $lessons = $query->ordered()->paginate(15);
        
        // الدورات المسجل بها الطالب للتصفية
        $enrolled_courses = $user->enrollments()
            ->with('course')
            ->get()
            ->pluck('course');
        
        return view('student.lessons.index', compact('lessons', 'enrolled_courses'));
    }

    /**
     * عرض تقدم الطالب
     */
    public function progress()
    {
        $user = Auth::user();
        
        // إحصائيات التقدم العامة
        $stats = [
            'total_courses' => $user->enrollments()->count(),
            'completed_courses' => $user->enrollments()->where('status', 'completed')->count(),
            'in_progress_courses' => $user->enrollments()->where('status', 'active')->count(),
            'total_lessons_completed' => $user->enrollments()->sum('lessons_completed'),
            'total_hours_watched' => $user->enrollments()->sum('total_hours_watched') ?? 0,
            'average_progress' => $user->enrollments()->avg('progress_percentage') ?? 0,
            'total_quizzes_taken' => \App\Models\QuizAttempt::where('user_id', $user->id)->count(),
            'average_quiz_score' => \App\Models\QuizAttempt::where('user_id', $user->id)
                ->where('status', 'completed')->avg('score') ?? 0,
        ];
        
        // تقدم الدورات
        $course_progress = $user->enrollments()
            ->with(['course', 'course.category', 'course.instructor'])
            ->orderByDesc('progress_percentage')
            ->get();
        
        // إحصائيات شهرية
        $monthly_progress = \App\Models\QuizAttempt::where('user_id', $user->id)
            ->whereYear('created_at', now()->year)
            ->select(
                \Illuminate\Support\Facades\DB::raw('strftime("%m", created_at) as month'),
                \Illuminate\Support\Facades\DB::raw('COUNT(*) as quizzes_taken'),
                \Illuminate\Support\Facades\DB::raw('AVG(score) as average_score')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        
        // أفضل الدورات أداءً
        $best_performing_courses = $user->enrollments()
            ->with(['course', 'course.category'])
            ->orderByDesc('progress_percentage')
            ->limit(5)
            ->get();
        
        // الشهادات المحصل عليها
        $certificates = $user->certificates()
            ->with(['course', 'course.instructor'])
            ->latest()
            ->get();
        
        // النشاط الأخير
        $recent_activity = \App\Models\QuizAttempt::where('user_id', $user->id)
            ->with(['quiz.course'])
            ->latest('created_at')
            ->limit(10)
            ->get();

        return view('student.progress.index', compact(
            'stats',
            'course_progress',
            'monthly_progress',
            'best_performing_courses',
            'certificates',
            'recent_activity'
        ));
    }

    /**
     * عرض إعدادات الطالب
     */
    public function settings()
    {
        $user = Auth::user();
        
        // Load existing settings
        $notificationPreferences = json_decode($user->settings()->where('key', 'notification_preferences')->first()->value ?? '{}', true);
        $privacySettings = json_decode($user->settings()->where('key', 'privacy_settings')->first()->value ?? '{}', true);
        $securitySettings = json_decode($user->settings()->where('key', 'security_settings')->first()->value ?? '{}', true);
        
        return view('student.settings.index', compact('user', 'notificationPreferences', 'privacySettings', 'securitySettings'));
    }

    /**
     * تحديث إعدادات الطالب
     */
    public function updateSettings(Request $request)
    {
        $user = Auth::user();
        $settingsType = $request->input('settings_type');

        switch ($settingsType) {
            case 'notifications':
                return $this->updateNotificationSettings($request, $user);
            case 'privacy':
                return $this->updatePrivacySettings($request, $user);
            case 'security':
                return $this->updateSecuritySettings($request, $user);
            default:
                return back()->with('error', 'نوع الإعدادات غير صحيح');
        }
    }

    private function updateNotificationSettings(Request $request, $user)
    {
        $request->validate([
            'notification_preferences' => 'nullable|array',
            'notification_preferences.email' => 'nullable|boolean',
            'notification_preferences.sms' => 'nullable|boolean',
            'notification_preferences.new_course' => 'nullable|boolean',
            'notification_preferences.lesson_reminder' => 'nullable|boolean',
            'notification_preferences.quiz_reminder' => 'nullable|boolean',
        ]);

        $notificationPreferences = $request->input('notification_preferences', []);
        
        $user->settings()->updateOrCreate(
            ['key' => 'notification_preferences'],
            ['value' => json_encode($notificationPreferences)]
        );

        return back()->with('success', 'تم تحديث إعدادات الإشعارات بنجاح');
    }

    private function updatePrivacySettings(Request $request, $user)
    {
        $request->validate([
            'privacy_settings' => 'nullable|array',
            'privacy_settings.profile_public' => 'nullable|boolean',
            'privacy_settings.show_progress' => 'nullable|boolean',
            'privacy_settings.show_certificates' => 'nullable|boolean',
        ]);

        $privacySettings = $request->input('privacy_settings', []);
        
        $user->settings()->updateOrCreate(
            ['key' => 'privacy_settings'],
            ['value' => json_encode($privacySettings)]
        );

        return back()->with('success', 'تم تحديث إعدادات الخصوصية بنجاح');
    }

    private function updateSecuritySettings(Request $request, $user)
    {
        $request->validate([
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
            'new_password_confirmation' => 'nullable|required_with:new_password',
            'security_settings' => 'nullable|array',
            'security_settings.two_factor' => 'nullable|boolean',
            'security_settings.login_notifications' => 'nullable|boolean',
        ]);

        // Handle password change
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'كلمة المرور الحالية غير صحيحة']);
            }

            $user->update([
                'password' => Hash::make($request->new_password)
            ]);
        }

        $securitySettings = $request->input('security_settings', []);
        
        $user->settings()->updateOrCreate(
            ['key' => 'security_settings'],
            ['value' => json_encode($securitySettings)]
        );

        $message = 'تم تحديث إعدادات الأمان بنجاح';
        if ($request->filled('new_password')) {
            $message .= ' وتم تغيير كلمة المرور بنجاح';
        }

        return back()->with('success', $message);
    }

    /**
     * عرض دورة محددة
     */
    public function course(Course $course)
    {
        $user = Auth::user();
        
        // التحقق من تسجيل الطالب في الدورة
        $enrollment = $user->enrollments()
            ->where('course_id', $course->id)
            ->first();
            
        if (!$enrollment) {
            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'يجب التسجيل في الدورة أولاً للوصول إلى المحتوى');
        }
        
        // جلب الدروس مع حالة الإكمال
        $lessons = $course->lessons()
            ->published()
            ->ordered()
            ->get();
        
        // الدرس التالي
        $next_lesson = $lessons->where('sort_order', '>', $enrollment->last_lesson_id ?? 0)->first();
        
        // آخر درس تم الوصول إليه
        $current_lesson = $enrollment->last_lesson_id 
            ? $lessons->where('id', $enrollment->last_lesson_id)->first()
            : $lessons->first();

        return view('student.courses.show', compact(
            'course',
            'enrollment',
            'lessons',
            'next_lesson',
            'current_lesson'
        ));
    }

    /**
     * عرض صفحة متابعة الدورة الاحترافية
     */
    public function coursePlayer(Course $course, Lesson $lesson = null)
    {
        $user = Auth::user();
        
        // التحقق من تسجيل الطالب في الدورة
        $enrollment = $user->enrollments()
            ->where('course_id', $course->id)
            ->first();
            
        if (!$enrollment) {
            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'يجب التسجيل في الدورة أولاً');
        }
        
        // التحقق من حالة التسجيل
        if ($enrollment->status === 'pending') {
            return redirect()->route('courses.show', $course->slug)
                ->with('warning', 'تسجيلك في الدورة قيد الانتظار حتى تأكيد الإدارة. سيتم إعلامك عند التأكيد.');
        }
        
        if (!in_array($enrollment->status, ['active', 'completed'])) {
            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'لا يمكن الوصول للدورة في الوقت الحالي. يرجى التواصل مع الإدارة.');
        }
        
        // جميع الدروس في الدورة
        $lessons = $course->lessons()
            ->published()
            ->ordered()
            ->get();
        
        // تحديد الدرس الحالي
        $current_lesson = $lesson ?: $lessons->first();
        
        // تحديث آخر درس تم الوصول إليه
        if ($current_lesson) {
            $enrollment->update([
                'last_lesson_id' => $current_lesson->id,
                'last_accessed_at' => now()
            ]);
        }
        
        // الدرس التالي
        $next_lesson = $lessons->where('sort_order', '>', $current_lesson->sort_order)->first();

        return view('student.courses.player', compact(
            'course',
            'enrollment',
            'lessons',
            'current_lesson',
            'next_lesson'
        ));
    }

    /**
     * عرض درس محدد
     */
    public function lesson(Course $course, Lesson $lesson)
    {
        $user = Auth::user();
        
        // التحقق من تسجيل الطالب في الدورة
        $enrollment = $user->enrollments()
            ->where('course_id', $course->id)
            ->first();
            
        if (!$enrollment) {
            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'يجب التسجيل في الدورة أولاً');
        }
        
        // التحقق من حالة التسجيل
        if ($enrollment->status === 'pending') {
            return redirect()->route('courses.show', $course->slug)
                ->with('warning', 'تسجيلك في الدورة قيد الانتظار حتى تأكيد الإدارة. سيتم إعلامك عند التأكيد.');
        }
        
        if (!in_array($enrollment->status, ['active', 'completed'])) {
            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'لا يمكن الوصول للدورة في الوقت الحالي. يرجى التواصل مع الإدارة.');
        }
        
        // تحديث آخر درس تم الوصول إليه
        $enrollment->update([
            'last_lesson_id' => $lesson->id,
            'last_accessed_at' => now()
        ]);
        
        // الدروس الأخرى في الدورة
        $course_lessons = $course->lessons()
            ->published()
            ->ordered()
            ->get();
            
        // الدرس التالي والسابق
        $current_index = $course_lessons->search(function($item) use ($lesson) {
            return $item->id === $lesson->id;
        });
        
        $previous_lesson = $current_index > 0 ? $course_lessons[$current_index - 1] : null;
        $next_lesson = $current_index < $course_lessons->count() - 1 ? $course_lessons[$current_index + 1] : null;

        return view('student.lessons.show', compact(
            'course',
            'lesson',
            'enrollment',
            'course_lessons',
            'previous_lesson',
            'next_lesson'
        ));
    }

    /**
     * تحديث تقدم الطالب (API)
     */
    public function updateProgress(Request $request, Lesson $lesson)
    {
        $user = Auth::user();
        
        $enrollment = $user->enrollments()
            ->where('course_id', $lesson->course_id)
            ->first();
            
        if (!$enrollment) {
            return response()->json(['success' => false], 403);
        }
        
        // تحديث آخر وقت وصول
        $enrollment->update(['last_accessed_at' => now()]);
        
        return response()->json(['success' => true]);
    }

    /**
     * إكمال درس معين
     */
    public function completeLesson(Request $request, Lesson $lesson)
    {
        $user = Auth::user();
        
        // التحقق من وجود تسجيل في الدورة
        $enrollment = $user->enrollments()
            ->where('course_id', $lesson->course_id)
            ->where('status', 'active')
            ->first();
            
        if (!$enrollment) {
            return response()->json([
                'success' => false,
                'message' => 'لا يمكن إكمال الدرس - لم يتم التسجيل في الدورة'
            ], 403);
        }

        // التحقق من عدم إكمال الدرس مسبقاً
        $existingCompletion = LessonCompletion::where('enrollment_id', $enrollment->id)
                                             ->where('lesson_id', $lesson->id)
                                             ->exists();
        
        if ($existingCompletion) {
            return response()->json([
                'success' => false,
                'message' => 'تم إكمال هذا الدرس مسبقاً'
            ], 400);
        }

        // إنشاء تسجيل إكمال الدرس
        LessonCompletion::create([
            'enrollment_id' => $enrollment->id,
            'lesson_id' => $lesson->id,
            'user_id' => $user->id,
            'completed_at' => now(),
            'time_spent_minutes' => $request->input('time_spent_minutes', 0),
            'progress_percentage' => 100,
            'quiz_results' => $request->input('quiz_results')
        ]);

        // تحديث إحصائيات التسجيل
        $completedCount = LessonCompletion::where('enrollment_id', $enrollment->id)->count();
        $totalLessons = Lesson::where('course_id', $lesson->course_id)
                             ->where('is_published', true)
                             ->count();
        $progressPercentage = $totalLessons > 0 ? round(($completedCount / $totalLessons) * 100) : 0;

        $enrollment->update([
            'lessons_completed' => $completedCount,
            'total_lessons' => $totalLessons,
            'progress_percentage' => $progressPercentage,
            'last_lesson_id' => $lesson->id,
            'last_accessed_at' => now()
        ]);

        // التحقق من اكتمال الدورة
        if ($progressPercentage >= 100) {
            $enrollment->update([
                'status' => 'completed',
                'completed_at' => now()
            ]);
            
            // إنشاء شهادة
            $this->generateCertificate($enrollment);
        }

        $response = [
            'success' => true,
            'message' => 'تم إكمال الدرس بنجاح',
            'progress' => $progressPercentage,
            'completed_lessons' => $completedCount,
            'total_lessons' => $totalLessons
        ];

        // إذا تم إكمال الدورة، أضف رابط التهنئة
        if ($progressPercentage >= 100) {
            $response['course_completed'] = true;
            $response['celebration_url'] = route('student.courses.completion-celebration', $lesson->course);
        }

        return response()->json($response);
    }

    /**
     * الشهادات
     */
    public function certificates()
    {
        $user = Auth::user();
        $certificates = $user->certificates()->with('course')->latest()->paginate(10);
        
        return view('student.certificates.index', compact('certificates'));
    }

    /**
     * تحميل شهادة
     */
    public function downloadCertificate(Certificate $certificate)
    {
        // التحقق من أن الشهادة تخص الطالب الحالي
        if ($certificate->user_id !== Auth::id()) {
            abort(403);
        }
        
        // إنشاء PDF للشهادة
        $pdf = \PDF::loadView('certificates.pdf', [
            'certificate' => $certificate,
            'user' => $certificate->user,
            'course' => $certificate->course,
            'enrollment' => $certificate->enrollment,
        ]);
        
        // إعدادات PDF للتصميم الصحيح
        $pdf->setPaper('a4', 'landscape');
        $pdf->setOption('isRemoteEnabled', true);
        $pdf->setOption('isHtml5ParserEnabled', true);
        $pdf->setOption('isFontSubsettingEnabled', true);
        
        $filename = "شهادة_{$certificate->course->title_ar}_{$certificate->user->name}.pdf";
        
        return $pdf->download($filename);
    }

    /**
     * المدفوعات
     */
    public function payments()
    {
        $user = Auth::user();
        $payments = $user->payments()->with('course')->latest()->paginate(15);
        
        return view('student.payments.index', compact('payments'));
    }

    /**
     * الملف الشخصي
     */
    public function profile()
    {
        $user = Auth::user();
        return view('student.profile.edit', compact('user'));
    }

    /**
     * تحديث الملف الشخصي
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
            'bio' => 'nullable|string|max:1000',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
        ], [
            'name.required' => 'الاسم مطلوب',
        ]);
        
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'city' => $request->city,
            'bio' => $request->bio,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
        ]);
        
        // تحديث كلمة المرور إذا تم إدخالها
        if ($request->password) {
            $request->validate([
                'password' => 'min:8|confirmed',
            ], [
                'password.min' => 'كلمة المرور يجب أن تكون 8 أحرف على الأقل',
                'password.confirmed' => 'تأكيد كلمة المرور غير متطابق',
            ]);
            
            $user->update(['password' => Hash::make($request->password)]);
        }
        
        return back()->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }

    /**
     * إنشاء شهادة للطالب
     */
    private function generateCertificate(Enrollment $enrollment)
    {
        // التحقق من عدم وجود شهادة مسبقة
        if ($enrollment->certificate_issued) {
            return;
        }
        
        $certificate_number = 'GA-' . date('Y') . '-' . str_pad($enrollment->id, 6, '0', STR_PAD_LEFT);
        
        Certificate::create([
            'user_id' => $enrollment->user_id,
            'course_id' => $enrollment->course_id,
            'enrollment_id' => $enrollment->id,
            'certificate_number' => $certificate_number,
            'issued_at' => now(),
        ]);
        
        // تحديث حالة الشهادة في التسجيل
        $enrollment->update([
            'certificate_issued' => true,
            'certificate_issued_at' => now(),
            'certificate_number' => $certificate_number,
        ]);
    }

    /**
     * عرض صفحة الاختبار
     */
    public function takeQuiz(Quiz $quiz)
    {
        $user = Auth::user();
        
        // التحقق من تسجيل الطالب في الدورة
        $enrollment = $user->enrollments()
            ->where('course_id', $quiz->course_id)
            ->whereIn('status', ['active', 'completed'])
            ->first();
            
        if (!$enrollment) {
            return redirect()->route('courses.show', $quiz->course->slug)
                ->with('error', 'يجب التسجيل في الدورة أولاً');
        }
        
        // التحقق من عدم وجود محاولة سابقة
        $existingAttempt = QuizAttempt::where('user_id', $user->id)
            ->where('quiz_id', $quiz->id)
            ->first();
            
        if ($existingAttempt) {
            return redirect()->route('student.quizzes.results', $quiz)
                ->with('info', 'لقد أخذت هذا الاختبار مسبقاً');
        }
        
        $questions = $quiz->questions()->ordered()->get();
        
        return view('student.quizzes.take', compact('quiz', 'questions', 'enrollment'));
    }

    /**
     * إرسال إجابات الاختبار
     */
    public function submitQuiz(Request $request, Quiz $quiz)
    {
        $user = Auth::user();
        
        // التحقق من تسجيل الطالب في الدورة
        $enrollment = $user->enrollments()
            ->where('course_id', $quiz->course_id)
            ->whereIn('status', ['active', 'completed'])
            ->first();
            
        if (!$enrollment) {
            return response()->json(['error' => 'غير مصرح لك بأخذ هذا الاختبار'], 403);
        }
        
        // التحقق من عدم وجود محاولة سابقة
        $existingAttempt = QuizAttempt::where('user_id', $user->id)
            ->where('quiz_id', $quiz->id)
            ->first();
            
        if ($existingAttempt) {
            return response()->json(['error' => 'لقد أخذت هذا الاختبار مسبقاً'], 400);
        }
        
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|string',
        ]);
        
        // حساب النتيجة
        $score = 0;
        $totalQuestions = $quiz->questions()->count();
        
        foreach ($request->answers as $questionId => $answer) {
            $question = $quiz->questions()->find($questionId);
            if ($question && $question->correct_answer === $answer) {
                $score++;
            }
        }
        
        $percentage = ($score / $totalQuestions) * 100;
        $isPassed = $percentage >= $quiz->passing_score;
        
        // حفظ المحاولة
        QuizAttempt::create([
            'user_id' => $user->id,
            'quiz_id' => $quiz->id,
            'score' => $score,
            'total_points' => $totalQuestions,
            'percentage' => $percentage,
            'is_passed' => $isPassed,
            'started_at' => now(),
            'completed_at' => now(),
        ]);
        
        return response()->json([
            'success' => true,
            'score' => $score,
            'total' => $totalQuestions,
            'percentage' => $percentage,
            'is_passed' => $isPassed,
            'redirect_url' => route('student.quizzes.results', $quiz)
        ]);
    }

    /**
     * عرض نتائج الاختبار
     */
    public function quizResults(Quiz $quiz)
    {
        $user = Auth::user();
        
        // التحقق من تسجيل الطالب في الدورة
        $enrollment = $user->enrollments()
            ->where('course_id', $quiz->course_id)
            ->whereIn('status', ['active', 'completed'])
            ->first();
            
        if (!$enrollment) {
            return redirect()->route('courses.show', $quiz->course->slug)
                ->with('error', 'يجب التسجيل في الدورة أولاً');
        }
        
        $attempt = QuizAttempt::where('user_id', $user->id)
            ->where('quiz_id', $quiz->id)
            ->first();
            
        if (!$attempt) {
            return redirect()->route('student.quizzes.take', $quiz)
                ->with('error', 'لم تأخذ هذا الاختبار بعد');
        }
        
        return view('student.quizzes.results', compact('quiz', 'attempt', 'enrollment'));
    }

    /**
     * عرض صفحة التهنئة عند إكمال الدورة
     */
    public function courseCompletionCelebration(Course $course)
    {
        $user = Auth::user();
        
        // التحقق من تسجيل الطالب في الدورة
        $enrollment = $user->enrollments()
            ->where('course_id', $course->id)
            ->where('status', 'completed')
            ->first();
            
        if (!$enrollment) {
            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'يجب إكمال الدورة أولاً');
        }
        
        // التحقق من أن الدورة مكتملة بنسبة 100%
        if ($enrollment->progress_percentage < 100) {
            return redirect()->route('student.courses.player', ['course' => $course->id])
                ->with('warning', 'يجب إكمال جميع الدروس أولاً');
        }
        
        // الحصول على الشهادة إن وجدت
        $certificate = $user->certificates()
            ->where('course_id', $course->id)
            ->first();
        
        // إحصائيات الدورة
        $courseStats = [
            'total_lessons' => $enrollment->total_lessons,
            'completed_lessons' => $enrollment->lessons_completed,
            'total_hours' => $enrollment->total_hours_watched ?? 0,
            'completion_date' => $enrollment->completed_at,
            'certificate_issued' => $certificate ? true : false,
            'certificate_number' => $certificate ? $certificate->certificate_number : null,
        ];
        
        return view('student.courses.completion-celebration', compact(
            'course', 
            'enrollment', 
            'certificate', 
            'courseStats'
        ));
    }
}
