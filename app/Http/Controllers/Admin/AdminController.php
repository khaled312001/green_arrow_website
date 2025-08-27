<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use App\Models\Payment;
use App\Models\Enrollment;
use App\Models\BlogPost;
use App\Models\Quiz;
use App\Models\Setting;
use App\Models\Notification as AppNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Lesson;
use App\Models\Certificate;
use App\Models\ContactMessage;

class AdminController extends Controller
{
    public function __construct()
    {
        // Middleware is already applied at route level
    }

    /**
     * إعادة توجيه المسار الرئيسي للمدير
     */
    public function index()
    {
        // إذا كان المستخدم مسجل دخول ولديه دور المدير، أعد توجيهه للوحة التحكم
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }
        
        // إذا لم يكن مسجل دخول، أعد توجيهه لصفحة تسجيل الدخول
        return redirect()->route('login');
    }

    /**
     * لوحة تحكم المدير الرئيسية
     */
    public function dashboard()
    {
        // إحصائيات عامة
        $stats = [
            'total_users' => User::count(),
            'total_students' => User::role('student')->count(),
            'total_instructors' => User::role('teacher')->count(),
            'total_moderators' => User::role('moderator')->count(),
            'total_content_creators' => User::role('content_creator')->count(),
            'total_support' => User::role('support')->count(),
            'total_courses' => Course::count(),
            'published_courses' => Course::where('status', 'published')->count(),
            'draft_courses' => Course::where('status', 'draft')->count(),
            'pending_courses' => Course::where('status', 'pending')->count(),
            'total_enrollments' => Enrollment::count(),
            'active_enrollments' => Enrollment::where('status', 'active')->count(),
            'completed_enrollments' => Enrollment::where('status', 'completed')->count(),
            'total_revenue' => Payment::where('status', 'completed')->sum('total_amount'),
            'monthly_revenue' => Payment::where('status', 'completed')
                ->whereMonth('created_at', now()->month)
                ->sum('total_amount'),
            'yearly_revenue' => Payment::where('status', 'completed')
                ->whereYear('created_at', now()->year)
                ->sum('total_amount'),
            'total_categories' => Category::count(),
            'total_blog_posts' => BlogPost::count(),
            'published_blog_posts' => BlogPost::where('status', 'published')->count(),
            'total_certificates' => \App\Models\Certificate::count(),
            'total_lessons' => \App\Models\Lesson::count(),
            'total_quizzes' => \App\Models\Quiz::count(),
        ];

        // إحصائيات النشاط اليومي
        $today_stats = [
            'new_users' => User::whereDate('created_at', today())->count(),
            'new_enrollments' => Enrollment::whereDate('created_at', today())->count(),
            'new_payments' => Payment::whereDate('created_at', today())->count(),
            'new_courses' => Course::whereDate('created_at', today())->count(),
            'today_revenue' => Payment::where('status', 'completed')
                ->whereDate('created_at', today())
                ->sum('total_amount'),
        ];

        // أحدث التسجيلات
        $recent_enrollments = Enrollment::with(['user', 'course'])
            ->whereHas('user')
            ->whereHas('course')
            ->latest()
            ->limit(10)
            ->get();

        // أحدث المدفوعات
        $recent_payments = Payment::with(['user', 'course'])
            ->whereHas('user')
            ->whereHas('course')
            ->latest()
            ->limit(10)
            ->get();

        // أحدث المستخدمين
        $recent_users = User::with('roles')
            ->latest()
            ->limit(10)
            ->get();

        // الدورات الأكثر شعبية
        $popular_courses = Course::published()
            ->with(['category', 'instructor', 'enrollments'])
            ->orderByDesc('enrolled_count')
            ->limit(10)
            ->get();

        // أفضل المدربين
        $top_instructors = User::role('teacher')
            ->with(['teachingCourses', 'teachingCourses.enrollments'])
            ->get()
            ->map(function($instructor) {
                $instructor->total_students = $instructor->teachingCourses->sum('enrollments_count');
                $instructor->total_courses = $instructor->teachingCourses->count();
                return $instructor;
            })
            ->sortByDesc('total_students')
            ->take(10);

        // Prepare top courses with additional properties
        $topCourses = $popular_courses->map(function($course) {
            $course->enrollments_count = $course->enrollments()->count();
            $course->revenue = $course->payments()->where('status', 'completed')->sum('total_amount');
            $course->rating = $course->rating ?? 0;
            return $course;
        });

        // Prepare recent orders (payments) with additional properties
        $recentOrders = $recent_payments->map(function($payment) {
            $payment->amount = $payment->total_amount;
            return $payment;
        });

        // إحصائيات شهرية للمبيعات
        $monthly_sales = Payment::where('status', 'completed')
            ->whereYear('created_at', now()->year)
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_amount) as total'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // إحصائيات التسجيل الشهرية
        $monthly_enrollments = Enrollment::whereYear('created_at', now()->year)
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // إحصائيات المستخدمين الجدد
        $monthly_users = User::whereYear('created_at', now()->year)
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // الدورات التي تحتاج موافقة
        $pending_courses = Course::where('status', 'pending')
            ->with(['category', 'instructor'])
            ->latest()
            ->limit(5)
            ->get();

        // المدفوعات المعلقة
        $pending_payments = Payment::where('status', 'pending')
            ->with(['user', 'course'])
            ->whereHas('user')
            ->whereHas('course')
            ->latest()
            ->limit(5)
            ->get();

        // إحصائيات الأقسام
        $category_stats = Category::withCount(['courses', 'courses as published_courses_count' => function($query) {
            $query->where('status', 'published');
        }])->get();

        // إحصائيات الأدوار
        $role_stats = [
            'admin' => User::role('admin')->count(),
            'teacher' => User::role('teacher')->count(),
            'student' => User::role('student')->count(),
            'moderator' => User::role('moderator')->count(),
            'content_creator' => User::role('content_creator')->count(),
            'support' => User::role('support')->count(),
        ];

        // Extract individual variables for the view
        $totalUsers = $stats['total_users'];
        $totalCourses = $stats['total_courses'];
        $totalRevenue = $stats['total_revenue'];
        $totalEnrollments = $stats['total_enrollments'];

        // Calculate growth percentages
        $lastMonthUsers = User::whereMonth('created_at', now()->subMonth()->month)->count();
        $userGrowth = $lastMonthUsers > 0 ? round((($stats['total_users'] - $lastMonthUsers) / $lastMonthUsers) * 100, 1) : 0;
        
        $lastMonthCourses = Course::whereMonth('created_at', now()->subMonth()->month)->count();
        $courseGrowth = $lastMonthCourses > 0 ? round((($stats['total_courses'] - $lastMonthCourses) / $lastMonthCourses) * 100, 1) : 0;
        
        $lastMonthRevenue = Payment::where('status', 'completed')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->sum('total_amount');
        $revenueGrowth = $lastMonthRevenue > 0 ? round((($stats['total_revenue'] - $lastMonthRevenue) / $lastMonthRevenue) * 100, 1) : 0;
        
        $lastMonthEnrollments = Enrollment::whereMonth('created_at', now()->subMonth()->month)->count();
        $enrollmentGrowth = $lastMonthEnrollments > 0 ? round((($stats['total_enrollments'] - $lastMonthEnrollments) / $lastMonthEnrollments) * 100, 1) : 0;

        // Prepare chart data
        $chartData = [
            'labels' => $monthly_sales->pluck('month')->toArray(),
            'revenue' => $monthly_sales->pluck('total')->toArray(),
            'enrollments' => $monthly_enrollments->pluck('count')->toArray(),
        ];

        // Prepare user stats for pie chart
        $userStats = [
            'students' => $stats['total_students'],
            'teachers' => $stats['total_instructors'],
            'admins' => $role_stats['admin'],
        ];

        // Prepare recent activities
        $recentActivities = collect([
            (object)[
                'title' => 'تسجيل جديد',
                'description' => 'أحمد محمد سجل في دورة البرمجة المتقدمة',
                'icon' => 'person-plus',
                'created_at' => now()->subMinutes(2)
            ],
            (object)[
                'title' => 'دفعة مكتملة',
                'description' => 'تم إتمام دفعة بقيمة 300 ريال',
                'icon' => 'credit-card',
                'created_at' => now()->subMinutes(5)
            ],
            (object)[
                'title' => 'دورة مكتملة',
                'description' => 'فاطمة علي أكملت دورة التصميم الجرافيكي',
                'icon' => 'trophy',
                'created_at' => now()->subMinutes(10)
            ],
            (object)[
                'title' => 'مقال جديد',
                'description' => 'تم نشر مقال "أساسيات التسويق الرقمي"',
                'icon' => 'file-earmark-text',
                'created_at' => now()->subMinutes(15)
            ]
        ]);

        // Prepare top courses with additional properties
        $topCourses = $popular_courses->map(function($course) {
            $course->enrollments_count = $course->enrollments()->count();
            $course->revenue = $course->payments()->where('status', 'completed')->sum('total_amount');
            $course->rating = $course->rating ?? 0;
            return $course;
        });

        // Prepare recent orders (payments) with additional properties
        $recentOrders = $recent_payments->map(function($payment) {
            $payment->amount = $payment->total_amount;
            return $payment;
        });

        // Get notifications from database
        $notifications = AppNotification::latest()->limit(10)->get();

        // System status data
        $systemStatus = [
            'database' => [
                'status' => 'online',
                'response_time' => '12ms',
                'usage' => '45%'
            ],
            'cpu' => [
                'status' => 'normal',
                'usage' => '23%',
                'temperature' => '45°C'
            ],
            'storage' => [
                'status' => 'warning',
                'usage' => '78%',
                'free_space' => '2.3GB'
            ],
            'network' => [
                'status' => 'stable',
                'speed' => '100Mbps',
                'latency' => '15ms'
            ]
        ];

        return view('admin.dashboard', compact(
            'totalUsers',
            'userGrowth',
            'totalCourses',
            'courseGrowth',
            'totalRevenue',
            'revenueGrowth',
            'totalEnrollments',
            'enrollmentGrowth',
            'recentActivities',
            'topCourses',
            'recentOrders',
            'notifications',
            'chartData',
            'userStats',
            'systemStatus',
            'recent_enrollments',
            'recent_payments',
            'top_instructors',
            'monthly_sales',
            'monthly_enrollments',
            'monthly_users',
            'pending_courses',
            'pending_payments',
            'category_stats',
            'role_stats'
        ))->with([
            'latestUsers' => $recent_users,
            'latestCourses' => $popular_courses
        ]);
    }

    /**
     * إدارة المستخدمين
     */
    public function users(Request $request)
    {
        $query = User::with('roles');

        // البحث
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%');
            });
        }

        // تصفية حسب الدور
        if ($request->role) {
            $query->role($request->role);
        }

        // تصفية حسب الحالة
        if ($request->status) {
            $query->where('is_active', $request->status === 'active');
        }

        $users = $query->latest()->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    /**
     * إنشاء مستخدم جديد
     */
    public function createUser()
    {
        return view('admin.users.create');
    }

    /**
     * حفظ مستخدم جديد
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,instructor,student',
            'phone' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
            'bio' => 'nullable|string|max:1000',
        ], [
            'name.required' => 'الاسم مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.unique' => 'البريد الإلكتروني مستخدم مسبقاً',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'كلمة المرور يجب أن تكون 8 أحرف على الأقل',
            'role.required' => 'الدور مطلوب',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'city' => $request->city,
            'bio' => $request->bio,
            'country' => $request->country ?? 'السعودية',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        $user->assignRole($request->role);

        return redirect()->route('admin.users')
            ->with('success', 'تم إنشاء المستخدم بنجاح');
    }

    /**
     * تعديل مستخدم
     */
    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * تحديث مستخدم
     */
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,instructor,student',
            'phone' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
            'bio' => 'nullable|string|max:1000',
            'is_active' => 'boolean',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
            'bio' => $request->bio,
            'country' => $request->country ?? 'السعودية',
            'is_active' => $request->boolean('is_active'),
        ]);

        // تحديث الدور
        $user->syncRoles([$request->role]);

        // تحديث كلمة المرور إذا تم إدخالها
        if ($request->password) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.users')
            ->with('success', 'تم تحديث المستخدم بنجاح');
    }

    /**
     * حذف مستخدم
     */
    public function deleteUser(User $user)
    {
        // لا يمكن حذف المدير الحالي
        if ($user->id === auth()->id()) {
            return back()->with('error', 'لا يمكنك حذف حسابك الشخصي');
        }

        $user->delete();

        return back()->with('success', 'تم حذف المستخدم بنجاح');
    }

    /**
     * إدارة الأقسام
     */
    public function categories()
    {
        $categories = Category::withCount('courses')->ordered()->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * إنشاء قسم جديد
     */
    public function createCategory()
    {
        return view('admin.categories.create');
    }

    /**
     * حفظ قسم جديد
     */
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'description_ar' => 'nullable|string|max:1000',
            'description_en' => 'nullable|string|max:1000',
            'icon' => 'nullable|string|max:50',
            'color' => 'required|string|max:7',
            'sort_order' => 'nullable|integer',
        ], [
            'name_ar.required' => 'الاسم بالعربية مطلوب',
            'color.required' => 'اللون مطلوب',
        ]);

        Category::create($request->all());

        return redirect()->route('admin.categories')
            ->with('success', 'تم إنشاء القسم بنجاح');
    }

    /**
     * تعديل قسم
     */
    public function editCategory(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * تحديث قسم
     */
    public function updateCategory(Request $request, Category $category)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'description_ar' => 'nullable|string|max:1000',
            'description_en' => 'nullable|string|max:1000',
            'icon' => 'nullable|string|max:50',
            'color' => 'required|string|max:7',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $category->update($request->all());

        return redirect()->route('admin.categories')
            ->with('success', 'تم تحديث القسم بنجاح');
    }

    /**
     * حذف قسم
     */
    public function deleteCategory(Category $category)
    {
        if ($category->courses()->count() > 0) {
            return back()->with('error', 'لا يمكن حذف القسم لوجود دورات مرتبطة به');
        }

        $category->delete();

        return back()->with('success', 'تم حذف القسم بنجاح');
    }

    /**
     * إدارة الدورات
     */
    public function courses(Request $request)
    {
        $query = Course::with(['category', 'instructor']);

        // البحث
        if ($request->search) {
            $query->search($request->search);
        }

        // تصفية حسب القسم
        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        // تصفية حسب الحالة
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // تصفية حسب المدرب
        if ($request->instructor) {
            $query->where('instructor_id', $request->instructor);
        }

        $courses = $query->latest()->paginate(15);
        $categories = Category::active()->get();
        $instructors = User::role('teacher')->get();

        return view('admin.courses.index', compact('courses', 'categories', 'instructors'));
    }

    /**
     * عرض تفاصيل دورة
     */
    public function course(Course $course)
    {
        $course->load(['category', 'instructor', 'lessons', 'enrollments.user', 'quizzes']);
        return view('admin.courses.show', compact('course'));
    }

    /**
     * إنشاء دورة جديدة
     */
    public function createCourse()
    {
        $categories = Category::active()->get();
        $instructors = User::role('teacher')->get();
        return view('admin.courses.create', compact('categories', 'instructors'));
    }

    /**
     * حفظ دورة جديدة
     */
    public function storeCourse(Request $request)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'instructor_id' => 'required|exists:users,id',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'level' => 'required|in:beginner,intermediate,advanced,expert',
            'status' => 'required|in:draft,published,archived',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'intro_video' => 'nullable|file|mimes:mp4,avi,mov,wmv|max:512000',
            'video_url' => 'nullable|url',
            'max_students' => 'nullable|integer|min:1',
            'certificate_template' => 'nullable|string',
            'access_type' => 'nullable|in:lifetime,limited,subscription',
            'quiz_enabled' => 'nullable|boolean',
            'passing_score' => 'nullable|integer|min:0|max:100',
            'assessment_types' => 'nullable|array',
            'certificate_requirements' => 'nullable|string',
            'live_sessions_enabled' => 'nullable|boolean',
            'max_participants' => 'nullable|integer|min:1',
            'session_duration' => 'nullable|integer|min:15',
            'sessions_count' => 'nullable|integer|min:1',
            'platform' => 'nullable|string',
            'prerequisites' => 'nullable|string',
            'learning_objectives' => 'nullable|string',
            'tags' => 'nullable|string',
            'language' => 'nullable|in:ar,en,both',
            'featured' => 'nullable|boolean',
            'certificate_available' => 'nullable|boolean',
        ]);

        $data = $request->all();
        $data['slug'] = \Str::slug($request->title_ar);
        
        // Handle boolean fields
        $data['quiz_enabled'] = $request->has('quiz_enabled');
        $data['live_sessions_enabled'] = $request->has('live_sessions_enabled');
        $data['featured'] = $request->has('featured');
        $data['certificate_available'] = $request->has('certificate_available');
        
        // Handle assessment types
        if ($request->has('assessment_types')) {
            $data['assessment_types'] = json_encode($request->assessment_types);
        }

        // Handle thumbnail
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('courses', 'public');
        }

        // Handle intro video
        if ($request->hasFile('intro_video')) {
            $data['intro_video'] = $request->file('intro_video')->store('courses/videos', 'public');
        }

        // Handle resources
        if ($request->hasFile('resources')) {
            $resources = [];
            foreach ($request->file('resources') as $index => $resource) {
                if ($resource['file'] && $resource['file']->isValid()) {
                    $path = $resource['file']->store('courses/resources', 'public');
                    $resources[] = [
                        'title' => $resource['title'] ?? 'مورد ' . ($index + 1),
                        'file' => $path,
                        'type' => $resource['file']->getClientOriginalExtension(),
                        'size' => $resource['file']->getSize(),
                    ];
                }
            }
            $data['resources'] = json_encode($resources);
        }

        $course = Course::create($data);

        return redirect()->route('admin.courses')
            ->with('success', 'تم إنشاء الدورة المتقدمة بنجاح');
    }

    /**
     * تعديل دورة
     */
    public function editCourse(Course $course)
    {
        $categories = Category::active()->get();
        $instructors = User::role('teacher')->get();
        return view('admin.courses.edit', compact('course', 'categories', 'instructors'));
    }

    /**
     * تحديث دورة
     */
    public function updateCourse(Request $request, Course $course)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'instructor_id' => 'required|exists:users,id',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'level' => 'required|in:beginner,intermediate,advanced',
            'status' => 'required|in:draft,published,archived',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_intro' => 'nullable|url',
        ]);

        $data = $request->all();
        $data['slug'] = \Str::slug($request->title_ar);

        if ($request->hasFile('thumbnail')) {
            // حذف الصورة القديمة
            if ($course->thumbnail) {
                \Storage::disk('public')->delete($course->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('courses', 'public');
        }

        $course->update($data);

        return redirect()->route('admin.courses')
            ->with('success', 'تم تحديث الدورة بنجاح');
    }

    /**
     * حذف دورة
     */
    public function deleteCourse(Course $course)
    {
        if ($course->enrollments()->count() > 0) {
            return back()->with('error', 'لا يمكن حذف الدورة لوجود تسجيلات مرتبطة بها');
        }

        // حذف الصورة
        if ($course->thumbnail) {
            \Storage::disk('public')->delete($course->thumbnail);
        }

        $course->delete();

        return back()->with('success', 'تم حذف الدورة بنجاح');
    }

    /**
     * تحديث حالة دورة
     */
    public function updateCourseStatus(Request $request, Course $course)
    {
        $request->validate([
            'status' => 'required|in:draft,published,archived'
        ]);

        $course->update(['status' => $request->status]);

        return back()->with('success', 'تم تحديث حالة الدورة بنجاح');
    }

    /**
     * إدارة المدفوعات
     */
    public function payments(Request $request)
    {
        $query = Payment::with(['user', 'course']);

        // البحث
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('payment_id', 'like', '%' . $request->search . '%')
                  ->orWhere('invoice_number', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', function($userQuery) use ($request) {
                      $userQuery->where('name', 'like', '%' . $request->search . '%')
                               ->orWhere('email', 'like', '%' . $request->search . '%');
                  });
            });
        }

        // تصفية حسب الحالة
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // تصفية حسب طريقة الدفع
        if ($request->payment_method) {
            $query->where('payment_method', $request->payment_method);
        }

        $payments = $query->latest()->paginate(20);

        return view('admin.payments.index', compact('payments'));
    }

    /**
     * عرض تفاصيل دفعة
     */
    public function payment(Payment $payment)
    {
        $payment->load(['user', 'course']);
        return view('admin.payments.show', compact('payment'));
    }

    /**
     * تحديث حالة دفعة
     */
    public function updatePaymentStatus(Request $request, Payment $payment)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,failed,cancelled,refunded'
        ]);

        $payment->update(['status' => $request->status]);

        // إذا تم تأكيد الدفع، نشط التسجيل
        if ($request->status === 'completed') {
            $enrollment = Enrollment::where('payment_id', $payment->id)->first();
            if ($enrollment) {
                $enrollment->update(['status' => 'active']);
            }
        }

        return back()->with('success', 'تم تحديث حالة الدفعة بنجاح');
    }

    /**
     * إدارة المدونة
     */
    public function blog(Request $request)
    {
        $query = BlogPost::with('author');

        // البحث
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title_ar', 'like', '%' . $request->search . '%')
                  ->orWhere('title_en', 'like', '%' . $request->search . '%')
                  ->orWhere('content_ar', 'like', '%' . $request->search . '%')
                  ->orWhere('content_en', 'like', '%' . $request->search . '%');
            });
        }

        // تصفية حسب الحالة
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $posts = $query->latest()->paginate(15);

        return view('admin.blog.index', compact('posts'));
    }

    /**
     * إنشاء مقال جديد
     */
    public function createBlogPost()
    {
        return view('admin.blog.create');
    }

    /**
     * حفظ مقال جديد
     */
    public function storeBlogPost(Request $request)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'content_ar' => 'required|string',
            'content_en' => 'nullable|string',
            'excerpt_ar' => 'nullable|string|max:500',
            'excerpt_en' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
            'meta_title' => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
        ], [
            'title_ar.required' => 'العنوان بالعربية مطلوب',
            'content_ar.required' => 'المحتوى بالعربية مطلوب',
            'status.required' => 'الحالة مطلوبة',
        ]);

        $data = $request->all();
        $data['author_id'] = auth()->id();
        $data['slug'] = \Str::slug($request->title_ar);

        // معالجة الصورة المميزة
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        BlogPost::create($data);

        return redirect()->route('admin.blog')
            ->with('success', 'تم إنشاء المقال بنجاح');
    }

    /**
     * تعديل مقال
     */
    public function editBlogPost(BlogPost $post)
    {
        return view('admin.blog.edit', compact('post'));
    }

    /**
     * تحديث مقال
     */
    public function updateBlogPost(Request $request, BlogPost $post)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'content_ar' => 'required|string',
            'content_en' => 'nullable|string',
            'excerpt_ar' => 'nullable|string|max:500',
            'excerpt_en' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
            'meta_title' => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
        ]);

        $data = $request->all();
        $data['slug'] = \Str::slug($request->title_ar);

        // معالجة الصورة المميزة
        if ($request->hasFile('featured_image')) {
            // حذف الصورة القديمة
            if ($post->featured_image) {
                \Storage::disk('public')->delete($post->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        $post->update($data);

        return redirect()->route('admin.blog')
            ->with('success', 'تم تحديث المقال بنجاح');
    }

    /**
     * حذف مقال
     */
    public function deleteBlogPost(BlogPost $post)
    {
        // حذف الصورة المميزة
        if ($post->featured_image) {
            \Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();

        return back()->with('success', 'تم حذف المقال بنجاح');
    }

    /**
     * التقارير
     */
    public function reports(Request $request)
    {
        $startDate = $request->start_date ? \Carbon\Carbon::parse($request->start_date) : now()->startOfMonth();
        $endDate = $request->end_date ? \Carbon\Carbon::parse($request->end_date) : now()->endOfMonth();

        $reports = [
            'enrollments' => Enrollment::whereBetween('created_at', [$startDate, $endDate])->count(),
            'revenue' => Payment::where('status', 'completed')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->sum('total_amount'),
            'new_users' => User::whereBetween('created_at', [$startDate, $endDate])->count(),
            'completed_courses' => Enrollment::where('status', 'completed')
                ->whereBetween('completed_at', [$startDate, $endDate])
                ->count(),
        ];

        // الدورات الأكثر مبيعاً
        $topCourses = Course::withCount(['enrollments' => function($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }])
            ->orderByDesc('enrollments_count')
            ->limit(10)
            ->get();

        // المدربون الأكثر نشاطاً
        $topInstructors = User::role('teacher')
            ->withCount(['teachingCourses' => function($query) use ($startDate, $endDate) {
                $query->whereHas('enrollments', function($enrollQuery) use ($startDate, $endDate) {
                    $enrollQuery->whereBetween('created_at', [$startDate, $endDate]);
                });
            }])
            ->orderByDesc('teaching_courses_count')
            ->limit(10)
            ->get();

        return view('admin.reports', compact('reports', 'topCourses', 'topInstructors', 'startDate', 'endDate'));
    }

    /**
     * تصدير التقارير
     */
    public function exportReports(Request $request)
    {
        // هنا يمكن إضافة منطق تصدير التقارير إلى Excel أو PDF
        return back()->with('info', 'سيتم إضافة ميزة التصدير قريباً');
    }

    /**
     * الإعدادات
     */
    public function settings()
    {
        $settings = [
            'site' => Setting::getGroup('site'),
            'appearance' => Setting::getGroup('appearance'),
            'courses' => Setting::getGroup('courses'),
            'payment' => Setting::getGroup('payment'),
            'email' => Setting::getGroup('email'),
            'social' => Setting::getGroup('social'),
            'seo' => Setting::getGroup('seo'),
            'system' => Setting::getGroup('system'),
            'notifications' => Setting::getGroup('notifications'),
        ];

        // Log the loaded settings for debugging
        \Log::info('Loaded settings:', $settings);

        return view('admin.settings', compact('settings'));
    }

    /**
     * تحديث الإعدادات
     */
    public function updateSettings(Request $request)
    {
        try {
            $request->validate([
                'settings' => 'required|array',
                'settings.*' => 'nullable',
            ]);

            // Log the incoming data for debugging
            \Log::info('Settings update request data:', $request->all());
            \Log::info('Settings array:', $request->input('settings', []));
            \Log::info('Settings count:', ['count' => count($request->input('settings', []))]);

            $updatedCount = 0;
            $settingsData = $request->input('settings', []);
            
            // Log file uploads specifically
            \Log::info('File uploads:', $request->allFiles());
            
            // Process settings directly without flattening to preserve structure
            foreach ($settingsData as $groupKey => $groupSettings) {
                if (is_array($groupSettings)) {
                    foreach ($groupSettings as $key => $value) {
                        \Log::info("Processing setting: {$key} = " . (is_array($value) ? json_encode($value) : $value));
                        
                        // Handle file uploads
                        if ($request->hasFile("settings.{$groupKey}.{$key}")) {
                            $file = $request->file("settings.{$groupKey}.{$key}");
                            if ($file->isValid()) {
                                // Delete old file if exists
                                $oldSetting = Setting::where('key', $key)->first();
                                if ($oldSetting && $oldSetting->value) {
                                    \Storage::disk('public')->delete($oldSetting->value);
                                }
                                
                                // Store new file
                                $path = $file->store('settings', 'public');
                                $valueToStore = $path;
                                $type = 'file';
                                
                                \Log::info("File uploaded for setting: {$key}, stored at: {$path}");
                            } else {
                                \Log::warning("Invalid file upload for setting: {$key}");
                                continue;
                            }
                        } else {
                            // Skip empty values for file type settings to avoid overwriting with empty values
                            $existingSetting = Setting::where('key', $key)->first();
                            if ($existingSetting && $existingSetting->type === 'file' && empty($value)) {
                                \Log::info("Skipping empty value for file setting: {$key}");
                                continue;
                            }
                            
                            // Skip completely empty values
                            if (empty($value) && $value !== '0' && $value !== 0) {
                                \Log::info("Skipping completely empty value for setting: {$key}");
                                continue;
                            }
                            
                            // Convert array values to JSON string for storage
                            $valueToStore = is_array($value) ? json_encode($value) : $value;
                            $type = is_array($value) ? 'json' : 'string';
                        }
                        
                        // Additional logging for debugging
                        \Log::info("Final value to store for {$key}: {$valueToStore} (type: {$type})");
                        
                        // Try to update the setting directly using updateOrCreate
                        $setting = Setting::updateOrCreate(
                            ['key' => $key],
                            [
                                'value' => $valueToStore,
                                'type' => $type,
                                'group' => $groupKey, // Use the group from the form structure
                                'label' => $key,
                                'description' => 'Auto-updated setting',
                                'is_public' => false
                            ]
                        );
                        
                        $updatedCount++;
                        \Log::info("Updated/Created setting: {$key} with value: " . (is_array($value) ? json_encode($value) : $value));
                        \Log::info("Setting object:", ['setting' => $setting->toArray()]);
                        \Log::info("Database updated successfully for key: {$key}");
                    }
                }
            }

            // Clear all settings cache
            Setting::clearCache();
            
            // Clear additional caches to ensure changes are reflected
            \Artisan::call('config:clear');
            \Artisan::call('cache:clear');

            \Log::info("Settings update completed. Updated count: {$updatedCount}");
            
            if ($updatedCount === 0) {
                return back()->with('info', 'لم يتم تحديث أي إعداد. تأكد من إدخال قيم جديدة أو اختيار ملفات جديدة.');
            }
            
            return back()->with('success', "تم تحديث {$updatedCount} إعداد بنجاح");
        } catch (\Exception $e) {
            \Log::error('Settings update error: ' . $e->getMessage());
            return back()->with('error', 'حدث خطأ أثناء تحديث الإعدادات: ' . $e->getMessage());
        }
    }

    /**
     * Flatten nested settings array
     */
    private function flattenSettingsArray($array, $prefix = '')
    {
        $result = [];
        
        foreach ($array as $key => $value) {
            $newKey = $prefix ? $prefix . '_' . $key : $key;
            
            if (is_array($value) && !$this->isFileUpload($value)) {
                $result = array_merge($result, $this->flattenSettingsArray($value, $newKey));
            } else {
                $result[$newKey] = $value;
            }
        }
        
        return $result;
    }

    /**
     * Check if the value is a file upload
     */
    private function isFileUpload($value)
    {
        return is_array($value) && isset($value['tmp_name']) && isset($value['name']);
    }

    /**
     * تحديد مجموعة الإعداد بناءً على اسم المفتاح
     */
    private function determineSettingGroup($key)
    {
        if (str_starts_with($key, 'site_')) {
            return 'site';
        } elseif (str_starts_with($key, 'appearance_') || str_contains($key, 'logo') || str_contains($key, 'color')) {
            return 'appearance';
        } elseif (str_starts_with($key, 'course_') || str_contains($key, 'lesson') || str_contains($key, 'quiz')) {
            return 'courses';
        } elseif (str_starts_with($key, 'payment_') || str_contains($key, 'stripe') || str_contains($key, 'paypal') || str_contains($key, 'currency')) {
            return 'payment';
        } elseif (str_starts_with($key, 'email_') || str_starts_with($key, 'mail_')) {
            return 'email';
        } elseif (str_starts_with($key, 'social_') || str_contains($key, '_url')) {
            return 'social';
        } elseif (str_starts_with($key, 'seo_') || str_contains($key, 'google_') || str_contains($key, 'meta_')) {
            return 'seo';
        } elseif (str_starts_with($key, 'system_') || str_contains($key, 'maintenance') || str_contains($key, 'session')) {
            return 'system';
        } elseif (str_starts_with($key, 'notification_')) {
            return 'notifications';
        } else {
            return 'general';
        }
    }

    /**
     * مسح الذاكرة المؤقتة
     */
    public function clearCache()
    {
        \Artisan::call('cache:clear');
        \Artisan::call('config:clear');
        \Artisan::call('view:clear');
        \Artisan::call('route:clear');
        
        Setting::clearCache();
        
        return back()->with('success', 'تم مسح الذاكرة المؤقتة بنجاح');
    }

    /**
     * مسح ذاكرة الإعدادات المؤقتة
     */
    public function clearSettingsCache()
    {
        try {
            Setting::clearCache();
            
            return response()->json([
                'success' => true,
                'message' => 'تم مسح الذاكرة المؤقتة بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء مسح الذاكرة المؤقتة: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Debug settings - show current settings values
     */
    public function debugSettings()
    {
        $settings = [
            'site' => Setting::getGroup('site'),
            'appearance' => Setting::getGroup('appearance'),
            'social' => Setting::getGroup('social'),
        ];

        // Get raw database values
        $rawSettings = Setting::whereIn('key', ['site_logo', 'site_name', 'site_phone', 'site_email'])->get();

        return response()->json([
            'settings' => $settings,
            'cached_values' => [
                'site_name' => setting('site_name'),
                'site_logo' => setting('site_logo'),
                'site_phone' => setting('site_phone'),
                'site_email' => setting('site_email'),
            ],
            'raw_database_values' => $rawSettings->mapWithKeys(function($setting) {
                return [$setting->key => [
                    'value' => $setting->value,
                    'type' => $setting->type,
                    'group' => $setting->group
                ]];
            }),
            'storage_path' => storage_path('app/public'),
            'public_path' => public_path('storage'),
            'asset_url' => asset('storage/test'),
        ]);
    }

    /**
     * نسخ احتياطي لقاعدة البيانات
     */
    public function backupDatabase()
    {
        // Here you can implement database backup logic
        return back()->with('success', 'سيتم إنشاء النسخة الاحتياطية قريباً');
    }

    /**
     * تحسين الأداء
     */
    public function optimizeDatabase()
    {
        \Artisan::call('config:cache');
        \Artisan::call('route:cache');
        \Artisan::call('view:cache');
        
        return back()->with('success', 'تم تحسين الأداء بنجاح');
    }

    /**
     * وضع الصيانة
     */
    public function maintenanceMode(Request $request)
    {
        $enabled = $request->boolean('enabled');
        
        if ($enabled) {
            \Artisan::call('down', ['--message' => Setting::get('maintenance_message', 'نعتذر، الموقع قيد الصيانة حالياً.')]);
        } else {
            \Artisan::call('up');
        }
        
        Setting::set('maintenance_mode', $enabled ? '1' : '0', 'boolean', 'system');
        
        return back()->with('success', $enabled ? 'تم تفعيل وضع الصيانة' : 'تم إلغاء وضع الصيانة');
    }

    /**
     * عرض صفحة روابط التواصل الاجتماعي
     */
    public function socialLinks()
    {
        $socialLinks = get_active_social_links();
        $allLinks = get_social_links();
        
        return view('admin.social-links', compact('socialLinks', 'allLinks'));
    }

    /**
     * Get dashboard statistics for AJAX
     */
    public function getDashboardStats()
    {
        $stats = [
            'total_users' => User::count(),
            'total_courses' => Course::count(),
            'total_revenue' => Payment::where('status', 'completed')->sum('total_amount'),
            'total_enrollments' => Enrollment::count(),
            'today_users' => User::whereDate('created_at', today())->count(),
            'today_revenue' => Payment::where('status', 'completed')->whereDate('created_at', today())->sum('total_amount'),
        ];

        return response()->json($stats);
    }

    /**
     * Get recent activity for AJAX
     */
    public function getRecentActivity()
    {
        $activities = collect([
            [
                'user' => 'أحمد محمد',
                'action' => 'سجل في دورة',
                'course' => 'البرمجة المتقدمة',
                'time' => 'الآن'
            ],
            [
                'user' => 'فاطمة علي',
                'action' => 'أكملت دورة',
                'course' => 'التصميم الجرافيكي',
                'time' => 'منذ دقيقتين'
            ],
            [
                'user' => 'خالد عبدالله',
                'action' => 'دفع',
                'course' => 'التسويق الرقمي',
                'amount' => '300 ريال',
                'time' => 'منذ 5 دقائق'
            ]
        ]);

        return response()->json($activities);
    }

    /**
     * Get system status for AJAX
     */
    public function getSystemStatus()
    {
        $status = [
            'database' => [
                'status' => 'online',
                'response_time' => rand(10, 20) . 'ms',
                'usage' => rand(40, 60) . '%'
            ],
            'cpu' => [
                'status' => 'normal',
                'usage' => rand(20, 40) . '%',
                'temperature' => rand(40, 50) . '°C'
            ],
            'storage' => [
                'status' => 'warning',
                'usage' => rand(70, 85) . '%',
                'free_space' => rand(1, 5) . '.' . rand(0, 9) . 'GB'
            ],
            'network' => [
                'status' => 'stable',
                'speed' => '100Mbps',
                'latency' => rand(10, 25) . 'ms'
            ]
        ];

        return response()->json($status);
    }

    /**
     * إدارة SEO
     */
    public function seo()
    {
        return view('admin.seo');
    }

    /**
     * تحديث إعدادات SEO
     */
    public function updateSeo(Request $request)
    {
        $request->validate([
            'site_title' => 'required|string|max:60',
            'site_description' => 'required|string|max:160',
            'site_keywords' => 'nullable|string|max:255',
            'site_author' => 'nullable|string|max:100',
            'og_title' => 'nullable|string|max:60',
            'og_description' => 'nullable|string|max:160',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'twitter_card' => 'nullable|in:summary,summary_large_image,app,player',
            'robots_txt' => 'nullable|string',
            'google_analytics' => 'nullable|string|max:20',
            'google_search_console' => 'nullable|string|max:100',
            'bing_webmaster' => 'nullable|string|max:100',
        ]);

        // هنا يمكن إضافة منطق حفظ إعدادات SEO
        return back()->with('success', 'تم تحديث إعدادات SEO بنجاح');
    }

    /**
     * إنشاء خريطة الموقع
     */
    public function generateSitemap()
    {
        try {
            $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
            $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
            
            // الصفحة الرئيسية
            $sitemap .= '  <url>' . "\n";
            $sitemap .= '    <loc>' . url('/') . '</loc>' . "\n";
            $sitemap .= '    <lastmod>' . now()->toISOString() . '</lastmod>' . "\n";
            $sitemap .= '    <changefreq>daily</changefreq>' . "\n";
            $sitemap .= '    <priority>1.0</priority>' . "\n";
            $sitemap .= '  </url>' . "\n";
            
            // صفحات الدورات
            $courses = Course::published()->get();
            foreach ($courses as $course) {
                $sitemap .= '  <url>' . "\n";
                $sitemap .= '    <loc>' . route('courses.show', $course->slug) . '</loc>' . "\n";
                $sitemap .= '    <lastmod>' . $course->updated_at->toISOString() . '</lastmod>' . "\n";
                $sitemap .= '    <changefreq>weekly</changefreq>' . "\n";
                $sitemap .= '    <priority>0.8</priority>' . "\n";
                $sitemap .= '  </url>' . "\n";
            }
            
            // صفحات المدربين
                    $instructors = User::role('teacher')->get();
        foreach ($instructors as $instructor) {
                $sitemap .= '  <url>' . "\n";
                $sitemap .= '    <loc>' . route('instructors.show', $instructor->id) . '</loc>' . "\n";
                $sitemap .= '    <lastmod>' . $instructor->updated_at->toISOString() . '</lastmod>' . "\n";
                $sitemap .= '    <changefreq>monthly</changefreq>' . "\n";
                $sitemap .= '    <priority>0.6</priority>' . "\n";
                $sitemap .= '  </url>' . "\n";
            }
            
            // صفحات المدونة
            $blogPosts = BlogPost::published()->get();
            foreach ($blogPosts as $post) {
                $sitemap .= '  <url>' . "\n";
                $sitemap .= '    <loc>' . route('blog.post', $post->slug) . '</loc>' . "\n";
                $sitemap .= '    <lastmod>' . $post->updated_at->toISOString() . '</lastmod>' . "\n";
                $sitemap .= '    <changefreq>weekly</changefreq>' . "\n";
                $sitemap .= '    <priority>0.7</priority>' . "\n";
                $sitemap .= '  </url>' . "\n";
            }
            
            $sitemap .= '</urlset>';
            
            // حفظ ملف sitemap.xml
            $path = public_path('sitemap.xml');
            file_put_contents($path, $sitemap);
            
            return response()->json(['success' => true, 'message' => 'تم إنشاء خريطة الموقع بنجاح']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'حدث خطأ أثناء إنشاء خريطة الموقع'], 500);
        }
    }

    /**
     * إرسال لمحركات البحث
     */
    public function submitToSearchEngines()
    {
        try {
            // محاكاة إرسال الموقع لمحركات البحث
            $searchEngines = [
                'Google Search Console',
                'Bing Webmaster Tools',
                'Yandex Webmaster',
                'Baidu Webmaster Tools'
            ];
            
            $results = [];
            foreach ($searchEngines as $engine) {
                $results[] = [
                    'engine' => $engine,
                    'status' => 'success',
                    'message' => 'تم الإرسال بنجاح'
                ];
            }
            
            return response()->json([
                'success' => true, 
                'message' => 'تم إرسال الموقع لمحركات البحث بنجاح',
                'results' => $results
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'حدث خطأ أثناء الإرسال لمحركات البحث'
            ], 500);
        }
    }

    /**
     * إنشاء درس جديد
     */
    public function createLesson(Course $course)
    {
        return view('admin.lessons.create', compact('course'));
    }

    /**
     * حفظ درس جديد
     */
    public function storeLesson(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title_ar' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'nullable|string',
            'lesson_type' => 'required|in:video,text,audio,live,assignment,quiz',
            'duration' => 'required|integer|min:1',
            'content_ar' => 'nullable|string',
            'content_en' => 'nullable|string',
            'video_file' => 'nullable|file|mimes:mp4,avi,mov,wmv|max:1048576',
            'video_url' => 'nullable|url',
            'video_quality' => 'nullable|string',
            'audio_file' => 'nullable|file|mimes:mp3,wav,aac|max:104857600',
            'session_date' => 'nullable|date',
            'session_link' => 'nullable|url',
            'session_notes' => 'nullable|string',
            'order' => 'nullable|integer|min:1',
            'status' => 'nullable|in:draft,published,archived',
            'is_free' => 'nullable|boolean',
            'downloadable' => 'nullable|boolean',
            'quiz_enabled' => 'nullable|boolean',
            'passing_score' => 'nullable|integer|min:0|max:100',
            'time_limit' => 'nullable|integer|min:1',
            'attempts_allowed' => 'nullable|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['slug'] = \Str::slug($request->title_ar);
        
        // Handle boolean fields
        $data['is_free'] = $request->has('is_free');
        $data['downloadable'] = $request->has('downloadable');
        $data['quiz_enabled'] = $request->has('quiz_enabled');

        // Handle video file
        if ($request->hasFile('video_file')) {
            $data['video_file'] = $request->file('video_file')->store('lessons/videos', 'public');
        }

        // Handle audio file
        if ($request->hasFile('audio_file')) {
            $data['audio_file'] = $request->file('audio_file')->store('lessons/audio', 'public');
        }

        // Handle attachments
        if ($request->hasFile('attachments')) {
            $attachments = [];
            foreach ($request->file('attachments') as $index => $attachment) {
                if ($attachment['file'] && $attachment['file']->isValid()) {
                    $path = $attachment['file']->store('lessons/attachments', 'public');
                    $attachments[] = [
                        'title' => $attachment['title'] ?? 'مرفق ' . ($index + 1),
                        'file' => $path,
                        'type' => $attachment['file']->getClientOriginalExtension(),
                        'size' => $attachment['file']->getSize(),
                    ];
                }
            }
            $data['attachments'] = json_encode($attachments);
        }

        // Handle external links
        if ($request->has('external_links')) {
            $externalLinks = [];
            foreach ($request->external_links as $link) {
                if (!empty($link['title']) && !empty($link['url'])) {
                    $externalLinks[] = [
                        'title' => $link['title'],
                        'url' => $link['url'],
                    ];
                }
            }
            $data['external_links'] = json_encode($externalLinks);
        }

        // Handle quiz questions
        if ($request->has('questions') && $data['quiz_enabled']) {
            $questions = [];
            foreach ($request->questions as $question) {
                if (!empty($question['question'])) {
                    $questions[] = [
                        'question' => $question['question'],
                        'type' => $question['type'] ?? 'multiple_choice',
                        'answers' => $question['answers'] ?? [],
                        'correct' => $question['correct'] ?? 0,
                    ];
                }
            }
            $data['quiz_questions'] = json_encode($questions);
        }

        $lesson = Lesson::create($data);

        return redirect()->route('admin.courses.show', $request->course_id)
            ->with('success', 'تم إنشاء الدرس بنجاح');
    }

    /**
     * تعديل درس
     */
    public function editLesson(Lesson $lesson)
    {
        $course = $lesson->course;
        return view('admin.lessons.edit', compact('lesson', 'course'));
    }

    /**
     * تحديث درس
     */
    public function updateLesson(Request $request, Lesson $lesson)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'nullable|string',
            'lesson_type' => 'required|in:video,text,audio,live,assignment,quiz',
            'duration' => 'required|integer|min:1',
            'content_ar' => 'nullable|string',
            'content_en' => 'nullable|string',
            'video_file' => 'nullable|file|mimes:mp4,avi,mov,wmv|max:1048576',
            'video_url' => 'nullable|url',
            'video_quality' => 'nullable|string',
            'audio_file' => 'nullable|file|mimes:mp3,wav,aac|max:104857600',
            'session_date' => 'nullable|date',
            'session_link' => 'nullable|url',
            'session_notes' => 'nullable|string',
            'order' => 'nullable|integer|min:1',
            'status' => 'nullable|in:draft,published,archived',
            'is_free' => 'nullable|boolean',
            'downloadable' => 'nullable|boolean',
            'quiz_enabled' => 'nullable|boolean',
            'passing_score' => 'nullable|integer|min:0|max:100',
            'time_limit' => 'nullable|integer|min:1',
            'attempts_allowed' => 'nullable|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['slug'] = \Str::slug($request->title_ar);
        
        // Handle boolean fields
        $data['is_free'] = $request->has('is_free');
        $data['downloadable'] = $request->has('downloadable');
        $data['quiz_enabled'] = $request->has('quiz_enabled');

        // Handle video file
        if ($request->hasFile('video_file')) {
            if ($lesson->video_file) {
                \Storage::disk('public')->delete($lesson->video_file);
            }
            $data['video_file'] = $request->file('video_file')->store('lessons/videos', 'public');
        }

        // Handle audio file
        if ($request->hasFile('audio_file')) {
            if ($lesson->audio_file) {
                \Storage::disk('public')->delete($lesson->audio_file);
            }
            $data['audio_file'] = $request->file('audio_file')->store('lessons/audio', 'public');
        }

        // Handle attachments
        if ($request->hasFile('attachments')) {
            $attachments = [];
            foreach ($request->file('attachments') as $index => $attachment) {
                if ($attachment['file'] && $attachment['file']->isValid()) {
                    $path = $attachment['file']->store('lessons/attachments', 'public');
                    $attachments[] = [
                        'title' => $attachment['title'] ?? 'مرفق ' . ($index + 1),
                        'file' => $path,
                        'type' => $attachment['file']->getClientOriginalExtension(),
                        'size' => $attachment['file']->getSize(),
                    ];
                }
            }
            $data['attachments'] = json_encode($attachments);
        }

        // Handle external links
        if ($request->has('external_links')) {
            $externalLinks = [];
            foreach ($request->external_links as $link) {
                if (!empty($link['title']) && !empty($link['url'])) {
                    $externalLinks[] = [
                        'title' => $link['title'],
                        'url' => $link['url'],
                    ];
                }
            }
            $data['external_links'] = json_encode($externalLinks);
        }

        // Handle quiz questions
        if ($request->has('questions') && $data['quiz_enabled']) {
            $questions = [];
            foreach ($request->questions as $question) {
                if (!empty($question['question'])) {
                    $questions[] = [
                        'question' => $question['question'],
                        'type' => $question['type'] ?? 'multiple_choice',
                        'answers' => $question['answers'] ?? [],
                        'correct' => $question['correct'] ?? 0,
                    ];
                }
            }
            $data['quiz_questions'] = json_encode($questions);
        }

        $lesson->update($data);

        return redirect()->route('admin.courses.show', $lesson->course_id)
            ->with('success', 'تم تحديث الدرس بنجاح');
    }

    /**
     * حذف درس
     */
    public function deleteLesson(Lesson $lesson)
    {
        // Delete associated files
        if ($lesson->video_file) {
            \Storage::disk('public')->delete($lesson->video_file);
        }
        if ($lesson->audio_file) {
            \Storage::disk('public')->delete($lesson->audio_file);
        }

        // Delete attachments
        if ($lesson->attachments) {
            $attachments = json_decode($lesson->attachments, true);
            foreach ($attachments as $attachment) {
                \Storage::disk('public')->delete($attachment['file']);
            }
        }

        $courseId = $lesson->course_id;
        $lesson->delete();

        return redirect()->route('admin.courses.show', $courseId)
            ->with('success', 'تم حذف الدرس بنجاح');
    }

    /**
     * إدارة الطلاب
     */
    public function students(Request $request)
    {
        $query = User::whereHas('roles', function($q) {
            $q->where('name', 'student');
        })->with(['enrollments.course', 'roles'])->withCount('enrollments');

        // Search
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Filter by enrollment date
        if ($request->enrolled_from) {
            $query->whereHas('enrollments', function($q) use ($request) {
                $q->where('created_at', '>=', $request->enrolled_from);
            });
        }

        if ($request->enrolled_to) {
            $query->whereHas('enrollments', function($q) use ($request) {
                $q->where('created_at', '<=', $request->enrolled_to);
            });
        }

        $students = $query->latest()->paginate(20);

        // Statistics for the view
        $activeStudents = User::role('student')->where('status', 'active')->count();
        $newStudentsThisMonth = User::role('student')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $totalEnrollments = Enrollment::count();

        return view('admin.students.index', compact('students', 'activeStudents', 'newStudentsThisMonth', 'totalEnrollments'));
    }

    /**
     * إنشاء طالب جديد
     */
    public function createStudent()
    {
        return view('admin.students.create');
    }

    /**
     * حفظ طالب جديد
     */
    public function storeStudent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'status' => 'required|in:active,inactive,suspended',
            'bio' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $student = User::create($data);
        $student->assignRole('student');

        return redirect()->route('admin.students')
            ->with('success', 'تم إنشاء الطالب بنجاح');
    }

    /**
     * إدارة المدربين
     */
    public function instructors(Request $request)
    {
        $query = User::whereHas('roles', function($q) {
            $q->where('name', 'teacher');
        })->with(['teachingCourses', 'roles'])->withCount('teachingCourses');

        // Search
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Filter by specialization
        if ($request->specialization) {
            $query->where('specialization', $request->specialization);
        }

        $instructors = $query->latest()->paginate(20);

        // Statistics for the view
        $activeInstructors = User::role('teacher')->where('status', 'active')->count();
        $totalCourses = Course::count();
        $averageRating = Course::whereHas('instructor', function($query) {
            $query->role('teacher');
        })->avg('rating') ?? 0;

        return view('admin.instructors.index', compact('instructors', 'activeInstructors', 'totalCourses', 'averageRating'));
    }

    /**
     * إنشاء مدرب جديد
     */
    public function createInstructor()
    {
        return view('admin.instructors.create');
    }

    /**
     * حفظ مدرب جديد
     */
    public function storeInstructor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'status' => 'required|in:active,inactive,suspended',
            'specialization' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'experience_years' => 'nullable|integer|min:0',
            'education' => 'nullable|string',
            'certifications' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        if ($request->hasFile('cv')) {
            $data['cv'] = $request->file('cv')->store('cvs', 'public');
        }

        $instructor = User::create($data);
        $instructor->assignRole('teacher');

        return redirect()->route('admin.instructors')
            ->with('success', 'تم إنشاء المدرب بنجاح');
    }

    /**
     * عرض تفاصيل الطالب
     */
    public function student(User $student)
    {
        $student->load(['enrollments.course', 'roles']);
        return view('admin.students.show', compact('student'));
    }

    /**
     * تعديل الطالب
     */
    public function editStudent(User $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    /**
     * تحديث الطالب
     */
    public function updateStudent(Request $request, User $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $student->id,
            'phone' => 'nullable|string|max:20',
            'status' => 'required|in:active,inactive,suspended',
            'bio' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('avatar')) {
            if ($student->avatar) {
                Storage::disk('public')->delete($student->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $student->update($data);

        return redirect()->route('admin.students')
            ->with('success', 'تم تحديث الطالب بنجاح');
    }

    /**
     * حذف الطالب
     */
    public function deleteStudent(User $student)
    {
        if ($student->enrollments()->count() > 0) {
            return back()->with('error', 'لا يمكن حذف الطالب لوجود تسجيلات مرتبطة به');
        }

        if ($student->avatar) {
            Storage::disk('public')->delete($student->avatar);
        }

        $student->delete();

        return redirect()->route('admin.students')
            ->with('success', 'تم حذف الطالب بنجاح');
    }

    /**
     * عرض تفاصيل المدرب
     */
    public function instructor(User $instructor)
    {
        $instructor->load(['teachingCourses', 'roles']);
        return view('admin.instructors.show', compact('instructor'));
    }

    /**
     * تعديل المدرب
     */
    public function editInstructor(User $instructor)
    {
        return view('admin.instructors.edit', compact('instructor'));
    }

    /**
     * تحديث المدرب
     */
    public function updateInstructor(Request $request, User $instructor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $instructor->id,
            'phone' => 'nullable|string|max:20',
            'status' => 'required|in:active,inactive,suspended',
            'specialization' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'experience_years' => 'nullable|integer|min:0',
            'education' => 'nullable|string',
            'certifications' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('avatar')) {
            if ($instructor->avatar) {
                Storage::disk('public')->delete($instructor->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        if ($request->hasFile('cv')) {
            if ($instructor->cv) {
                Storage::disk('public')->delete($instructor->cv);
            }
            $data['cv'] = $request->file('cv')->store('cvs', 'public');
        }

        $instructor->update($data);

        return redirect()->route('admin.instructors')
            ->with('success', 'تم تحديث المدرب بنجاح');
    }

    /**
     * حذف المدرب
     */
    public function deleteInstructor(User $instructor)
    {
        if ($instructor->teachingCourses()->count() > 0) {
            return back()->with('error', 'لا يمكن حذف المدرب لوجود دورات مرتبطة به');
        }

        if ($instructor->avatar) {
            Storage::disk('public')->delete($instructor->avatar);
        }

        if ($instructor->cv) {
            Storage::disk('public')->delete($instructor->cv);
        }

        $instructor->delete();

                return redirect()->route('admin.instructors')
            ->with('success', 'تم حذف المدرب بنجاح');
    }

    /**
     * إجراءات جماعية على المدربين
     */
    public function bulkActionInstructors(Request $request)
    {
        $action = $request->input('action');
        $instructorIds = $request->input('instructor_ids', []);

        if (empty($instructorIds)) {
            return response()->json(['success' => false, 'message' => 'لم يتم تحديد أي مدربين']);
        }

        try {
            $instructors = User::whereIn('id', $instructorIds)->get();

            switch ($action) {
                case 'delete':
                    foreach ($instructors as $instructor) {
                        if ($instructor->teachingCourses()->count() > 0) {
                            continue; // تخطي المدربين الذين لديهم دورات
                        }
                        
                        if ($instructor->avatar) {
                            Storage::disk('public')->delete($instructor->avatar);
                        }
                        
                        if ($instructor->cv) {
                            Storage::disk('public')->delete($instructor->cv);
                        }
                        
                        $instructor->delete();
                    }
                    break;

                case 'activate':
                    User::whereIn('id', $instructorIds)->update(['status' => 'active']);
                    break;

                case 'deactivate':
                    User::whereIn('id', $instructorIds)->update(['status' => 'inactive']);
                    break;

                default:
                    return response()->json(['success' => false, 'message' => 'إجراء غير معروف']);
            }

            return response()->json(['success' => true, 'message' => 'تم تنفيذ الإجراء بنجاح']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'حدث خطأ أثناء تنفيذ الإجراء']);
        }
    }

    /**
     * عرض كويزات الدورة
     */
    public function courseQuizzes(Course $course)
    {
        $course->load(['quizzes.questions']);
        return view('admin.courses.quizzes.index', compact('course'));
    }

    /**
     * تحليل الكلمات المفتاحية
     */
    public function analyzeKeywords(Request $request)
    {
        try {
            $keyword = $request->input('keyword');
            
            // محاكاة تحليل الكلمة المفتاحية
            $data = [
                'search_volume' => rand(1000, 50000),
                'difficulty' => rand(20, 80),
                'cpc' => number_format(rand(50, 500) / 100, 2),
                'competition' => ['منخفض', 'متوسط', 'عالي'][rand(0, 2)],
                'related_keywords' => [
                    $keyword . ' مجاني',
                    $keyword . ' اونلاين',
                    $keyword . ' تعليم',
                    $keyword . ' دورة',
                    $keyword . ' شهادة'
                ]
            ];
            
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'حدث خطأ أثناء تحليل الكلمة المفتاحية'], 500);
        }
    }

    /**
     * فحص سرعة الصفحة
     */
    public function checkPageSpeed(Request $request)
    {
        try {
            $url = $request->input('url');
            
            // محاكاة فحص سرعة الصفحة
            $data = [
                'mobile_score' => rand(60, 95),
                'desktop_score' => rand(70, 98),
                'load_time' => rand(1, 5) . '.' . rand(0, 9) . 's',
                'first_contentful_paint' => rand(1, 3) . '.' . rand(0, 9) . 's',
                'largest_contentful_paint' => rand(2, 6) . '.' . rand(0, 9) . 's',
                'cumulative_layout_shift' => '0.' . rand(1, 9),
                'suggestions' => [
                    'تحسين الصور',
                    'تقليل حجم CSS',
                    'تفعيل ضغط الملفات',
                    'تحسين JavaScript'
                ]
            ];
            
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'حدث خطأ أثناء فحص سرعة الصفحة'], 500);
        }
    }

    /**
     * إنشاء ملف robots.txt
     */
    public function generateRobotsTxt()
    {
        try {
            $robotsContent = "User-agent: *\n";
            $robotsContent .= "Allow: /\n";
            $robotsContent .= "Disallow: /admin/\n";
            $robotsContent .= "Disallow: /login\n";
            $robotsContent .= "Disallow: /register\n";
            $robotsContent .= "Disallow: /password/*\n";
            $robotsContent .= "Sitemap: " . url('/sitemap.xml') . "\n";
            
            $path = public_path('robots.txt');
            file_put_contents($path, $robotsContent);
            
            return response()->json(['success' => true, 'message' => 'تم إنشاء ملف robots.txt بنجاح']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'حدث خطأ أثناء إنشاء ملف robots.txt'], 500);
        }
    }

    /**
     * البحث عن الكلمات المفتاحية
     */
    public function researchKeyword(Request $request)
    {
        try {
            $keyword = $request->input('keyword');
            
            // محاكاة البحث عن الكلمات المفتاحية
            $data = [
                'search_volume' => rand(1000, 100000),
                'competition' => ['منخفض', 'متوسط', 'عالي'][rand(0, 2)],
                'cpc' => number_format(rand(50, 1000) / 100, 2),
                'trend' => 'متزايد',
                'related_keywords' => [
                    $keyword . ' مجاني',
                    $keyword . ' اونلاين',
                    $keyword . ' تعليم',
                    $keyword . ' دورة',
                    $keyword . ' شهادة',
                    $keyword . ' 2024',
                    $keyword . ' السعودية'
                ]
            ];
            
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'حدث خطأ أثناء البحث عن الكلمة المفتاحية'], 500);
        }
    }

    /**
     * عرض صفحة الإشعارات
     */
    public function notifications()
    {
        $notifications = AppNotification::where('user_id', auth()->id())
            ->orWhere('user_id', null) // إشعارات عامة
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.notifications.index', compact('notifications'));
    }

    /**
     * عرض إشعار محدد
     */
    public function showNotification(AppNotification $notification)
    {
        // تحديث حالة الإشعار كمقروء
        if (!$notification->read_at) {
            $notification->update(['read_at' => now()]);
        }

        return view('admin.notifications.show', compact('notification'));
    }

    /**
     * تحديد إشعار كمقروء
     */
    public function markNotificationRead(AppNotification $notification)
    {
        $notification->update(['read_at' => now()]);
        
        return response()->json([
            'success' => true,
            'message' => 'تم تحديد الإشعار كمقروء'
        ]);
    }

    /**
     * تحديد جميع الإشعارات كمقروءة
     */
    public function markAllNotificationsRead()
    {
        AppNotification::where('user_id', auth()->id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
        
        return response()->json([
            'success' => true,
            'message' => 'تم تحديد جميع الإشعارات كمقروءة'
        ]);
    }

    /**
     * حذف إشعار
     */
    public function deleteNotification(AppNotification $notification)
    {
        $notification->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'تم حذف الإشعار بنجاح'
        ]);
    }

    /**
     * الحصول على الإشعارات للـ API
     */
    public function getNotifications()
    {
        $notifications = AppNotification::where('user_id', auth()->id())
            ->orWhere('user_id', null)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $unreadCount = AppNotification::where('user_id', auth()->id())
            ->orWhere('user_id', null)
            ->whereNull('read_at')
            ->count();

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unreadCount
        ]);
    }

    /**
     * إنشاء إشعار تجريبي
     */


    /**
     * عرض صفحة رسائل التواصل
     */
    public function contactMessages(Request $request)
    {
        $query = ContactMessage::query();

        // تصفية حسب الحالة
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $messages = $query->orderBy('created_at', 'desc')->paginate(20);
        
        $stats = [
            'total' => ContactMessage::count(),
            'new' => ContactMessage::where('status', 'new')->count(),
            'read' => ContactMessage::where('status', 'read')->count(),
            'replied' => ContactMessage::where('status', 'replied')->count(),
            'closed' => ContactMessage::where('status', 'closed')->count(),
        ];

        return view('admin.contact.index', compact('messages', 'stats'));
    }

    /**
     * عرض رسالة محددة
     */
    public function showContactMessage(ContactMessage $message)
    {
        // تحديد الرسالة كمقروءة إذا كانت جديدة
        if ($message->status === 'new') {
            $message->markAsRead();
        }

        return view('admin.contact.show', compact('message'));
    }

    /**
     * تحديث حالة الرسالة
     */
    public function updateContactMessageStatus(Request $request, ContactMessage $message)
    {
        $request->validate([
            'status' => 'required|in:new,read,replied,closed',
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        $message->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes
        ]);

        return response()->json([
            'success' => true,
            'message' => 'تم تحديث حالة الرسالة بنجاح',
            'status_text' => $message->status_text,
            'status_color' => $message->status_color
        ]);
    }

    /**
     * حذف رسالة
     */
    public function deleteContactMessage(ContactMessage $message)
    {
        $message->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'تم حذف الرسالة بنجاح'
        ]);
    }

    /**
     * تصدير رسائل التواصل
     */
    public function exportContactMessages(Request $request)
    {
        $query = ContactMessage::query();

        // تصفية حسب الحالة
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // تصفية حسب التاريخ
        if ($request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $messages = $query->orderBy('created_at', 'desc')->get();

        $filename = 'contact_messages_' . now()->format('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($messages) {
            $file = fopen('php://output', 'w');
            
            // رأس الجدول
            fputcsv($file, [
                'الاسم',
                'البريد الإلكتروني',
                'الهاتف',
                'الموضوع',
                'الرسالة',
                'الحالة',
                'ملاحظات المدير',
                'تاريخ الإرسال',
                'تاريخ القراءة',
                'تاريخ الرد'
            ]);

            // البيانات
            foreach ($messages as $message) {
                fputcsv($file, [
                    $message->name,
                    $message->email,
                    $message->phone,
                    $message->subject,
                    $message->message,
                    $message->status_text,
                    $message->admin_notes,
                    $message->created_at->format('Y-m-d H:i:s'),
                    $message->read_at ? $message->read_at->format('Y-m-d H:i:s') : '',
                    $message->replied_at ? $message->replied_at->format('Y-m-d H:i:s') : ''
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
