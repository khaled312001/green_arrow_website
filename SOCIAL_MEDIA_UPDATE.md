# تحديث روابط التواصل الاجتماعي - أكاديمية السهم الأخضر

## نظرة عامة
تم تحديث النظام ليشمل جميع روابط التواصل الاجتماعي الخاصة بأكاديمية السهم الأخضر للتدريب مع إضافة واجهة إدارة متكاملة.

## الروابط المضافة

### وسائل التواصل الاجتماعي
- **فيسبوك**: https://www.facebook.com/people/أكاديمية-السهم-الأخضر-للتدريب/61571521234103/
- **تويتر (X)**: https://x.com/greenarrowac
- **انستغرام**: https://www.instagram.com/greenarrowacademy/
- **يوتيوب**: https://www.youtube.com/@أكاديميةالسهمالأخضر
- **لينكد إن**: https://www.linkedin.com/company/شركة-أكاديمية-السهم-الأخضر-للتد/
- **تيك توك**: https://www.tiktok.com/@green.arrow645
- **تليجرام**: https://t.me/greenarrowac
- **سناب شات**: https://www.snapchat.com/@elsahmacademic

### معلومات التواصل
- **البريد الإلكتروني**: greenarrowacademic@gmail.com
- **الهاتف**: +966 50 826 0274
- **الواتساب**: +966 50 826 0274
- **العنوان**: مكة المكرمة - حي الخضراء - الشارع العام - مقابل قاعة البساتين للأفراح
- **خرائط جوجل**: رابط موقع الأكاديمية على خرائط جوجل

## الميزات الجديدة

### 1. نظام الإعدادات المحسن
- إضافة جميع روابط التواصل الاجتماعي إلى قاعدة البيانات
- إمكانية تعديل الروابط من لوحة الإدارة
- تحديث تلقائي للأيقونات في الموقع

### 2. Helper Functions
تم إضافة functions جديدة في `app/helpers.php`:
- `get_social_links()`: الحصول على جميع الروابط
- `get_active_social_links()`: الحصول على الروابط المفعلة فقط
- `render_social_icons()`: عرض أيقونات التواصل الاجتماعي

### 3. Blade Component
تم إنشاء component جديد `SocialIcons`:
- يمكن استخدامه في أي مكان في الموقع
- يدعم تخصيص الحجم والألوان
- يعرض الروابط المفعلة فقط

### 4. صفحة التواصل المحسنة
- عرض جميع معلومات التواصل
- عرض جميع روابط التواصل الاجتماعي
- تصميم حديث ومتجاوب

### 5. لوحة الإدارة
- صفحة خاصة لإدارة روابط التواصل الاجتماعي
- إحصائيات سريعة
- معاينة مباشرة للأيقونات
- رابط سريع لتعديل الإعدادات

## كيفية الاستخدام

### في الموقع
```php
// عرض أيقونات التواصل الاجتماعي
<x-social-icons />

// مع تخصيص
<x-social-icons size="fs-4" :show-labels="true" container-class="d-flex gap-3" />
```

### في الكود
```php
// الحصول على جميع الروابط
$allLinks = get_social_links();

// الحصول على الروابط المفعلة فقط
$activeLinks = get_active_social_links();

// عرض الأيقونات
echo render_social_icons('fs-4', false, 'd-flex gap-2');
```

### في لوحة الإدارة
1. انتقل إلى "الإعدادات" > "روابط التواصل الاجتماعي"
2. أو انتقل مباشرة إلى "روابط التواصل الاجتماعي"
3. يمكنك تعديل الروابط من صفحة الإعدادات

## التحديثات التقنية

### قاعدة البيانات
- تم تحديث جدول `settings` بجميع الروابط الجديدة
- تم إنشاء seeder `UpdateSocialMediaSettingsSeeder`

### الملفات المحدثة
- `app/Models/Setting.php` - تحديث الإعدادات الافتراضية
- `app/helpers.php` - إضافة helper functions
- `app/View/Components/SocialIcons.php` - component جديد
- `resources/views/components/social-icons.blade.php` - view للـ component
- `resources/views/layouts/app.blade.php` - تحديث التذييل
- `resources/views/contact.blade.php` - صفحة التواصل المحسنة
- `resources/views/admin/settings/partials/social.blade.php` - إعدادات التواصل الاجتماعي
- `resources/views/admin/settings/partials/general.blade.php` - إضافة رقم الواتساب
- `app/Http/Controllers/ContactController.php` - controller جديد
- `app/Http/Controllers/Admin/AdminController.php` - إضافة صفحة روابط التواصل الاجتماعي
- `resources/views/admin/social-links.blade.php` - صفحة إدارة الروابط
- `routes/web.php` - إضافة routes جديدة

### Routes الجديدة
- `GET /contact` - صفحة التواصل
- `GET /admin/social-links` - صفحة إدارة روابط التواصل الاجتماعي

## الأيقونات المستخدمة
- فيسبوك: `bi-facebook`
- تويتر: `bi-twitter-x`
- انستغرام: `bi-instagram`
- يوتيوب: `bi-youtube`
- لينكد إن: `bi-linkedin`
- تيك توك: `bi-tiktok`
- تليجرام: `bi-telegram`
- سناب شات: `bi-snapchat`
- خرائط جوجل: `bi-geo-alt`
- واتساب: `bi-whatsapp`
- البريد الإلكتروني: `bi-envelope`
- الهاتف: `bi-telephone`

## الألوان المستخدمة
- فيسبوك: `text-primary`
- تويتر: `text-dark`
- انستغرام: `text-danger`
- يوتيوب: `text-danger`
- لينكد إن: `text-primary`
- تيك توك: `text-dark`
- تليجرام: `text-primary`
- سناب شات: `text-warning`
- خرائط جوجل: `text-success`
- واتساب: `text-success`
- البريد الإلكتروني: `text-info`
- الهاتف: `text-success`

## ملاحظات مهمة
1. جميع الروابط تفتح في نافذة جديدة
2. يتم عرض الروابط المفعلة فقط في الموقع
3. يمكن تعديل الروابط من لوحة الإدارة
4. يتم تحديث الأيقونات تلقائياً عند تغيير الإعدادات
5. جميع الروابط تدعم SEO وتحسين محركات البحث

## التطوير المستقبلي
- إضافة إحصائيات النقرات على الروابط
- إضافة جدولة للمنشورات
- إضافة تكامل مع APIs منصات التواصل الاجتماعي
- إضافة تحليلات تفاعل المستخدمين 