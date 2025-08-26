@extends('layouts.app')

@section('title', 'خريطة الموقع - ' . config('app.name'))

@section('content')
<div class="page-header">
    <div class="container">
        <div class="page-header-content">
            <h1 class="page-title">خريطة الموقع</h1>
            <nav class="breadcrumb">
                <a href="{{ route('home') }}">الرئيسية</a>
                <span class="separator">/</span>
                <span class="current">خريطة الموقع</span>
            </nav>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="content-wrapper">
            <div class="sitemap-content">
                <div class="sitemap-intro">
                    <p>استكشف جميع صفحات موقعنا الإلكتروني من خلال هذه الخريطة الشاملة. ستجد روابط لجميع الأقسام والخدمات المتاحة.</p>
                </div>

                <div class="sitemap-section">
                    <h2><i class="bi bi-house"></i> الصفحة الرئيسية</h2>
                    <ul>
                        <li><a href="{{ route('home') }}">الرئيسية</a></li>
                        <li><a href="{{ route('about') }}">من نحن</a></li>
                        <li><a href="{{ route('contact') }}">اتصل بنا</a></li>
                    </ul>
                </div>

                <div class="sitemap-section">
                    <h2><i class="bi bi-book"></i> الدورات التعليمية</h2>
                    <ul>
                        <li><a href="{{ route('courses') }}">جميع الدورات</a></li>
                        <li><a href="{{ route('courses') }}?category=programming">دورات البرمجة</a></li>
                        <li><a href="{{ route('courses') }}?category=design">دورات التصميم</a></li>
                        <li><a href="{{ route('courses') }}?category=marketing">دورات التسويق</a></li>
                        <li><a href="{{ route('courses') }}?category=business">دورات الأعمال</a></li>
                    </ul>
                </div>

                <div class="sitemap-section">
                    <h2><i class="bi bi-person-workspace"></i> المعلمون</h2>
                    <ul>
                        <li><a href="{{ route('instructors') }}">جميع المعلمين</a></li>
                        <li><a href="{{ route('instructors') }}?specialty=programming">معلمو البرمجة</a></li>
                        <li><a href="{{ route('instructors') }}?specialty=design">معلمو التصميم</a></li>
                        <li><a href="{{ route('instructors') }}?specialty=marketing">معلمو التسويق</a></li>
                    </ul>
                </div>

                <div class="sitemap-section">
                    <h2><i class="bi bi-newspaper"></i> المدونة</h2>
                    <ul>
                        <li><a href="{{ route('blog') }}">المدونة</a></li>
                        <li><a href="{{ route('blog') }}?category=technology">تقنية</a></li>
                        <li><a href="{{ route('blog') }}?category=education">تعليم</a></li>
                        <li><a href="{{ route('blog') }}?category=tips">نصائح</a></li>
                    </ul>
                </div>

                <div class="sitemap-section">
                    <h2><i class="bi bi-person"></i> حسابات المستخدمين</h2>
                    <ul>
                        <li><a href="{{ route('login') }}">تسجيل الدخول</a></li>
                        <li><a href="{{ route('register') }}">إنشاء حساب جديد</a></li>
                        <li><a href="{{ route('password.request') }}">نسيت كلمة المرور</a></li>
                    </ul>
                </div>

                <div class="sitemap-section">
                    <h2><i class="bi bi-graduation-cap"></i> لوحة الطالب</h2>
                    <ul>
                        <li><a href="{{ route('student.dashboard') }}">لوحة التحكم</a></li>
                        <li><a href="{{ route('student.courses.index') }}">دوراتي</a></li>
                        <li><a href="{{ route('student.lessons.index') }}">الدروس</a></li>
                        <li><a href="{{ route('student.progress.index') }}">التقدم</a></li>
                        <li><a href="{{ route('student.certificates.index') }}">الشهادات</a></li>
                        <li><a href="{{ route('student.profile.edit') }}">الملف الشخصي</a></li>
                        <li><a href="{{ route('student.settings.index') }}">الإعدادات</a></li>
                    </ul>
                </div>

                <div class="sitemap-section">
                    <h2><i class="bi bi-person-badge"></i> لوحة المعلم</h2>
                    <ul>
                        <li><a href="{{ route('teacher.dashboard') }}">لوحة التحكم</a></li>
                        <li><a href="{{ route('teacher.courses.index') }}">دوراتي</a></li>
                        <li><a href="{{ route('teacher.courses.create') }}">إنشاء دورة جديدة</a></li>
                        <li><a href="{{ route('teacher.lessons.index') }}">الدروس</a></li>
                        <li><a href="{{ route('teacher.enrollments.index') }}">الطلاب المسجلين</a></li>
                        <li><a href="{{ route('teacher.analytics.index') }}">التحليلات</a></li>
                        <li><a href="{{ route('teacher.reports.index') }}">التقارير</a></li>
                        <li><a href="{{ route('teacher.profile.index') }}">الملف الشخصي</a></li>
                        <li><a href="{{ route('teacher.settings.index') }}">الإعدادات</a></li>
                    </ul>
                </div>

                <div class="sitemap-section">
                    <h2><i class="bi bi-gear"></i> لوحة الإدارة</h2>
                    <ul>
                        <li><a href="{{ route('admin.dashboard') }}">لوحة التحكم</a></li>
                        <li><a href="{{ route('admin.users.index') }}">المستخدمين</a></li>
                        <li><a href="{{ route('admin.courses.index') }}">الدورات</a></li>
                        <li><a href="{{ route('admin.categories.index') }}">التصنيفات</a></li>
                        <li><a href="{{ route('admin.instructors.index') }}">المعلمين</a></li>
                        <li><a href="{{ route('admin.students.index') }}">الطلاب</a></li>
                        <li><a href="{{ route('admin.payments.index') }}">المدفوعات</a></li>
                        <li><a href="{{ route('admin.blog.index') }}">المدونة</a></li>
                        <li><a href="{{ route('admin.contact.index') }}">رسائل الاتصال</a></li>
                        <li><a href="{{ route('admin.notifications.index') }}">الإشعارات</a></li>
                        <li><a href="{{ route('admin.settings') }}">الإعدادات</a></li>
                        <li><a href="{{ route('admin.reports') }}">التقارير</a></li>
                        <li><a href="{{ route('admin.seo') }}">تحسين محركات البحث</a></li>
                    </ul>
                </div>

                <div class="sitemap-section">
                    <h2><i class="bi bi-shield-check"></i> الشروط والسياسات</h2>
                    <ul>
                        <li><a href="{{ route('privacy-policy') }}">سياسة الخصوصية</a></li>
                        <li><a href="{{ route('terms-of-service') }}">شروط الاستخدام</a></li>
                        <li><a href="{{ route('sitemap') }}">خريطة الموقع</a></li>
                    </ul>
                </div>

                <div class="sitemap-section">
                    <h2><i class="bi bi-info-circle"></i> معلومات إضافية</h2>
                    <ul>
                        <li><a href="{{ route('home') }}#features">المميزات</a></li>
                        <li><a href="{{ route('home') }}#testimonials">آراء الطلاب</a></li>
                        <li><a href="{{ route('home') }}#faq">الأسئلة الشائعة</a></li>
                        <li><a href="{{ route('home') }}#contact">معلومات الاتصال</a></li>
                    </ul>
                </div>

                <div class="sitemap-footer">
                    <div class="search-box">
                        <h3>البحث في الموقع</h3>
                        <form action="{{ route('home') }}" method="GET" class="search-form">
                            <input type="text" name="search" placeholder="ابحث في الموقع..." class="search-input">
                            <button type="submit" class="search-btn">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>
                    </div>
                    
                    <div class="contact-info">
                        <h3>معلومات الاتصال</h3>
                        <p><i class="bi bi-envelope"></i> greenarrowacademy@gmail.com</p>
                        <p><i class="bi bi-telephone"></i> +966 50 826 0274</p>
                        <p><i class="bi bi-geo-alt"></i> المملكة العربية السعودية</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.page-header {
    background: linear-gradient(135deg, #10b981 0%, #1f2937 100%);
    color: white;
    padding: 60px 0;
    margin-bottom: 40px;
}

.page-header-content {
    text-align: center;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 15px;
}

.breadcrumb {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    font-size: 0.9rem;
}

.breadcrumb a {
    color: #f59e0b;
    text-decoration: none;
    transition: color 0.3s ease;
}

.breadcrumb a:hover {
    color: #fbbf24;
}

.separator {
    color: #9ca3af;
}

.current {
    color: #d1d5db;
}

.content-wrapper {
    max-width: 1000px;
    margin: 0 auto;
    padding: 0 20px;
}

.sitemap-content {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 40px;
}

.sitemap-intro {
    text-align: center;
    margin-bottom: 40px;
    padding-bottom: 20px;
    border-bottom: 2px solid #e5e7eb;
}

.sitemap-intro p {
    color: #6b7280;
    font-size: 1.1rem;
    line-height: 1.6;
}

.sitemap-section {
    margin-bottom: 30px;
    padding: 20px;
    background: #f9fafb;
    border-radius: 8px;
    border-left: 4px solid #10b981;
}

.sitemap-section h2 {
    color: #1f2937;
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.sitemap-section h2 i {
    color: #10b981;
    font-size: 1.2rem;
}

.sitemap-section ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 10px;
}

.sitemap-section li {
    margin-bottom: 8px;
}

.sitemap-section a {
    color: #374151;
    text-decoration: none;
    padding: 8px 12px;
    border-radius: 6px;
    transition: all 0.3s ease;
    display: block;
}

.sitemap-section a:hover {
    background: #10b981;
    color: white;
    transform: translateX(5px);
}

.sitemap-footer {
    margin-top: 40px;
    padding-top: 30px;
    border-top: 2px solid #e5e7eb;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
}

.search-box h3,
.contact-info h3 {
    color: #1f2937;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 15px;
}

.search-form {
    display: flex;
    gap: 10px;
}

.search-input {
    flex: 1;
    padding: 12px 16px;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

.search-input:focus {
    outline: none;
    border-color: #10b981;
}

.search-btn {
    padding: 12px 16px;
    background: #10b981;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.search-btn:hover {
    background: #059669;
}

.contact-info p {
    color: #4b5563;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.contact-info i {
    color: #10b981;
    width: 20px;
}

@media (max-width: 768px) {
    .page-title {
        font-size: 2rem;
    }
    
    .sitemap-content {
        padding: 20px;
    }
    
    .sitemap-section ul {
        grid-template-columns: 1fr;
    }
    
    .sitemap-footer {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .search-form {
        flex-direction: column;
    }
}
</style>
@endsection 