<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * صفحة جميع الدورات
     */
    public function index(Request $request)
    {
        $query = Course::with(['category', 'instructor'])
            ->where('status', 'published');

        // تطبيق البحث
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title_ar', 'like', '%' . $request->search . '%')
                  ->orWhere('description_ar', 'like', '%' . $request->search . '%');
            });
        }

        // تطبيق التصفية حسب القسم
        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        // تطبيق التصفية حسب المستوى
        if ($request->level) {
            $query->where('level', $request->level);
        }

        // تطبيق الترتيب
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'popular':
                $query->orderBy('enrolled_count', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $courses = $query->paginate(12);
        $categories = Category::where('is_active', true)->get();
        
        // الدورات المميزة
        $featuredCourses = Course::with(['category', 'instructor'])
            ->where('status', 'published')
            ->where('is_featured', true)
            ->take(6)
            ->get();

        return view('courses.index', compact('courses', 'categories', 'featuredCourses'));
    }

    /**
     * دورات قسم محدد
     */
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->where('is_active', true)->firstOrFail();
        
        $courses = Course::with(['instructor'])
            ->where('status', 'published')
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(12);

        return view('courses.category', compact('category', 'courses'));
    }

    /**
     * عرض تفاصيل دورة
     */
    public function show($slug)
    {
        $course = Course::with(['category', 'instructor', 'lessons'])
            ->where('status', 'published')
            ->where('slug', $slug)
            ->firstOrFail();

        // الحصول على دورات مشابهة
        $related_courses = Course::with(['category', 'instructor'])
            ->where('status', 'published')
            ->where('category_id', $course->category_id)
            ->where('id', '!=', $course->id)
            ->take(4)
            ->get();

        // التحقق من تسجيل المستخدم في الدورة
        $enrollment = null;
        if (Auth::check()) {
            $enrollment = Enrollment::where('user_id', Auth::id())
                ->where('course_id', $course->id)
                ->first();
        }

        // إنشاء مراجعات وهمية (يمكن إضافتها لاحقاً)
        $reviews = collect([
            (object) [
                'rating' => 5,
                'review' => 'دورة ممتازة ومفيدة جداً، المدرب يشرح بطريقة واضحة ومفهومة',
                'comment' => 'دورة ممتازة ومفيدة جداً، المدرب يشرح بطريقة واضحة ومفهومة',
                'created_at' => now()->subDays(2),
                'user' => (object) [
                    'name' => 'أحمد محمد',
                    'avatar_url' => 'https://ui-avatars.com/api/?name=أحمد+محمد&background=10b981&color=fff&size=150'
                ],
                'reviewed_at' => now()->subDays(2)
            ],
            (object) [
                'rating' => 4,
                'review' => 'محتوى الدورة غني ومفيد، أنصح بها للمبتدئين',
                'comment' => 'محتوى الدورة غني ومفيد، أنصح بها للمبتدئين',
                'created_at' => now()->subDays(5),
                'user' => (object) [
                    'name' => 'فاطمة علي',
                    'avatar_url' => 'https://ui-avatars.com/api/?name=فاطمة+علي&background=ec4899&color=fff&size=150'
                ],
                'reviewed_at' => now()->subDays(5)
            ],
            (object) [
                'rating' => 5,
                'review' => 'أفضل دورة في البرمجة، المدرب محترف جداً',
                'comment' => 'أفضل دورة في البرمجة، المدرب محترف جداً',
                'created_at' => now()->subDays(7),
                'user' => (object) [
                    'name' => 'محمد أحمد',
                    'avatar_url' => 'https://ui-avatars.com/api/?name=محمد+أحمد&background=3b82f6&color=fff&size=150'
                ],
                'reviewed_at' => now()->subDays(7)
            ]
        ]);

        return view('courses.show', compact(
            'course',
            'related_courses',
            'reviews',
            'enrollment'
        ));
    }

    /**
     * صفحة المدربين
     */
    public function instructors(Request $request)
    {
        $instructors = User::role('teacher')
            ->where('is_active', true)
            ->with(['teachingCourses' => function($query) {
                $query->where('status', 'published');
            }])
            ->get()
            ->map(function($instructor) {
                // حساب الإحصائيات لكل مدرب
                $publishedCourses = $instructor->teachingCourses->where('status', 'published');
                $totalStudents = Enrollment::whereIn('course_id', $publishedCourses->pluck('id'))->distinct('user_id')->count();
                
                $instructor->courses_count = $publishedCourses->count();
                $instructor->total_students = $totalStudents;
                $instructor->average_rating = 4.8; // قيمة افتراضية
                $instructor->reviews_count = 25; // قيمة افتراضية
                $instructor->speciality = 'مدرب محترف في مجال التدريب والتعليم';
                $instructor->bio = 'مدرب محترف مع خبرة واسعة في مجال التدريب والتعليم. يساعد الطلاب على تحقيق أهدافهم التعليمية من خلال دورات عالية الجودة.';
                
                return $instructor;
            });

        return view('instructors.index', compact('instructors'));
    }

    /**
     * صفحة مدرب محدد
     */
    public function instructor($id)
    {
        $instructor = User::role('teacher')
            ->where('is_active', true)
            ->with(['teachingCourses' => function($query) {
                $query->where('status', 'published');
            }])
            ->findOrFail($id);

        // حساب الإحصائيات للمدرب
        $stats = [
            'total_courses' => $instructor->teachingCourses->where('status', 'published')->count(),
            'total_students' => Enrollment::whereIn('course_id', $instructor->teachingCourses->pluck('id'))->distinct('user_id')->count(),
            'average_rating' => 4.8 // قيمة افتراضية - يمكن حسابها من التقييمات الفعلية لاحقاً
        ];

        // الحصول على دورات المدرب
        $courses = $instructor->teachingCourses->where('status', 'published');

        return view('instructors.show', compact('instructor', 'stats', 'courses'));
    }

    /**
     * التسجيل في دورة
     */
    public function enroll(Request $request, Course $course)
    {
        // التحقق من أن المستخدم مسجل دخول
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'يجب تسجيل الدخول أولاً');
        }

        $user = Auth::user();

        // التحقق من أن المستخدم ليس مسجل بالفعل
        $existingEnrollment = Enrollment::where('student_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if ($existingEnrollment) {
            return back()->with('error', 'أنت مسجل بالفعل في هذه الدورة');
        }

        // التحقق من أن الدورة متاحة للتسجيل
        if (!$course->canEnroll()) {
            return back()->with('error', 'هذه الدورة غير متاحة للتسجيل حالياً');
        }

        // إنشاء التسجيل
        $enrollment = Enrollment::create([
            'student_id' => $user->id,
            'course_id' => $course->id,
            'status' => 'active',
            'enrolled_at' => now(),
        ]);

        // إذا كانت الدورة مجانية، تفعيلها مباشرة
        if ($course->is_free) {
            $enrollment->update([
                'activated_at' => now(),
                'status' => 'active'
            ]);
            
            return redirect()->route('student.courses.show', $course)
                ->with('success', 'تم التسجيل في الدورة بنجاح!');
        }

        // إذا كانت الدورة مدفوعة، توجيه إلى صفحة الدفع
        return redirect()->route('payment', $course)
            ->with('success', 'تم إضافة الدورة إلى سلة التسجيل');
    }

    /**
     * صفحة الدفع
     */
    public function payment(Course $course)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // التحقق من أن المستخدم ليس مسجل بالفعل
        $existingEnrollment = Enrollment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if ($existingEnrollment) {
            return redirect()->route('student.courses.show', $course)
                ->with('error', 'أنت مسجل بالفعل في هذه الدورة');
        }

        // حساب المبالغ
        if ($course->is_free) {
            $amount = 0;
            $tax_amount = 0;
            $total_amount = 0;
        } else {
            $amount = $course->discount_price ?? $course->price;
            $tax_amount = $amount * 0.15; // ضريبة القيمة المضافة 15%
            $total_amount = $amount + $tax_amount;
        }

        return view('courses.payment', compact('course', 'amount', 'tax_amount', 'total_amount'));
    }

    /**
     * معالجة الدفع
     */
    public function processPayment(Request $request, Course $course)
    {
        $request->validate([
            'payment_method' => 'required|in:bank_transfer,cash,online',
            'amount' => 'required|numeric|min:0',
        ]);

        $user = Auth::user();

        // التحقق من أن المستخدم ليس مسجل بالفعل
        $existingEnrollment = Enrollment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if ($existingEnrollment) {
            return redirect()->route('student.courses.show', $course)
                ->with('error', 'أنت مسجل بالفعل في هذه الدورة');
        }

        // إنشاء تسجيل جديد
        $enrollment = Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'status' => $course->is_free ? 'active' : 'pending',
            'enrolled_at' => now(),
            'activated_at' => $course->is_free ? now() : null,
        ]);

        // إذا كانت الدورة مجانية، تفعيلها مباشرة
        if ($course->is_free) {
            return redirect()->route('student.courses.show', $course)
                ->with('success', 'تم التسجيل في الدورة بنجاح!');
        }

        // إنشاء عملية دفع
        $payment = Payment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'payment_id' => 'PAY-' . time() . '-' . $user->id,
            'invoice_number' => 'INV-' . time() . '-' . $user->id,
            'amount' => $request->amount,
            'total_amount' => $request->amount,
            'currency' => 'SAR',
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'payment_data' => $request->all(),
        ]);

        // تحديث التسجيل برقم الدفعة
        $enrollment->update(['payment_id' => $payment->id]);

        // توجيه حسب طريقة الدفع
        switch ($request->payment_method) {
            case 'bank_transfer':
                return redirect()->route('payment.bank-transfer', $payment);
            case 'cash':
                return redirect()->route('payment.cash', $payment);
            case 'online':
                // هنا يمكن إضافة منطق الدفع الإلكتروني
                return redirect()->route('payment.success', $payment);
            default:
                return back()->with('error', 'طريقة دفع غير صحيحة');
        }
    }

    /**
     * تأكيد الدفع
     */
    public function confirmPayment(Request $request, Payment $payment)
    {
        $request->validate([
            'transaction_id' => 'required|string',
            'payment_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // تحديث حالة الدفع
        $payment->update([
            'status' => 'completed',
            'transaction_id' => $request->transaction_id,
            'completed_at' => now(),
        ]);

        // تفعيل التسجيل
        $payment->enrollment->update([
            'status' => 'active',
            'activated_at' => now(),
        ]);

        return redirect()->route('payment.success', $payment)
            ->with('success', 'تم تأكيد الدفع بنجاح!');
    }

    /**
     * نجاح الدفع
     */
    public function paymentSuccess(Payment $payment)
    {
        return view('payments.success', compact('payment'));
    }

    /**
     * إلغاء الدفع
     */
    public function paymentCancel(Payment $payment)
    {
        return view('payments.cancel', compact('payment'));
    }

    /**
     * تفاصيل التحويل البنكي
     */
    public function bankTransferDetails(Payment $payment)
    {
        return view('payments.bank-transfer', compact('payment'));
    }

    /**
     * تفاصيل الدفع النقدي
     */
    public function cashPaymentDetails(Payment $payment)
    {
        return view('payments.cash', compact('payment'));
    }

    /**
     * API للحصول على دروس الدورة
     */
    public function apiLessons(Course $course)
    {
        $lessons = $course->lessons()
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->get();

        return response()->json($lessons);
    }
}
