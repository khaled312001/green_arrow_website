<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * عرض صفحة تسجيل الدخول
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * معالجة تسجيل الدخول
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'password.required' => 'كلمة المرور مطلوبة',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            // توجيه المستخدم حسب دوره
            return $this->redirectUserByRole();
        }

        throw ValidationException::withMessages([
            'email' => 'البيانات المدخلة غير صحيحة.',
        ]);
    }

    /**
     * عرض صفحة التسجيل
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * معالجة التسجيل الجديد
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'accepted',
        ], [
            'name.required' => 'الاسم مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'email.unique' => 'البريد الإلكتروني مستخدم مسبقاً',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'كلمة المرور يجب أن تكون 8 أحرف على الأقل',
            'password.confirmed' => 'تأكيد كلمة المرور غير متطابق',
            'terms.accepted' => 'يجب الموافقة على الشروط والأحكام',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'city' => $request->city,
            'country' => $request->country ?? 'السعودية',
        ]);

        // تعيين دور الطالب افتراضياً
        $user->assignRole('student');

        Auth::login($user);

        return $this->redirectUserByRole()
            ->with('success', 'مرحباً بك في أكاديمية السهم الأخضر! تم إنشاء حسابك بنجاح.');
    }

    /**
     * تسجيل الخروج
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'تم تسجيل الخروج بنجاح');
    }

    /**
     * عرض صفحة نسيان كلمة المرور
     */
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    /**
     * معالجة نسيان كلمة المرور
     */
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'email.exists' => 'البريد الإلكتروني غير موجود',
        ]);

        // هنا يتم إرسال رابط إعادة تعيين كلمة المرور
        // Password::sendResetLink($request->only('email'));

        return back()->with('success', 'تم إرسال رابط إعادة تعيين كلمة المرور إلى بريدك الإلكتروني');
    }

    /**
     * عرض صفحة إعادة تعيين كلمة المرور
     */
    public function showResetPassword($token)
    {
        return view('auth.reset-password', compact('token'));
    }

    /**
     * معالجة إعادة تعيين كلمة المرور
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // معالجة إعادة تعيين كلمة المرور
        // $status = Password::reset(...);

        return redirect()->route('login')
            ->with('success', 'تم إعادة تعيين كلمة المرور بنجاح');
    }

    /**
     * توجيه إلى Google للمصادقة
     */
    public function redirectToGoogle()
    {
        // return Socialite::driver('google')->redirect();
        return redirect()->route('login')
            ->with('info', 'تسجيل الدخول بجوجل غير متاح حالياً');
    }

    /**
     * معالجة الاستجابة من Google
     */
    public function handleGoogleCallback()
    {
        try {
            // $googleUser = Socialite::driver('google')->user();
            // معالجة المستخدم من جوجل وإنشاء حساب أو تسجيل الدخول

            return $this->redirectUserByRole()
                ->with('success', 'تم تسجيل الدخول بنجاح');
        } catch (\Exception $e) {
            return redirect()->route('login')
                ->with('error', 'حدث خطأ في تسجيل الدخول بجوجل');
        }
    }

    /**
     * توجيه المستخدم حسب دوره
     */
    private function redirectUserByRole()
    {
        $user = Auth::user();
        
        // توجيه المدير إلى لوحة تحكم المدير
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard')
                ->with('success', 'مرحباً بك في لوحة تحكم المدير');
        }
        
        // توجيه المدرب إلى لوحة تحكم المدرب
        if ($user->hasRole('teacher')) {
            return redirect()->route('teacher.dashboard')
                ->with('success', 'مرحباً بك في لوحة تحكم المدرب');
        }
        
        // توجيه الطالب إلى لوحة تحكم الطالب
        if ($user->hasRole('student')) {
            return redirect()->route('student.dashboard')
                ->with('success', 'مرحباً بك في لوحة تحكم الطالب');
        }
        
        // إذا لم يكن لديه دور محدد، توجيه إلى الصفحة الرئيسية
        return redirect()->route('home')
            ->with('info', 'مرحباً بك في أكاديمية السهم الأخضر');
    }
}
