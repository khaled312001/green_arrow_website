<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Category;
use App\Models\BlogPost;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * الصفحة الرئيسية
     */
    public function index()
    {
        try {
            // إحصائيات عامة
            $stats = [
                'total_courses' => Course::where('status', 'published')->count(),
                'total_students' => User::role('student')->count() ?? 0,
                'total_instructors' => User::role('teacher')->count() ?? 0,
                'total_categories' => Category::where('is_active', true)->count() ?? 0,
            ];

            // الأقسام مع عدد الدورات النشطة
            $categories = Category::where('is_active', true)
                ->withCount(['courses as active_courses_count' => function($query) {
                    $query->where('status', 'published');
                }])
                ->take(8)
                ->get();

            // الدورات المميزة
            $featuredCourses = Course::where('status', 'published')
                ->with(['category', 'instructor'])
                ->where('is_featured', true)
                ->latest()
                ->take(6)
                ->get();

            // أحدث المقالات
            $latestPosts = BlogPost::where('status', 'published')
                ->with('author')
                ->latest('published_at')
                ->take(3)
                ->get();

            return view('home', compact('stats', 'categories', 'featuredCourses', 'latestPosts'));
        } catch (\Exception $e) {
            // Fallback data if database is not ready
            return view('home', [
                'stats' => [
                    'total_courses' => 0,
                    'total_students' => 0,
                    'total_instructors' => 0,
                    'total_categories' => 0,
                ],
                'categories' => collect(),
                'featuredCourses' => collect(),
                'latestPosts' => collect(),
            ]);
        }
    }
    
    /**
     * صفحة من نحن
     */
    public function about()
    {
        try {
            $stats = [
                'total_courses' => Course::where('status', 'published')->count(),
                'total_students' => User::role('student')->count() ?? 0,
                'total_instructors' => User::role('teacher')->count() ?? 0,
                'total_categories' => Category::where('is_active', true)->count() ?? 0,
            ];

            // المدربين المميزين مع معلومات إضافية
            $instructors = User::role('teacher')
                ->with(['teachingCourses' => function($query) {
                    $query->where('status', 'published');
                }])
                ->where('is_active', true)
                ->inRandomOrder()
                ->take(8)
                ->get() ?? collect();
                
            return view('about', compact('instructors', 'stats'));
        } catch (\Exception $e) {
            return view('about', [
                'instructors' => collect(),
                'stats' => [
                    'total_courses' => 0,
                    'total_students' => 0,
                    'total_instructors' => 0,
                    'total_categories' => 0,
                ]
            ]);
        }
    }
    
    /**
     * صفحة اتصل بنا
     */
    public function contact()
    {
        return view('contact');
    }
    
    /**
     * معالجة نموذج التواصل
     */
    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ], [
            'name.required' => 'الاسم مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'subject.required' => 'الموضوع مطلوب',
            'message.required' => 'الرسالة مطلوبة',
        ]);
        
        // هنا يمكن إرسال الرسالة عبر البريد الإلكتروني أو حفظها في قاعدة البيانات
        // Mail::to('admin@greenarrowacademy.com')->send(new ContactMessage($request->all()));
        
        return back()->with('success', 'تم إرسال رسالتك بنجاح. سنتواصل معك قريباً.');
    }
    
    /**
     * صفحة المدونة
     */
    public function blog(Request $request)
    {
        $query = BlogPost::where('status', 'published')
            ->latest('published_at');
            
        // البحث
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title_ar', 'like', "%{$search}%")
                  ->orWhere('title_en', 'like', "%{$search}%")
                  ->orWhere('content_ar', 'like', "%{$search}%")
                  ->orWhere('content_en', 'like', "%{$search}%");
            });
        }
        
        // التصنيف
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }
        
        $posts = $query->paginate(12);
        
        // التصنيفات المتاحة
        $categories = BlogPost::where('status', 'published')
            ->select('category')
            ->distinct()
            ->pluck('category');
            
        // المقالات المميزة
        $featuredPosts = BlogPost::where('status', 'published')
            ->where('is_featured', true)
            ->latest('published_at')
            ->limit(5)
            ->get();
        
        return view('blog.index', compact('posts', 'categories', 'featuredPosts'));
    }
    
    /**
     * عرض مقال واحد
     */
    public function blogPost($slug)
    {
        $post = BlogPost::where('slug', $slug)
            ->where('status', 'published')
            ->with('author')
            ->firstOrFail();
            
        // زيادة عدد المشاهدات
        $post->increment('views_count');
        
        // المقالات ذات الصلة
        $relatedPosts = BlogPost::where('status', 'published')
            ->where('category', $post->category)
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->limit(4)
            ->get();
        
        return view('blog.show', compact('post', 'relatedPosts'));
    }
    
    /**
     * صفحة التسجيل للدورات والورش
     */
    public function register()
    {
        // الدورات المتاحة
        $courses = Course::published()
            ->with(['category', 'instructor'])
            ->latest()
            ->limit(8)
            ->get();
            
        // الأقسام
        $categories = Category::withCount(['courses as active_courses_count' => function($query) {
            $query->where('status', 'published');
        }])->get();
        
        return view('register', compact('courses', 'categories'));
    }
    
    /**
     * معالجة نموذج التسجيل
     */
    public function submitRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'registration_type' => 'required|in:course,workshop_online,workshop_offline',
            'course_id' => 'nullable|exists:courses,id',
            'workshop_type' => 'nullable|in:programming,business,language,design',
            'workshop_date' => 'nullable|date|after:today',
            'message' => 'nullable|string|max:1000',
            'preferred_time' => 'nullable|in:morning,afternoon,evening',
        ], [
            'name.required' => 'الاسم مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'phone.required' => 'رقم الهاتف مطلوب',
            'registration_type.required' => 'نوع التسجيل مطلوب',
            'course_id.exists' => 'الدورة المختارة غير موجودة',
            'workshop_date.after' => 'تاريخ الورشة يجب أن يكون بعد اليوم',
        ]);
        
        // هنا يمكن حفظ البيانات في قاعدة البيانات أو إرسالها عبر البريد الإلكتروني
        // يمكن إنشاء جدول جديد للتسجيلات أو استخدام جدول الاتصال
        
        return back()->with('success', 'تم تسجيل طلبك بنجاح! سنتواصل معك قريباً لتأكيد التسجيل.');
    }

}
