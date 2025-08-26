@extends('layouts.app')

@section('title', 'شروط الاستخدام - ' . config('app.name'))

@section('content')
<div class="page-header">
    <div class="container">
        <div class="page-header-content">
            <h1 class="page-title">شروط الاستخدام</h1>
            <nav class="breadcrumb">
                <a href="{{ route('home') }}">الرئيسية</a>
                <span class="separator">/</span>
                <span class="current">شروط الاستخدام</span>
            </nav>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="content-wrapper">
            <div class="terms-content">
                <div class="terms-section">
                    <h2>مقدمة</h2>
                    <p>مرحباً بك في منصة السهم الأخضر التعليمية. باستخدام موقعنا الإلكتروني وخدماتنا، فإنك توافق على الالتزام بهذه الشروط والأحكام. يرجى قراءة هذه الشروط بعناية قبل استخدام خدماتنا.</p>
                </div>

                <div class="terms-section">
                    <h2>تعريف المصطلحات</h2>
                    <ul>
                        <li><strong>"المنصة" أو "الموقع":</strong> منصة السهم الأخضر التعليمية</li>
                        <li><strong>"المستخدم":</strong> أي شخص يستخدم خدمات المنصة</li>
                        <li><strong>"الطالب":</strong> المستخدم المسجل في الدورات التعليمية</li>
                        <li><strong>"المعلم":</strong> المستخدم الذي يقدم المحتوى التعليمي</li>
                        <li><strong>"الدورة":</strong> المحتوى التعليمي المقدم على المنصة</li>
                        <li><strong>"الخدمات":</strong> جميع الخدمات المقدمة من خلال المنصة</li>
                    </ul>
                </div>

                <div class="terms-section">
                    <h2>شروط التسجيل والحساب</h2>
                    <h3>إنشاء الحساب</h3>
                    <ul>
                        <li>يجب أن تكون عمرك 13 عاماً أو أكثر لإنشاء حساب</li>
                        <li>يجب تقديم معلومات دقيقة وصحيحة</li>
                        <li>أنت مسؤول عن الحفاظ على سرية كلمة المرور</li>
                        <li>يجب إخطارنا فوراً بأي استخدام غير مصرح به لحسابك</li>
                    </ul>

                    <h3>استخدام الحساب</h3>
                    <ul>
                        <li>لا يمكنك مشاركة حسابك مع الآخرين</li>
                        <li>أنت مسؤول عن جميع الأنشطة التي تتم من خلال حسابك</li>
                        <li>يحق لنا تعليق أو إغلاق الحساب في حالة انتهاك الشروط</li>
                    </ul>
                </div>

                <div class="terms-section">
                    <h2>قواعد السلوك</h2>
                    <p>يجب على جميع المستخدمين الالتزام بالقواعد التالية:</p>
                    
                    <h3>ما هو مسموح به:</h3>
                    <ul>
                        <li>التعلم والمشاركة في الدورات باحترام</li>
                        <li>طرح الأسئلة والمناقشات البناءة</li>
                        <li>تقديم تعليقات مفيدة ومراجعات صادقة</li>
                        <li>مشاركة المعرفة والخبرات بشكل إيجابي</li>
                    </ul>

                    <h3>ما هو ممنوع:</h3>
                    <ul>
                        <li>إرسال محتوى مسيء أو غير لائق</li>
                        <li>التحرش أو الإساءة للمستخدمين الآخرين</li>
                        <li>نشر معلومات كاذبة أو مضللة</li>
                        <li>انتهاك حقوق الملكية الفكرية</li>
                        <li>محاولة اختراق النظام أو إلحاق الضرر به</li>
                        <li>استخدام المنصة لأغراض تجارية غير مصرح بها</li>
                        <li>نشر روابط ضارة أو برامج خبيثة</li>
                    </ul>
                </div>

                <div class="terms-section">
                    <h2>المحتوى التعليمي</h2>
                    <h3>حقوق الملكية</h3>
                    <ul>
                        <li>جميع المحتوى التعليمي محمي بحقوق الملكية الفكرية</li>
                        <li>لا يمكن نسخ أو توزيع المحتوى بدون إذن</li>
                        <li>يحق للمعلمين الاحتفاظ بحقوق محتواهم</li>
                        <li>يجب احترام حقوق الملكية الفكرية للآخرين</li>
                    </ul>

                    <h3>جودة المحتوى</h3>
                    <ul>
                        <li>نحن نسعى لتقديم محتوى عالي الجودة</li>
                        <li>لا نضمن دقة أو اكتمال جميع المعلومات</li>
                        <li>يجب التحقق من المعلومات من مصادر موثوقة</li>
                        <li>نرحب بتقارير المحتوى غير المناسب</li>
                    </ul>
                </div>

                <div class="terms-section">
                    <h2>المدفوعات والاشتراكات</h2>
                    <h3>الأسعار والمدفوعات</h3>
                    <ul>
                        <li>جميع الأسعار بالريال السعودي</li>
                        <li>الأسعار قابلة للتغيير مع إشعار مسبق</li>
                        <li>يجب دفع الرسوم كاملة قبل الوصول للمحتوى</li>
                        <li>نقبل طرق الدفع المعتمدة فقط</li>
                    </ul>

                    <h3>الاسترداد والإلغاء</h3>
                    <ul>
                        <li>يمكن طلب استرداد خلال 7 أيام من الشراء</li>
                        <li>لا يتم الاسترداد بعد مشاهدة أكثر من 30% من المحتوى</li>
                        <li>الاشتراكات الشهرية قابلة للإلغاء في أي وقت</li>
                        <li>لا يتم استرداد الرسوم في حالة انتهاك الشروط</li>
                    </ul>
                </div>

                <div class="terms-section">
                    <h2>الخصوصية والأمان</h2>
                    <ul>
                        <li>نحن نحمي خصوصية مستخدمينا وفقاً لسياسة الخصوصية</li>
                        <li>نستخدم تقنيات تشفير لحماية البيانات</li>
                        <li>لا نشارك معلوماتك الشخصية مع أطراف ثالثة بدون موافقتك</li>
                        <li>أنت مسؤول عن الحفاظ على أمان جهازك واتصالك بالإنترنت</li>
                    </ul>
                </div>

                <div class="terms-section">
                    <h2>الحد من المسؤولية</h2>
                    <p>في الحد الأقصى المسموح به بموجب القانون:</p>
                    <ul>
                        <li>لا نتحمل مسؤولية عن أي أضرار مباشرة أو غير مباشرة</li>
                        <li>لا نضمن عدم انقطاع الخدمة أو خلوها من الأخطاء</li>
                        <li>لا نتحمل مسؤولية عن المحتوى الذي ينشئه المستخدمون</li>
                        <li>مسؤوليتنا محدودة بمبلغ الرسوم المدفوعة</li>
                    </ul>
                </div>

                <div class="terms-section">
                    <h2>إنهاء الخدمة</h2>
                    <p>يمكن إنهاء استخدام الخدمات في الحالات التالية:</p>
                    <ul>
                        <li>انتهاك هذه الشروط والأحكام</li>
                        <li>عدم دفع الرسوم المطلوبة</li>
                        <li>إغلاق المنصة نهائياً</li>
                        <li>طلب المستخدم إغلاق حسابه</li>
                    </ul>
                </div>

                <div class="terms-section">
                    <h2>التغييرات على الشروط</h2>
                    <p>نحتفظ بالحق في تعديل هذه الشروط في أي وقت. سيتم إشعارك بالتغييرات الجوهرية عبر:</p>
                    <ul>
                        <li>البريد الإلكتروني</li>
                        <li>إشعار على الموقع</li>
                        <li>نشر الشروط المحدثة</li>
                    </ul>
                    <p>استمرارك في استخدام الخدمات بعد التغييرات يعني موافقتك على الشروط الجديدة.</p>
                </div>

                <div class="terms-section">
                    <h2>القانون المطبق</h2>
                    <p>تخضع هذه الشروط لقوانين المملكة العربية السعودية. أي نزاعات سيتم حلها في المحاكم المختصة في المملكة.</p>
                </div>

                <div class="terms-section">
                    <h2>التواصل معنا</h2>
                    <p>إذا كان لديك أي أسئلة حول هذه الشروط، يمكنك التواصل معنا:</p>
                    <div class="contact-info">
                        <p><strong>البريد الإلكتروني:</strong> legal@greenarrowacademy.com</p>
                        <p><strong>الهاتف:</strong> +966 50 826 0274</p>
                        <p><strong>العنوان:</strong> المملكة العربية السعودية</p>
                    </div>
                </div>

                <div class="terms-section">
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

.terms-content {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 40px;
    line-height: 1.7;
}

.terms-section {
    margin-bottom: 30px;
}

.terms-section h2 {
    color: #1f2937;
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 2px solid #e5e7eb;
}

.terms-section h3 {
    color: #374151;
    font-size: 1.2rem;
    font-weight: 600;
    margin: 20px 0 10px 0;
}

.terms-section p {
    color: #4b5563;
    margin-bottom: 15px;
}

.terms-section ul {
    color: #4b5563;
    margin: 15px 0;
    padding-left: 20px;
}

.terms-section li {
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
    
    .terms-content {
        padding: 20px;
    }
    
    .terms-section h2 {
        font-size: 1.3rem;
    }
}
</style>
@endsection 