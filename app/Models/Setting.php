<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'label',
        'description',
        'is_public'
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    /**
     * Get a setting value by key
     */
    public static function get($key, $default = null)
    {
        return Cache::remember("setting.{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? static::castValue($setting->value, $setting->type) : $default;
        });
    }

    /**
     * Set a setting value
     */
    public static function set($key, $value, $type = 'string', $group = 'general', $label = null, $description = null, $isPublic = false)
    {
        $setting = static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type,
                'group' => $group,
                'label' => $label,
                'description' => $description,
                'is_public' => $isPublic
            ]
        );

        // Clear cache for this setting
        Cache::forget("setting.{$key}");
        
        return $setting;
    }

    /**
     * Get all settings by group
     */
    public static function getGroup($group)
    {
        return Cache::remember("settings.group.{$group}", 3600, function () use ($group) {
            return static::where('group', $group)->get()->mapWithKeys(function ($setting) {
                return [$setting->key => static::castValue($setting->value, $setting->type)];
            });
        });
    }

    /**
     * Get all public settings
     */
    public static function getPublic()
    {
        return Cache::remember('settings.public', 3600, function () {
            return static::where('is_public', true)->get()->mapWithKeys(function ($setting) {
                return [$setting->key => static::castValue($setting->value, $setting->type)];
            });
        });
    }

    /**
     * Clear all settings cache
     */
    public static function clearCache()
    {
        Cache::flush();
    }

    /**
     * Cast value based on type
     */
    protected static function castValue($value, $type)
    {
        switch ($type) {
            case 'boolean':
                return (bool) $value;
            case 'integer':
                return (int) $value;
            case 'json':
                return json_decode($value, true);
            case 'file':
                return $value ? asset('storage/' . $value) : null;
            default:
                return $value;
        }
    }

    /**
     * Initialize default settings
     */
    public static function initializeDefaults()
    {
        $defaults = [
            // Site Information
            ['site_name', 'أكاديمية السهم الأخضر للتدريب', 'string', 'site', 'اسم الموقع', 'اسم الموقع كما يظهر في المتصفح', true],
            ['site_description', 'أكاديمية السهم الأخضر للتدريب بمكة المكرمة - دورات تدريبية متخصصة في البرمجة والإدارة واللغات والتقنية مع أفضل المدربين', 'string', 'site', 'وصف الموقع', 'وصف الموقع للمحركات البحث', true],
            ['site_email', 'greenarrowacademic@gmail.com', 'string', 'site', 'البريد الإلكتروني', 'البريد الإلكتروني الرئيسي للموقع', true],
            ['site_phone', '+966 50 826 0274', 'string', 'site', 'رقم الهاتف', 'رقم الهاتف الرئيسي', true],
            ['site_whatsapp', '+966 50 826 0274', 'string', 'site', 'رقم الواتساب', 'رقم الواتساب للتواصل', true],
            ['site_address', 'مكة المكرمة - حي الخضراء - الشارع العام - مقابل قاعة البساتين للأفراح', 'string', 'site', 'العنوان', 'عنوان الموقع', true],
            ['site_working_hours', 'الأحد - الخميس: 8:00 ص - 6:00 م', 'string', 'site', 'ساعات العمل', 'ساعات العمل الرسمية', true],
            
            // Logo and Branding
            ['site_logo', null, 'file', 'appearance', 'شعار الموقع', 'شعار الموقع الرئيسي', true],
            ['site_logo_light', null, 'file', 'appearance', 'الشعار الفاتح', 'الشعار للخلفيات الداكنة', true],
            ['site_favicon', null, 'file', 'appearance', 'أيقونة الموقع', 'أيقونة الموقع في المتصفح', true],
            ['site_primary_color', '#10b981', 'string', 'appearance', 'اللون الأساسي', 'اللون الأساسي للموقع', true],
            ['site_secondary_color', '#1f2937', 'string', 'appearance', 'اللون الثانوي', 'اللون الثانوي للموقع', true],
            ['site_accent_color', '#f59e0b', 'string', 'appearance', 'لون التمييز', 'لون التمييز للموقع', true],
            
            // Course Settings
            ['max_course_duration', '100', 'integer', 'courses', 'أقصى مدة للدورة', 'أقصى مدة للدورة بالساعات', false],
            ['max_lessons_per_course', '50', 'integer', 'courses', 'أقصى عدد للدروس', 'أقصى عدد للدروس في الدورة', false],
            ['course_approval_required', '1', 'boolean', 'courses', 'تتطلب الموافقة على الدورات', 'هل تتطلب الدورات موافقة قبل النشر', false],
            ['allow_course_preview', '1', 'boolean', 'courses', 'السماح بمعاينة الدورات', 'السماح للمستخدمين بمعاينة الدورات', false],
            ['free_courses_allowed', '1', 'boolean', 'courses', 'السماح بالدورات المجانية', 'السماح بإنشاء دورات مجانية', false],
            ['course_certificate_enabled', '1', 'boolean', 'courses', 'تفعيل شهادات الدورات', 'تفعيل إصدار شهادات إتمام الدورات', false],
            
            // Payment Settings
            ['currency', 'SAR', 'string', 'payment', 'العملة', 'العملة الافتراضية للموقع', true],
            ['tax_rate', '15', 'integer', 'payment', 'نسبة الضريبة', 'نسبة الضريبة المطبقة', false],
            ['stripe_enabled', '1', 'boolean', 'payment', 'تفعيل Stripe', 'تفعيل بوابة الدفع Stripe', false],
            ['stripe_public_key', '', 'string', 'payment', 'مفتاح Stripe العام', 'المفتاح العام لـ Stripe', false],
            ['stripe_secret_key', '', 'string', 'payment', 'مفتاح Stripe السري', 'المفتاح السري لـ Stripe', false],
            ['paypal_enabled', '1', 'boolean', 'payment', 'تفعيل PayPal', 'تفعيل بوابة الدفع PayPal', false],
            ['paypal_client_id', '', 'string', 'payment', 'معرف PayPal', 'معرف العميل لـ PayPal', false],
            ['paypal_secret', '', 'string', 'payment', 'مفتاح PayPal السري', 'المفتاح السري لـ PayPal', false],
            ['bank_transfer_enabled', '1', 'boolean', 'payment', 'تفعيل التحويل البنكي', 'تفعيل خيار التحويل البنكي', false],
            ['bank_account_info', '', 'string', 'payment', 'معلومات الحساب البنكي', 'معلومات الحساب البنكي للتحويل', false],
            
            // Email Settings
            ['mail_from_address', 'greenarrowacademic@gmail.com', 'string', 'email', 'عنوان المرسل', 'عنوان البريد الإلكتروني للمرسل', false],
            ['mail_from_name', 'أكاديمية السهم الأخضر للتدريب', 'string', 'email', 'اسم المرسل', 'اسم المرسل في البريد الإلكتروني', false],
            ['welcome_email_enabled', '1', 'boolean', 'email', 'تفعيل بريد الترحيب', 'إرسال بريد ترحيب للمستخدمين الجدد', false],
            ['course_completion_email', '1', 'boolean', 'email', 'بريد إكمال الدورة', 'إرسال بريد عند إكمال الدورة', false],
            ['payment_confirmation_email', '1', 'boolean', 'email', 'بريد تأكيد الدفع', 'إرسال بريد تأكيد الدفع', false],
            ['newsletter_enabled', '1', 'boolean', 'email', 'تفعيل النشرة الإخبارية', 'تفعيل إرسال النشرة الإخبارية', false],
            
            // Social Media - Updated with all new links
            ['facebook_url', 'https://www.facebook.com/people/%D8%A3%D9%83%D8%A7%D8%AF%D9%8A%D9%85%D9%8A%D8%A9-%D8%A7%D9%84%D8%B3%D9%87%D9%85-%D8%A7%D9%84%D8%A3%D8%AE%D8%B6%D8%B1-%D9%84%D9%84%D8%AA%D8%AF%D8%B1%D9%8A%D8%A8/61571521234103/', 'string', 'social', 'رابط فيسبوك', 'رابط صفحة فيسبوك الرسمية', true],
            ['twitter_url', 'https://x.com/greenarrowac', 'string', 'social', 'رابط تويتر', 'رابط حساب تويتر الرسمي', true],
            ['instagram_url', 'https://www.instagram.com/greenarrowacademy/', 'string', 'social', 'رابط انستغرام', 'رابط حساب انستغرام الرسمي', true],
            ['youtube_url', 'https://www.youtube.com/@%D8%A3%D9%83%D8%A7%D8%AF%D9%8A%D9%85%D9%8A%D8%A9%D8%A7%D9%84%D8%B3%D9%87%D9%85%D8%A7%D9%84%D8%A3%D8%AE%D8%B6%D8%B1', 'string', 'social', 'رابط يوتيوب', 'رابط قناة يوتيوب الرسمية', true],
            ['linkedin_url', 'https://www.linkedin.com/company/%D8%B4%D8%B1%D9%83%D8%A9-%D8%A3%D9%83%D8%A7%D8%AF%D9%8A%D9%85%D9%8A%D8%A9-%D8%A7%D9%84%D8%B3%D9%87%D9%85-%D8%A7%D9%84%D8%A7%D8%AE%D8%B6%D8%B1-%D9%84%D9%84%D8%AA%D8%AF/', 'string', 'social', 'رابط لينكد إن', 'رابط صفحة لينكد إن الرسمية', true],
            ['tiktok_url', 'https://www.tiktok.com/@green.arrow645', 'string', 'social', 'رابط تيك توك', 'رابط حساب تيك توك الرسمي', true],
            ['telegram_url', 'https://t.me/greenarrowac', 'string', 'social', 'رابط تليجرام', 'رابط قناة تليجرام الرسمية', true],
            ['snapchat_url', 'https://www.snapchat.com/@elsahmacademic', 'string', 'social', 'رابط سناب شات', 'رابط حساب سناب شات الرسمي', true],
            ['google_maps_url', 'https://www.google.com/maps?q=%D9%85%D8%B1%D9%83%D8%B2+%D8%A3%D9%83%D8%A7%D8%AF%D9%8A%D9%85%D9%8A%D8%A9+%D8%A7%D9%84%D8%B3%D9%87%D9%85+%D8%A7%D9%84%D8%A3%D8%AE%D8%B6%D8%B1+%D9%84%D9%84%D8%AA%D8%AF%D8%B1%D9%8A%D8%A8%D8%8C+%D8%A7%D9%84%D8%B4%D8%A7%D8%B1%D8%B9+%D8%A7%D9%84%D8%B9%D8%A7%D9%85%D8%8C+%D8%A7%D9%84%D8%AE%D8%B6%D8%B1%D8%A7%D8%A1%D8%8C+%D9%85%D9%83%D8%A9+%D8%A7%D9%84%D9%85%D9%83%D8%B1%D9%85%D8%A9+-+%D8%AD%D9%8A+%D8%A7%D9%84%D8%B4%D8%B1%D8%A7%D8%A6%D8%B9%D8%8C+%D9%85%D9%83%D8%A9+24267%D8%8C+%D8%A7%D9%84%D9%85%D9%85%D9%84%D9%83%D8%A9+%D8%A7%D9%84%D8%B9%D8%B1%D8%A8%D9%8A%D8%A9+%D8%A7%D9%84%D8%B3%D8%B9%D9%88%D8%AF%D9%8A%D8%A9+%D8%A7%D9%84%D8%B3%D8%B9%D9%88%D8%AF%D9%8A%D8%A9&ftid=0x15c2018c03a08df1:0xdbdc350522e6d8d8&entry=gps&lucs=,94246480,94242508,94224825,94227247,94227248,47071704,47069508,94218641,94228354,94233079,94203019,47084304,94208458,94208447&g_ep=CAISEjI0LjUwLjAuNzA0NDI3ODkxMBgAINeCAyp-LDk0MjQ2NDgwLDk0MjQyNTA4LDk0MjI0ODI1LDk0MjI3MjQ3LDk0MjI3MjQ4LDQ3MDcxNzA0LDQ3MDY5NTA4LDk0MjE4NjQxLDk0MjI4MzU0LDk0MjMzMDc5LDk0MjAzMDE5LDQ3MDg0MzA0LDk0MjA4NDU4LDk0MjA4NDQ3QgJFRw%3D%3D&g_st=com.google.maps.preview.copy', 'string', 'social', 'رابط خرائط جوجل', 'رابط موقع الأكاديمية على خرائط جوجل', true],
            
            // SEO Settings
            ['site_title', 'أكاديمية السهم الأخضر للتدريب - مكة المكرمة', 'string', 'seo', 'عنوان الموقع', 'عنوان الموقع للمحركات البحث', true],
            ['site_keywords', 'أكاديمية السهم الأخضر, تدريب, دورات, برمجة, إدارة, لغات, تقنية, مكة المكرمة, السعودية', 'string', 'seo', 'كلمات مفتاحية', 'الكلمات المفتاحية للموقع', true],
            ['site_author', 'أكاديمية السهم الأخضر للتدريب', 'string', 'seo', 'مؤلف الموقع', 'مؤلف الموقع', true],
            ['og_title', 'أكاديمية السهم الأخضر للتدريب - مكة المكرمة', 'string', 'seo', 'عنوان Open Graph', 'عنوان المشاركة في وسائل التواصل', true],
            ['og_description', 'أكاديمية السهم الأخضر للتدريب بمكة المكرمة - دورات تدريبية متخصصة في البرمجة والإدارة واللغات والتقنية مع أفضل المدربين', 'string', 'seo', 'وصف Open Graph', 'وصف المشاركة في وسائل التواصل', true],
            ['og_image', null, 'file', 'seo', 'صورة Open Graph', 'صورة المشاركة في وسائل التواصل', true],
            ['twitter_card', 'summary_large_image', 'string', 'seo', 'نوع بطاقة تويتر', 'نوع بطاقة المشاركة في تويتر', true],
            ['google_analytics', '', 'string', 'seo', 'رمز Google Analytics', 'رمز تتبع Google Analytics', false],
            ['google_search_console', '', 'string', 'seo', 'رمز Google Search Console', 'رمز التحقق من Google Search Console', false],
            ['bing_webmaster', '', 'string', 'seo', 'رمز Bing Webmaster', 'رمز التحقق من Bing Webmaster', false],
            
            // System Settings
            ['maintenance_mode', '0', 'boolean', 'system', 'وضع الصيانة', 'تفعيل وضع الصيانة للموقع', false],
            ['maintenance_message', 'نعتذر، الموقع قيد الصيانة حالياً. يرجى المحاولة لاحقاً.', 'string', 'system', 'رسالة الصيانة', 'الرسالة المعروضة في وضع الصيانة', false],
            ['user_registration_enabled', '1', 'boolean', 'system', 'تفعيل التسجيل', 'السماح للمستخدمين الجدد بالتسجيل', false],
            ['email_verification_required', '1', 'boolean', 'system', 'تأكيد البريد الإلكتروني', 'تطلب تأكيد البريد الإلكتروني', false],
            ['max_file_upload_size', '10', 'integer', 'system', 'أقصى حجم للملفات', 'أقصى حجم للملفات المرفوعة بالميجابايت', false],
            ['allowed_file_types', 'jpg,jpeg,png,gif,pdf,doc,docx,mp4,mov,avi', 'string', 'system', 'أنواع الملفات المسموحة', 'أنواع الملفات المسموح برفعها', false],
            ['session_timeout', '120', 'integer', 'system', 'مهلة الجلسة', 'مهلة الجلسة بالدقائق', false],
            ['password_min_length', '8', 'integer', 'system', 'أقل طول لكلمة المرور', 'أقل طول مطلوب لكلمة المرور', false],
            ['password_require_special', '1', 'boolean', 'system', 'تطلب رموز خاصة', 'تطلب كلمة المرور رموز خاصة', false],
            
            // Notification Settings
            ['email_notifications_enabled', '1', 'boolean', 'notifications', 'تفعيل إشعارات البريد', 'تفعيل إرسال الإشعارات عبر البريد', false],
            ['sms_notifications_enabled', '0', 'boolean', 'notifications', 'تفعيل إشعارات SMS', 'تفعيل إرسال الإشعارات عبر SMS', false],
            ['push_notifications_enabled', '1', 'boolean', 'notifications', 'تفعيل الإشعارات الفورية', 'تفعيل الإشعارات الفورية في المتصفح', false],
            ['new_course_notification', '1', 'boolean', 'notifications', 'إشعارات الدورات الجديدة', 'إرسال إشعارات عند إضافة دورات جديدة', false],
            ['course_update_notification', '1', 'boolean', 'notifications', 'إشعارات تحديث الدورات', 'إرسال إشعارات عند تحديث الدورات', false],
            ['payment_notification', '1', 'boolean', 'notifications', 'إشعارات المدفوعات', 'إرسال إشعارات عند إتمام المدفوعات', false],
        ];

        foreach ($defaults as $default) {
            static::set($default[0], $default[1], $default[2], $default[3], $default[4], $default[5], $default[6]);
        }
    }
}
