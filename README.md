# تحديثات روابط التواصل الاجتماعي - أكاديمية السهم الأخضر للتدريب

## ملخص التحديثات

تم إضافة مجموعة شاملة من روابط التواصل الاجتماعي ومعلومات الاتصال لأكاديمية السهم الأخضر للتدريب في النظام.

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
- **خرائط جوجل**: https://maps.app.goo.gl/CXC1FCGzbcHgN1oN6

### معلومات التواصل
- **البريد الإلكتروني**: greenarrowacademic@gmail.com
- **الهاتف**: +966 50 826 0274
- **الواتساب**: +966 50 826 0274
- **العنوان**: الشارع العام، الخضراء، مكة المكرمة - حي الشرائع، مكة 24267
- **ساعات العمل**: الأحد - الخميس: 8:00 ص - 6:00 م

## الميزات الجديدة

### 1. نظام إعدادات محسن
- جميع الروابط مخزنة في قاعدة البيانات
- إمكانية التعديل من لوحة الإدارة
- تحديث فوري للعرض في الموقع

### 2. Helper Functions
- `setting($key, $default = null)`: استرجاع قيمة إعداد
- `get_social_links()`: الحصول على جميع روابط التواصل الاجتماعي
- `get_active_social_links()`: الحصول على الروابط النشطة فقط
- `render_social_icons()`: عرض أيقونات التواصل الاجتماعي

### 3. Blade Component للأيقونات
- مكون قابل لإعادة الاستخدام
- دعم للألوان والأحجام المختلفة
- إمكانية إظهار/إخفاء النصوص

### 4. صفحة تواصل محسنة
- عرض جميع معلومات الاتصال
- روابط مباشرة للخرائط والواتساب
- عرض جميع روابط التواصل الاجتماعي النشطة

### 5. لوحة إدارة متكاملة
- صفحة خاصة لإدارة الروابط
- إحصائيات الروابط النشطة
- روابط سريعة للتعديل

## التحديثات التقنية

### الملفات المحدثة/المضافة

#### 1. قاعدة البيانات
- **Migration**: `2025_08_24_123811_create_settings_table.php`
- **Model**: `app/Models/Setting.php`
- **Seeder**: `database/seeders/UpdateSocialMediaSettingsSeeder.php`

#### 2. Helper Functions
- **File**: `app/helpers.php` (جديد)

#### 3. Controllers
- **AdminController**: إضافة method `socialLinks()`
- **ContactController**: إضافة method `index()`

#### 4. Views
- **Admin Settings**: `resources/views/admin/settings/partials/social.blade.php`
- **Admin Settings**: `resources/views/admin/settings/partials/general.blade.php`
- **Contact Page**: `resources/views/contact.blade.php` (محدث بالكامل)
- **Layout**: `resources/views/layouts/app.blade.php` (تحديث Footer)
- **Admin Layout**: `resources/views/layouts/admin.blade.php` (إضافة رابط جديد)
- **Social Links Admin**: `resources/views/admin/social-links.blade.php` (جديد)

#### 5. Blade Components
- **Component Class**: `app/View/Components/SocialIcons.php`
- **Component View**: `resources/views/components/social-icons.blade.php`

#### 6. Routes
- **web.php**: إضافة route جديد `/admin/social-links`

## كيفية الاستخدام

### في الموقع
```php
<x-social-icons />
```

### في الكود
```php
$activeLinks = get_active_social_links();
```

### في لوحة الإدارة
- انتقل إلى "الإعدادات" > "روابط التواصل الاجتماعي"
- أو "روابط التواصل الاجتماعي" مباشرة

## الأيقونات والألوان المستخدمة

### الأيقونات (Bootstrap Icons)
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
- هاتف: `bi-telephone`
- بريد إلكتروني: `bi-envelope`

### الألوان
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

## التحديثات الأخيرة

### تحديث العنوان (2024)
- **العنوان الجديد**: الشارع العام، الخضراء، مكة المكرمة - حي الشرائع، مكة 24267
- **رابط خرائط جوجل الجديد**: https://maps.app.goo.gl/CXC1FCGzbcHgN1oN6

## ملاحظات مهمة

1. جميع الروابط يتم تحديثها تلقائياً في جميع صفحات الموقع
2. يمكن تعديل أي رابط من لوحة الإدارة
3. الأيقونات تظهر فقط للروابط النشطة (غير فارغة)
4. تم إضافة زر واتساب عائم في الصفحة الرئيسية
5. جميع الروابط تدعم فتحها في نافذة جديدة

## الدعم

لأي استفسارات أو مشاكل، يمكن التواصل عبر:
- البريد الإلكتروني: greenarrowacademic@gmail.com
- الواتساب: +966 50 826 0274
- الهاتف: +966 50 826 0274
