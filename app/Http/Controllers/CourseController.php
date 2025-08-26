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
        $query = Course::published()->with(['category', 'instructor']);

        // البحث
        if ($request->search) {
            $query->search($request->search);
        }

        // تصفية حسب القسم
        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        // تصفية حسب المستوى
        if ($request->level) {
            $query->where('level', $request->level);
        }

        // تصفية حسب النوع
        if ($request->type) {
            $query->where('type', $request->type);
        }

        // تصفية حسب السعر
        if ($request->price_filter) {
            if ($request->price_filter === 'free') {
                $query->where('is_free', true);
            } elseif ($request->price_filter === 'paid') {
                $query->where('is_free', false);
            }
        }

        // ترتيب النتائج
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'popular':
                $query->popular();
                break;
            case 'rating':
                $query->topRated();
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
        $categories = Category::active()->ordered()->get();
        
        // Get featured courses
        $featuredCourses = Course::published()
            ->where('is_featured', true)
            ->with(['category', 'instructor'])
            ->latest()
            ->limit(6)
            ->get();

        return view('courses.index', compact('courses', 'categories', 'featuredCourses'));
    }

    /**
     * دورات قسم محدد
     */
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->active()->firstOrFail();
        
        $courses = Course::published()
            ->where('category_id', $category->id)
            ->with(['instructor'])
            ->latest()
            ->paginate(12);

        return view('courses.category', compact('category', 'courses'));
    }

    /**
     * عرض تفاصيل دورة
     */
    public function show($slug)
    {
        $course = Course::where('slug', $slug)
            ->published()
            ->with(['category', 'instructor', 'lessons' => function($query) {
                $query->published()->ordered();
            }])
            ->firstOrFail();

        // زيادة عدد المشاهدات
        $course->increment('views_count');

        // التحقق من تسجيل المستخدم الحالي
        $enrollment = null;
        if (Auth::check()) {
            $enrollment = Auth::user()->enrollments()
                ->where('course_id', $course->id)
                ->first();
        }

        // دورات مشابهة
        $related_courses = Course::published()
            ->where('category_id', $course->category_id)
            ->where('id', '!=', $course->id)
            ->with(['instructor'])
            ->limit(4)
            ->get();

        // مراجعات الطلاب (من التسجيلات المكتملة)
        $reviews = Enrollment::where('course_id', $course->id)
            ->whereNotNull('review')
            ->whereNotNull('rating')
            ->with('user')
            ->latest('reviewed_at')
            ->limit(5)
            ->get();

        return view('courses.show', compact(
            'course',
            'enrollment',
            'related_courses',
            'reviews'
        ));
    }

    /**
     * صفحة المدربين
     */
    public function instructors(Request $request)
    {
        $query = User::role('teacher')
            ->with(['teachingCourses' => function($courseQuery) {
                $courseQuery->published();
            }])
            ->whereHas('teachingCourses', function($courseQuery) {
                $courseQuery->published();
            });

        // البحث
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('bio', 'like', '%' . $request->search . '%');
            });
        }

        $instructors = $query->latest()->paginate(12);

        return view('instructors.index', compact('instructors'));
    }

    /**
     * صفحة مدرب محدد
     */
    public function instructor($id)
    {
        $instructor = User::role('teacher')
            ->with(['teachingCourses' => function($query) {
                $query->published()->with(['category']);
            }])
            ->findOrFail($id);

        $courses = $instructor->teachingCourses()
            ->published()
            ->latest()
            ->paginate(8);

        // إحصائيات المدرب
        $stats = [
            'total_courses' => $instructor->teachingCourses()->published()->count(),
            'total_students' => Enrollment::whereIn('course_id', 
                $instructor->teachingCourses()->published()->pluck('id')
            )->count(),
            'average_rating' => $instructor->teachingCourses()
                ->published()
                ->avg('rating') ?? 0,
        ];

        return view('instructors.show', compact('instructor', 'courses', 'stats'));
    }

    /**
     * التسجيل في دورة
     */
    public function enroll(Request $request, Course $course)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('info', 'يجب تسجيل الدخول أولاً للتسجيل في الدورة');
        }

        $user = Auth::user();

        // التحقق من إمكانية التسجيل
        if (!$course->canEnroll()) {
            return back()->with('error', 'عذراً، لا يمكن التسجيل في هذه الدورة حالياً');
        }

        // التحقق من عدم التسجيل المسبق
        $existing_enrollment = $user->enrollments()
            ->where('course_id', $course->id)
            ->first();

        if ($existing_enrollment) {
            return back()->with('warning', 'أنت مسجل في هذه الدورة مسبقاً');
        }

        // إذا كانت الدورة مجانية، التسجيل مباشرة
        if ($course->is_free) {
            $enrollment = Enrollment::create([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'status' => 'active',
                'enrolled_at' => now(),
                'total_lessons' => $course->lessons()->published()->count(),
            ]);

            // تحديث عدد المسجلين في الدورة
            $course->increment('enrolled_count');

            return redirect()->route('student.courses.show', $course)
                ->with('success', 'تم تسجيلك في الدورة بنجاح! يمكنك البدء الآن.');
        }

        // إذا كانت الدورة مدفوعة، التوجه لصفحة الدفع
        return redirect()->route('payment', $course)
            ->with('info', 'يرجى إكمال عملية الدفع لإتمام التسجيل');
    }

    /**
     * صفحة الدفع
     */
    public function payment(Course $course)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('info', 'يجب تسجيل الدخول أولاً');
        }

        $user = Auth::user();

        // التحقق من عدم التسجيل المسبق
        $existing_enrollment = $user->enrollments()
            ->where('course_id', $course->id)
            ->first();

        if ($existing_enrollment) {
            return redirect()->route('courses.show', $course->slug)
                ->with('warning', 'أنت مسجل في هذه الدورة مسبقاً');
        }

        // حساب المبالغ
        $amount = $course->final_price;
        $tax_rate = 0.15; // ضريبة القيمة المضافة 15%
        $tax_amount = $amount * $tax_rate;
        $total_amount = $amount + $tax_amount;

        return view('courses.payment', compact(
            'course',
            'amount',
            'tax_amount',
            'total_amount'
        ));
    }

    /**
     * معالجة الدفع
     */
    public function processPayment(Request $request, Course $course)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        $request->validate([
            'payment_method' => 'required|in:online,bank_transfer,cash',
            'billing_name' => 'required|string|max:255',
            'billing_email' => 'required|email|max:255',
            'billing_phone' => 'required|string|max:20',
        ], [
            'payment_method.required' => 'يجب اختيار طريقة الدفع',
            'billing_name.required' => 'الاسم مطلوب للفوترة',
            'billing_email.required' => 'البريد الإلكتروني مطلوب للفوترة',
            'billing_phone.required' => 'رقم الهاتف مطلوب للفوترة',
        ]);

        // حساب المبالغ
        $amount = $course->final_price;
        $tax_amount = $amount * 0.15;
        $total_amount = $amount + $tax_amount;

        // إنشاء معرف دفع فريد
        $payment_id = 'GA-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid()), 0, 8));
        $invoice_number = 'INV-' . date('Y') . '-' . str_pad(Payment::count() + 1, 6, '0', STR_PAD_LEFT);

        // إنشاء سجل الدفع
        $payment = Payment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'payment_id' => $payment_id,
            'invoice_number' => $invoice_number,
            'amount' => $amount,
            'tax_amount' => $tax_amount,
            'total_amount' => $total_amount,
            'currency' => 'SAR',
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'billing_data' => [
                'name' => $request->billing_name,
                'email' => $request->billing_email,
                'phone' => $request->billing_phone,
                'address' => $request->billing_address ?? '',
            ],
            'expires_at' => now()->addDays(7), // صالح لمدة 7 أيام
        ]);

        // إنشاء التسجيل (في انتظار تأكيد الدفع)
        $enrollment = Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'payment_id' => $payment->id,
            'status' => 'pending',
            'enrolled_at' => now(),
            'total_lessons' => $course->lessons()->published()->count(),
        ]);

        // معالجة الدفع حسب الطريقة المختارة
        switch ($request->payment_method) {
            case 'online':
                return $this->handleOnlinePayment($payment, $course);
                
            case 'bank_transfer':
                return $this->handleBankTransfer($payment, $course);
                
            case 'cash':
                return $this->handleCashPayment($payment, $course);
                
            default:
                return redirect()->route('courses.show', $course->slug)
                    ->with('error', 'طريقة الدفع غير صحيحة');
        }
    }

    /**
     * معالجة الدفع الإلكتروني
     */
    private function handleOnlinePayment($payment, $course)
    {
        // محاكاة بوابة الدفع الإلكتروني
        $gateway_data = [
            'payment_id' => $payment->payment_id,
            'amount' => $payment->total_amount,
            'currency' => $payment->currency,
            'customer_name' => $payment->billing_data['name'],
            'customer_email' => $payment->billing_data['email'],
            'customer_phone' => $payment->billing_data['phone'],
            'course_title' => $course->title_ar,
            'return_url' => route('payment.success', $payment->id),
            'cancel_url' => route('payment.cancel', $payment->id),
        ];

        // في التطبيق الحقيقي، هنا سيتم التوجيه لبوابة الدفع
        // مثل PayPal, Stripe, أو أي بوابة دفع محلية
        
        // محاكاة نجاح الدفع (في التطبيق الحقيقي سيتم التأكد من البوابة)
        $this->completePayment($payment);
        
        return redirect()->route('payment.success', $payment->id)
            ->with('success', 'تم الدفع بنجاح! يمكنك الآن الوصول للدورة.');
    }

    /**
     * معالجة التحويل البنكي
     */
    private function handleBankTransfer($payment, $course)
    {
        // بيانات الحساب البنكي
        $bank_data = [
            'bank_name' => 'البنك الأهلي السعودي',
            'account_name' => 'أكاديمية السهم الأخضر للتدريب',
            'account_number' => 'SA0380000000608010167519',
            'iban' => 'SA0380000000608010167519',
            'swift_code' => 'NCBJSARI',
            'branch' => 'فرع مكة المكرمة',
        ];

        // تحديث حالة الدفع
        $payment->update([
            'status' => 'pending_confirmation',
            'payment_data' => [
                'bank_details' => $bank_data,
                'instructions' => [
                    'قم بتحويل المبلغ: ' . number_format($payment->total_amount, 2) . ' ريال',
                    'أضف رقم الفاتورة في وصف التحويل: ' . $payment->invoice_number,
                    'احتفظ بإيصال التحويل كدليل على الدفع',
                    'سيتم تفعيل حسابك خلال 24 ساعة من تأكيد التحويل'
                ]
            ]
        ]);

        return redirect()->route('payment.bank-transfer', $payment->id)
            ->with('info', 'تم إنشاء طلب التحويل البنكي. يرجى إكمال التحويل وإرسال الإيصال.');
    }

    /**
     * معالجة الدفع النقدي
     */
    private function handleCashPayment($payment, $course)
    {
        // بيانات الدفع النقدي
        $cash_data = [
            'office_address' => 'مكة المكرمة - حي العزيزية - شارع الملك عبدالله',
            'office_hours' => 'الأحد - الخميس: 8:00 ص - 4:00 م',
            'contact_phone' => '+966-12-1234567',
            'contact_email' => 'info@greenarrow.edu.sa',
            'required_documents' => [
                'الهوية الوطنية أو الإقامة',
                'رقم الفاتورة: ' . $payment->invoice_number,
                'مبلغ الدفع: ' . number_format($payment->total_amount, 2) . ' ريال'
            ]
        ];

        // تحديث حالة الدفع
        $payment->update([
            'status' => 'pending_confirmation',
            'payment_data' => [
                'cash_details' => $cash_data,
                'instructions' => [
                    'قم بزيارة مكتب الأكاديمية في العنوان المذكور',
                    'احضر الوثائق المطلوبة',
                    'ادفع المبلغ نقداً',
                    'ستحصل على إيصال رسمي',
                    'سيتم تفعيل حسابك فوراً بعد الدفع'
                ]
            ]
        ]);

        return redirect()->route('payment.cash', $payment->id)
            ->with('info', 'تم إنشاء طلب الدفع النقدي. يرجى زيارة مكتب الأكاديمية لإكمال الدفع.');
    }

    /**
     * إكمال الدفع وتفعيل التسجيل
     */
    private function completePayment($payment)
    {
        // تحديث حالة الدفع
        $payment->update([
            'status' => 'completed',
            'paid_at' => now(),
            'payment_data' => [
                'gateway' => 'simulated_gateway',
                'transaction_id' => 'TXN-' . strtoupper(substr(md5(uniqid()), 0, 12)),
                'completed_at' => now()->toISOString()
            ]
        ]);

        // تفعيل التسجيل
        $enrollment = $payment->enrollment;
        if ($enrollment) {
            $enrollment->update([
                'status' => 'active',
                'activated_at' => now()
            ]);
        }

        // إرسال إشعار للمستخدم
        // يمكن إضافة إرسال إيميل هنا
    }

    /**
     * صفحة نجاح الدفع
     */
    public function paymentSuccess(Payment $payment)
    {
        if (!Auth::check() || $payment->user_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'غير مصرح لك بالوصول لهذه الصفحة');
        }

        return view('payments.success', compact('payment'));
    }

    /**
     * صفحة إلغاء الدفع
     */
    public function paymentCancel(Payment $payment)
    {
        if (!Auth::check() || $payment->user_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'غير مصرح لك بالوصول لهذه الصفحة');
        }

        return view('payments.cancel', compact('payment'));
    }

    /**
     * تفاصيل التحويل البنكي
     */
    public function bankTransferDetails(Payment $payment)
    {
        if (!Auth::check() || $payment->user_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'غير مصرح لك بالوصول لهذه الصفحة');
        }

        return view('payments.bank-transfer', compact('payment'));
    }

    /**
     * تفاصيل الدفع النقدي
     */
    public function cashPaymentDetails(Payment $payment)
    {
        if (!Auth::check() || $payment->user_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'غير مصرح لك بالوصول لهذه الصفحة');
        }

        return view('payments.cash', compact('payment'));
    }

    /**
     * تأكيد الدفع (للمدير)
     */
    public function confirmPayment(Request $request, Payment $payment)
    {
        if (!Auth::check() || !Auth::user()->hasRole('admin')) {
            return redirect()->route('home')->with('error', 'غير مصرح لك بالوصول لهذه الصفحة');
        }

        $request->validate([
            'confirmation_code' => 'required|string',
        ]);

        // في التطبيق الحقيقي، هنا سيتم التحقق من رمز التأكيد
        if ($request->confirmation_code === 'CONFIRM123') {
            $this->completePayment($payment);
            return redirect()->back()->with('success', 'تم تأكيد الدفع بنجاح');
        }

        return redirect()->back()->with('error', 'رمز التأكيد غير صحيح');
    }

    /**
     * دروس الدورة (API)
     */
    public function apiLessons(Course $course)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // التحقق من تسجيل المستخدم في الدورة
        $enrollment = Auth::user()->enrollments()
            ->where('course_id', $course->id)
            ->where('status', 'active')
            ->first();

        if (!$enrollment) {
            return response()->json(['error' => 'Not enrolled'], 403);
        }

        $lessons = $course->lessons()
            ->published()
            ->ordered()
            ->select(['id', 'title_ar', 'title_en', 'type', 'duration_minutes', 'sort_order'])
            ->get();

        return response()->json($lessons);
    }
}
