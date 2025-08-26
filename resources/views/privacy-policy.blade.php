@extends('layouts.app')

@section('title', 'سياسة الخصوصية - ' . config('app.name'))

@section('content')
<div class="page-header">
    <div class="container">
        <div class="page-header-content">
            <h1 class="page-title">سياسة الخصوصية</h1>
            <nav class="breadcrumb">
                <a href="{{ route('home') }}">الرئيسية</a>
                <span class="separator">/</span>
                <span class="current">سياسة الخصوصية</span>
            </nav>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="content-wrapper">
            <div class="policy-content">
                <div class="policy-section">
                    <h2>مقدمة</h2>
                    <p>نحن في منصة السهم الأخضر التعليمية نلتزم بحماية خصوصية مستخدمينا. تشرح هذه السياسة كيفية جمع واستخدام وحماية المعلومات الشخصية التي تقدمها لنا عند استخدام موقعنا الإلكتروني.</p>
                </div>

                <div class="policy-section">
                    <h2>المعلومات التي نجمعها</h2>
                    <h3>المعلومات الشخصية</h3>
                    <ul>
                        <li>الاسم الكامل</li>
                        <li>عنوان البريد الإلكتروني</li>
                        <li>رقم الهاتف</li>
                        <li>تاريخ الميلاد</li>
                        <li>الجنس</li>
                        <li>البلد</li>
                    </ul>

                    <h3>معلومات الحساب</h3>
                    <ul>
                        <li>اسم المستخدم</li>
                        <li>كلمة المرور (مشفرة)</li>
                        <li>صورة الملف الشخصي</li>
                        <li>تفضيلات الحساب</li>
                    </ul>

                    <h3>معلومات الاستخدام</h3>
                    <ul>
                        <li>تاريخ وآخر تسجيل دخول</li>
                        <li>الدورات المسجلة</li>
                        <li>التقدم في التعلم</li>
                        <li>التقييمات والمراجعات</li>
                        <li>المدفوعات والمعاملات</li>
                    </ul>
                </div>

                <div class="policy-section">
                    <h2>كيفية استخدام المعلومات</h2>
                    <p>نستخدم المعلومات التي نجمعها للأغراض التالية:</p>
                    <ul>
                        <li>إنشاء وإدارة حسابك</li>
                        <li>تقديم الخدمات التعليمية</li>
                        <li>معالجة المدفوعات</li>
                        <li>إرسال إشعارات مهمة</li>
                        <li>تحسين تجربة المستخدم</li>
                        <li>تقديم الدعم الفني</li>
                        <li>إرسال رسائل تسويقية (بموافقتك)</li>
                    </ul>
                </div>

                <div class="policy-section">
                    <h2>مشاركة المعلومات</h2>
                    <p>نحن لا نبيع أو نؤجر أو نشارك معلوماتك الشخصية مع أطراف ثالثة إلا في الحالات التالية:</p>
                    <ul>
                        <li>بموافقتك الصريحة</li>
                        <li>لتقديم الخدمات المطلوبة (مثل معالجة المدفوعات)</li>
                        <li>للامتثال للقوانين والأنظمة</li>
                        <li>لحماية حقوقنا وممتلكاتنا</li>
                        <li>في حالة الاندماج أو الاستحواذ</li>
                    </ul>
                </div>

                <div class="policy-section">
                    <h2>حماية المعلومات</h2>
                    <p>نحن نستخدم تقنيات تشفير متقدمة لحماية معلوماتك الشخصية:</p>
                    <ul>
                        <li>تشفير SSL/TLS لجميع البيانات المنقولة</li>
                        <li>تخزين آمن لكلمات المرور</li>
                        <li>مراقبة مستمرة للأنظمة</li>
                        <li>نسخ احتياطية منتظمة</li>
                        <li>وصول مقيد للموظفين المصرح لهم</li>
                    </ul>
                </div>

                <div class="policy-section">
                    <h2>ملفات تعريف الارتباط (Cookies)</h2>
                    <p>نستخدم ملفات تعريف الارتباط لتحسين تجربتك على موقعنا:</p>
                    <ul>
                        <li><strong>ملفات تعريف الارتباط الأساسية:</strong> ضرورية لعمل الموقع</li>
                        <li><strong>ملفات تعريف الارتباط الوظيفية:</strong> لتحسين الأداء</li>
                        <li><strong>ملفات تعريف الارتباط التحليلية:</strong> لفهم كيفية استخدام الموقع</li>
                        <li><strong>ملفات تعريف الارتباط التسويقية:</strong> لعرض إعلانات مخصصة</li>
                    </ul>
                </div>

                <div class="policy-section">
                    <h2>حقوقك</h2>
                    <p>لديك الحق في:</p>
                    <ul>
                        <li>الوصول إلى معلوماتك الشخصية</li>
                        <li>تصحيح المعلومات غير الدقيقة</li>
                        <li>حذف حسابك</li>
                        <li>تصدير بياناتك</li>
                        <li>الانسحاب من الرسائل التسويقية</li>
                        <li>تقديم شكوى إلى السلطات المختصة</li>
                    </ul>
                </div>

                <div class="policy-section">
                    <h2>التغييرات على السياسة</h2>
                    <p>قد نقوم بتحديث هذه السياسة من وقت لآخر. سنقوم بإشعارك بأي تغييرات جوهرية عبر البريد الإلكتروني أو من خلال إشعار على موقعنا.</p>
                </div>

                <div class="policy-section">
                    <h2>التواصل معنا</h2>
                    <p>إذا كان لديك أي أسئلة حول سياسة الخصوصية، يمكنك التواصل معنا:</p>
                    <div class="contact-info">
                        <p><strong>البريد الإلكتروني:</strong> privacy@greenarrowacademy.com</p>
                        <p><strong>الهاتف:</strong> +966 50 826 0274</p>
                        <p><strong>العنوان:</strong> المملكة العربية السعودية</p>
                    </div>
                </div>

                <div class="policy-section">
                    <p class="last-updated">آخر تحديث: {{ date('Y-m-d') }}</p>
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
    max-width: 800px;
    margin: 0 auto;
    padding: 0 20px;
}

.policy-content {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 40px;
    line-height: 1.7;
}

.policy-section {
    margin-bottom: 30px;
}

.policy-section h2 {
    color: #1f2937;
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 2px solid #e5e7eb;
}

.policy-section h3 {
    color: #374151;
    font-size: 1.2rem;
    font-weight: 600;
    margin: 20px 0 10px 0;
}

.policy-section p {
    color: #4b5563;
    margin-bottom: 15px;
}

.policy-section ul {
    color: #4b5563;
    margin: 15px 0;
    padding-left: 20px;
}

.policy-section li {
    margin-bottom: 8px;
}

.contact-info {
    background: #f9fafb;
    padding: 20px;
    border-radius: 8px;
    border-left: 4px solid #10b981;
}

.contact-info p {
    margin-bottom: 8px;
}

.last-updated {
    text-align: center;
    color: #6b7280;
    font-style: italic;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #e5e7eb;
}

@media (max-width: 768px) {
    .page-title {
        font-size: 2rem;
    }
    
    .policy-content {
        padding: 20px;
    }
    
    .policy-section h2 {
        font-size: 1.3rem;
    }
}
</style>
@endsection 