<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Payment;
use App\Models\Category;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:teacher');
    }

    public function dashboard()
    {
        $teacher = Auth::user();
        
        // Get teacher's courses
        $courses = Course::where('instructor_id', $teacher->id)
                        ->with(['category', 'enrollments'])
                        ->latest()
                        ->take(6)
                        ->get();

        // Calculate statistics
        $totalCourses = Course::where('instructor_id', $teacher->id)->count();
        $totalStudents = Enrollment::whereHas('course', function($query) use ($teacher) {
            $query->where('instructor_id', $teacher->id);
        })->distinct('student_id')->count();
        
        $totalRevenue = Payment::whereHas('course', function($query) use ($teacher) {
            $query->where('instructor_id', $teacher->id);
        })->sum('amount');

        // Calculate average rating
        $averageRating = Course::where('instructor_id', $teacher->id)
                              ->avg('rating') ?? 0;

        // Get recent students
        $recentStudents = Enrollment::whereHas('course', function($query) use ($teacher) {
            $query->where('instructor_id', $teacher->id);
        })
        ->with(['student', 'course'])
        ->latest()
        ->take(10)
        ->get();

        return view('teacher.dashboard', compact(
            'courses',
            'totalCourses',
            'totalStudents',
            'totalRevenue',
            'averageRating',
            'recentStudents'
        ));
    }

    public function courses(Request $request)
    {
        $teacher = Auth::user();
        
        $query = Course::where('instructor_id', $teacher->id)
                      ->with(['category', 'enrollments', 'lessons']);

        // Apply filters
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title_ar', 'like', '%' . $request->search . '%')
                  ->orWhere('title_en', 'like', '%' . $request->search . '%')
                  ->orWhere('description_ar', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $courses = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('teacher.courses.index', compact('courses', 'categories'));
    }



    public function students(Request $request)
    {
        $teacher = Auth::user();
        
        $query = User::whereHas('enrollments', function($query) use ($teacher) {
            $query->whereHas('course', function($q) use ($teacher) {
                $q->where('instructor_id', $teacher->id);
            });
        });

        // Apply filters
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('course_id')) {
            $query->whereHas('enrollments', function($q) use ($request) {
                $q->where('course_id', $request->course_id);
            });
        }

        if ($request->filled('status')) {
            $query->whereHas('enrollments', function($q) use ($request) {
                $q->where('status', $request->status);
            });
        }

        $students = $query->with(['enrollments' => function($query) use ($teacher) {
            $query->whereHas('course', function($q) use ($teacher) {
                $q->where('instructor_id', $teacher->id);
            });
        }, 'enrollments.course'])
        ->paginate(20);

        $courses = Course::where('instructor_id', $teacher->id)->get();
        
        // Calculate statistics
        $totalStudents = User::whereHas('enrollments', function($query) use ($teacher) {
            $query->whereHas('course', function($q) use ($teacher) {
                $q->where('instructor_id', $teacher->id);
            });
        })->count();

        $activeStudents = User::whereHas('enrollments', function($query) use ($teacher) {
            $query->whereHas('course', function($q) use ($teacher) {
                $q->where('instructor_id', $teacher->id);
            });
            $query->where('status', 'active');
        })->count();

        $completedStudents = User::whereHas('enrollments', function($query) use ($teacher) {
            $query->whereHas('course', function($q) use ($teacher) {
                $q->where('instructor_id', $teacher->id);
            });
            $query->where('status', 'completed');
        })->count();

        $averageProgress = \App\Models\Enrollment::whereHas('course', function($query) use ($teacher) {
            $query->where('instructor_id', $teacher->id);
        })->avg('progress_percentage') ?? 0;

        return view('teacher.students.index', compact('students', 'courses', 'totalStudents', 'activeStudents', 'completedStudents', 'averageProgress'));
    }

    public function showStudent(User $student)
    {
        $teacher = Auth::user();
        
        $enrollments = $student->enrollments()
                              ->whereHas('course', function($query) use ($teacher) {
                                  $query->where('instructor_id', $teacher->id);
                              })
                              ->with(['course', 'lessons'])
                              ->get();

        return view('teacher.students.show', compact('student', 'enrollments'));
    }

    public function lessons()
    {
        $teacher = Auth::user();
        
        $lessons = Lesson::whereHas('course', function($query) use ($teacher) {
            $query->where('instructor_id', $teacher->id);
        })
        ->with(['course'])
        ->latest()
        ->paginate(20);

        return view('teacher.lessons.index', compact('lessons'));
    }

    public function createLesson()
    {
        $teacher = Auth::user();
        $courses = Course::where('instructor_id', $teacher->id)->get();
        return view('teacher.lessons.create', compact('courses'));
    }

    public function storeLesson(Request $request)
    {
        $teacher = Auth::user();
        
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'order' => 'required|integer|min:1',
            'duration' => 'required|integer|min:1',
            'content_type' => 'required|in:video,text,file,link',
            'is_free' => 'boolean',
        ]);

        // Verify the course belongs to the teacher
        $course = Course::where('id', $request->course_id)
                       ->where('instructor_id', $teacher->id)
                       ->firstOrFail();

        $data = $request->all();
        $data['course_id'] = $course->id;
        $data['is_free'] = $request->has('is_free');

        // Handle file uploads
        if ($request->hasFile('video_file')) {
            $data['video_file'] = $request->file('video_file')->store('lessons/videos', 'public');
        }
        if ($request->hasFile('lesson_file')) {
            $data['lesson_file'] = $request->file('lesson_file')->store('lessons/files', 'public');
        }

        Lesson::create($data);

        return redirect()->route('teacher.lessons.index')
                        ->with('success', 'تم إضافة الدرس بنجاح');
    }

    public function showLesson(Lesson $lesson)
    {
        $teacher = Auth::user();
        
        // Verify the lesson belongs to the teacher
        if ($lesson->course->instructor_id !== $teacher->id) {
            abort(403);
        }
        
        return view('teacher.lessons.show', compact('lesson'));
    }

    public function editLesson(Lesson $lesson)
    {
        $teacher = Auth::user();
        
        // Verify the lesson belongs to the teacher
        if ($lesson->course->instructor_id !== $teacher->id) {
            abort(403);
        }
        
        $courses = Course::where('instructor_id', $teacher->id)->get();
        return view('teacher.lessons.edit', compact('lesson', 'courses'));
    }

    public function updateLesson(Request $request, Lesson $lesson)
    {
        $teacher = Auth::user();
        
        // Verify the lesson belongs to the teacher
        if ($lesson->course->instructor_id !== $teacher->id) {
            abort(403);
        }

        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'order' => 'required|integer|min:1',
            'duration' => 'required|integer|min:1',
            'content_type' => 'required|in:video,text,file,link',
            'is_free' => 'boolean',
        ]);

        // Verify the new course belongs to the teacher
        $course = Course::where('id', $request->course_id)
                       ->where('instructor_id', $teacher->id)
                       ->firstOrFail();

        $data = $request->all();
        $data['course_id'] = $course->id;
        $data['is_free'] = $request->has('is_free');

        // Handle file uploads
        if ($request->hasFile('video_file')) {
            $data['video_file'] = $request->file('video_file')->store('lessons/videos', 'public');
        }
        if ($request->hasFile('lesson_file')) {
            $data['lesson_file'] = $request->file('lesson_file')->store('lessons/files', 'public');
        }

        $lesson->update($data);

        return redirect()->route('teacher.lessons.show', $lesson)
                        ->with('success', 'تم تحديث الدرس بنجاح');
    }

    public function destroyLesson(Lesson $lesson)
    {
        $teacher = Auth::user();
        
        // Verify the lesson belongs to the teacher
        if ($lesson->course->instructor_id !== $teacher->id) {
            abort(403);
        }
        
        $lesson->delete();
        return redirect()->route('teacher.lessons.index')
                        ->with('success', 'تم حذف الدرس بنجاح');
    }



    public function reports()
    {
        $teacher = Auth::user();
        
        // Monthly revenue data
        $monthlyRevenue = Payment::whereHas('course', function($query) use ($teacher) {
            $query->where('instructor_id', $teacher->id);
        })
        ->selectRaw('strftime("%m", created_at) as month, SUM(amount) as total')
        ->whereRaw('strftime("%Y", created_at) = ?', [date('Y')])
        ->groupBy('month')
        ->get();

        // Course performance data
        $coursePerformance = Course::where('instructor_id', $teacher->id)
                                  ->withCount('enrollments')
                                  ->orderBy('enrollments_count', 'desc')
                                  ->take(10)
                                  ->get();

        return view('teacher.reports.index', compact('monthlyRevenue', 'coursePerformance'));
    }

    public function profile()
    {
        $teacher = Auth::user();
        return view('teacher.profile.index', compact('teacher'));
    }

    public function updateProfile(Request $request)
    {
        $teacher = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $teacher->id,
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:1000',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $teacher->update($data);

        return redirect()->route('teacher.profile')
                        ->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }

    // Missing methods for course management
    public function destroyCourse(Course $course)
    {
        $this->authorize('delete', $course);
        
        if ($course->enrollments()->count() > 0) {
            return back()->with('error', 'لا يمكن حذف الدورة لوجود تسجيلات مرتبطة بها');
        }

        $course->delete();
        return redirect()->route('teacher.courses.index')
                        ->with('success', 'تم حذف الدورة بنجاح');
    }

    public function publishCourse(Course $course)
    {
        $this->authorize('update', $course);
        $course->update(['status' => 'published']);
        return back()->with('success', 'تم نشر الدورة بنجاح');
    }

    public function unpublishCourse(Course $course)
    {
        $this->authorize('update', $course);
        $course->update(['status' => 'draft']);
        return back()->with('success', 'تم إلغاء نشر الدورة');
    }



    // Missing methods for student management
    public function studentProgress(User $student)
    {
        $teacher = Auth::user();
        
        $enrollments = $student->enrollments()
                              ->whereHas('course', function($query) use ($teacher) {
                                  $query->where('instructor_id', $teacher->id);
                              })
                              ->with(['course', 'lessons'])
                              ->get();

        return view('teacher.students.progress', compact('student', 'enrollments'));
    }

    public function studentCertificates(User $student)
    {
        $teacher = Auth::user();
        
        $certificates = $student->certificates()
                               ->whereHas('course', function($query) use ($teacher) {
                                   $query->where('instructor_id', $teacher->id);
                               })
                               ->get();

        return view('teacher.students.certificates', compact('student', 'certificates'));
    }

    // Missing methods for enrollment management
    public function enrollments()
    {
        $teacher = Auth::user();
        
        $enrollments = Enrollment::whereHas('course', function($query) use ($teacher) {
            $query->where('instructor_id', $teacher->id);
        })
        ->with(['student', 'course'])
        ->latest()
        ->paginate(20);

        $courses = Course::where('instructor_id', $teacher->id)->get();

        return view('teacher.enrollments.index', compact('enrollments', 'courses'));
    }

    public function showEnrollment(Enrollment $enrollment)
    {
        $this->authorize('view', $enrollment);
        return view('teacher.enrollments.show', compact('enrollment'));
    }

    public function updateEnrollmentStatus(Request $request, Enrollment $enrollment)
    {
        $this->authorize('update', $enrollment);
        
        $request->validate([
            'status' => 'required|in:active,completed,cancelled'
        ]);

        $enrollment->update(['status' => $request->status]);

        return back()->with('success', 'تم تحديث حالة التسجيل بنجاح');
    }

    // Missing methods for reports
    public function studentReports()
    {
        $teacher = Auth::user();
        
        $students = User::whereHas('enrollments', function($query) use ($teacher) {
            $query->whereHas('course', function($q) use ($teacher) {
                $q->where('instructor_id', $teacher->id);
            });
        })
        ->with(['enrollments' => function($query) use ($teacher) {
            $query->whereHas('course', function($q) use ($teacher) {
                $q->where('instructor_id', $teacher->id);
            });
        }, 'enrollments.course'])
        ->paginate(20);

        return view('teacher.reports.students', compact('students'));
    }

    public function courseReports()
    {
        $teacher = Auth::user();
        
        $courses = Course::where('instructor_id', $teacher->id)
                        ->withCount('enrollments')
                        ->orderBy('enrollments_count', 'desc')
                        ->paginate(20);

        return view('teacher.reports.courses', compact('courses'));
    }

    public function revenueReports()
    {
        $teacher = Auth::user();
        
        $monthlyRevenue = Payment::whereHas('course', function($query) use ($teacher) {
            $query->where('instructor_id', $teacher->id);
        })
        ->selectRaw('strftime("%m", created_at) as month, SUM(amount) as total')
        ->whereRaw('strftime("%Y", created_at) = ?', [date('Y')])
        ->groupBy('month')
        ->get();

        return view('teacher.reports.revenue', compact('monthlyRevenue'));
    }

    // Missing methods for analytics and settings
    public function analytics()
    {
        $teacher = Auth::user();
        
        // Get basic statistics
        $totalCourses = Course::where('instructor_id', $teacher->id)->count();
        $totalStudents = Enrollment::whereHas('course', function($query) use ($teacher) {
            $query->where('instructor_id', $teacher->id);
        })->distinct('student_id')->count();
        
        $totalRevenue = Payment::whereHas('course', function($query) use ($teacher) {
            $query->where('instructor_id', $teacher->id);
        })->sum('amount');

        $averageRating = Course::where('instructor_id', $teacher->id)
                              ->avg('rating') ?? 0;

        // Get monthly revenue data
        $monthlyRevenue = Payment::whereHas('course', function($query) use ($teacher) {
            $query->where('instructor_id', $teacher->id);
        })
        ->selectRaw('strftime("%m", created_at) as month, SUM(amount) as total')
        ->whereRaw('strftime("%Y", created_at) = ?', [date('Y')])
        ->groupBy('month')
        ->get();

        // Get top performing courses
        $topCourses = Course::where('instructor_id', $teacher->id)
                           ->withCount('enrollments')
                           ->orderBy('enrollments_count', 'desc')
                           ->take(5)
                           ->get();

        // Get recent activity (enrollments)
        $recentActivity = Enrollment::whereHas('course', function($query) use ($teacher) {
            $query->where('instructor_id', $teacher->id);
        })
        ->with(['student', 'course'])
        ->latest()
        ->take(10)
        ->get();

        return view('teacher.analytics.index', compact(
            'totalCourses',
            'totalStudents', 
            'totalRevenue',
            'averageRating',
            'monthlyRevenue',
            'topCourses',
            'recentActivity'
        ));
    }

    public function settings()
    {
        $teacher = Auth::user();
        return view('teacher.settings.index', compact('teacher'));
    }

    public function updateSettings(Request $request)
    {
        $teacher = Auth::user();
        $settingsType = $request->input('settings_type');

        switch ($settingsType) {
            case 'notifications':
                return $this->updateNotificationSettings($request, $teacher);
            case 'privacy':
                return $this->updatePrivacySettings($request, $teacher);
            case 'security':
                return $this->updateSecuritySettings($request, $teacher);
            default:
                return back()->with('error', 'نوع الإعدادات غير صحيح');
        }
    }

    private function updateNotificationSettings(Request $request, $teacher)
    {
        $request->validate([
            'notification_preferences' => 'nullable|array',
            'notification_preferences.email' => 'nullable|boolean',
            'notification_preferences.sms' => 'nullable|boolean',
            'notification_preferences.new_enrollment' => 'nullable|boolean',
            'notification_preferences.course_completion' => 'nullable|boolean',
            'notification_preferences.payment_received' => 'nullable|boolean',
        ]);

        $notificationPreferences = $request->input('notification_preferences', []);
        
        // Store notification preferences in user settings
        $teacher->settings()->updateOrCreate(
            ['key' => 'notification_preferences'],
            ['value' => json_encode($notificationPreferences)]
        );

        return back()->with('success', 'تم تحديث إعدادات الإشعارات بنجاح');
    }

    private function updatePrivacySettings(Request $request, $teacher)
    {
        $request->validate([
            'privacy_settings' => 'nullable|array',
            'privacy_settings.profile_public' => 'nullable|boolean',
            'privacy_settings.show_email' => 'nullable|boolean',
            'privacy_settings.show_phone' => 'nullable|boolean',
            'privacy_settings.show_courses' => 'nullable|boolean',
        ]);

        $privacySettings = $request->input('privacy_settings', []);
        
        // Store privacy settings in user settings
        $teacher->settings()->updateOrCreate(
            ['key' => 'privacy_settings'],
            ['value' => json_encode($privacySettings)]
        );

        return back()->with('success', 'تم تحديث إعدادات الخصوصية بنجاح');
    }

    private function updateSecuritySettings(Request $request, $teacher)
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
            if (!Hash::check($request->current_password, $teacher->password)) {
                return back()->withErrors(['current_password' => 'كلمة المرور الحالية غير صحيحة']);
            }

            $teacher->update([
                'password' => Hash::make($request->new_password)
            ]);
        }

        $securitySettings = $request->input('security_settings', []);
        
        // Store security settings in user settings
        $teacher->settings()->updateOrCreate(
            ['key' => 'security_settings'],
            ['value' => json_encode($securitySettings)]
        );

        $message = 'تم تحديث إعدادات الأمان بنجاح';
        if ($request->filled('new_password')) {
            $message .= ' وتم تغيير كلمة المرور بنجاح';
        }

        return back()->with('success', $message);
    }

    // Course Management Methods
    public function createCourse()
    {
        $categories = Category::all();
        return view('teacher.courses.create', compact('categories'));
    }

    public function storeCourse(Request $request)
    {
        $teacher = Auth::user();

        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'level' => 'required|in:beginner,intermediate,advanced',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $data['instructor_id'] = $teacher->id;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        Course::create($data);

        return redirect()->route('teacher.courses.index')
                        ->with('success', 'تم إنشاء الدورة بنجاح');
    }

    public function showCourse(Course $course)
    {
        $this->authorize('view', $course);
        
        $course->load(['category', 'lessons', 'enrollments.user']);
        return view('teacher.courses.show', compact('course'));
    }

    public function editCourse(Course $course)
    {
        $this->authorize('update', $course);
        
        $categories = Category::all();
        return view('teacher.courses.edit', compact('course', 'categories'));
    }

    public function updateCourse(Request $request, Course $course)
    {
        $this->authorize('update', $course);

        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'level' => 'required|in:beginner,intermediate,advanced',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        $course->update($data);

        return redirect()->route('teacher.courses.show', $course)
                        ->with('success', 'تم تحديث الدورة بنجاح');
    }

    // Lesson Management Methods
    public function reorderLessons(Request $request, Course $course)
    {
        $this->authorize('update', $course);

        $request->validate([
            'lessons' => 'required|array',
            'lessons.*.id' => 'required|exists:lessons,id',
            'lessons.*.order' => 'required|integer|min:1',
        ]);

        foreach ($request->lessons as $lessonData) {
            Lesson::where('id', $lessonData['id'])->update(['order' => $lessonData['order']]);
        }

        return response()->json(['success' => true]);
    }
}
