<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class UpdateSocialMediaSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Social Media URLs
        Setting::set('social.instagram_url', 'https://www.instagram.com/greenarrowacademy/');
        Setting::set('social.facebook_url', 'https://www.facebook.com/people/أكاديمية-السهم-الأخضر-للتدريب/61571521234103/');
        Setting::set('social.twitter_url', 'https://x.com/greenarrowac');
        Setting::set('social.linkedin_url', 'https://www.linkedin.com/company/شركة-أكاديمية-السهم-الأخضر-للتد/');
        Setting::set('social.tiktok_url', 'https://www.tiktok.com/@green.arrow645');
        Setting::set('social.telegram_url', 'https://t.me/greenarrowac');
        Setting::set('social.snapchat_url', 'https://www.snapchat.com/@elsahmacademic');
        Setting::set('social.youtube_url', 'https://www.youtube.com/@أكاديميةالسهمالأخضر');
        Setting::set('social.google_maps_url', 'https://maps.app.goo.gl/CXC1FCGzbcHgN1oN6');

        // Site Information
        Setting::set('site.site_name', 'أكاديمية السهم الأخضر للتدريب');
        Setting::set('site.site_description', 'أكاديمية السهم الأخضر للتدريب بمكة المكرمة - دورات تدريبية متخصصة في البرمجة والإدارة واللغات والتقنية مع أفضل المدربين');
        Setting::set('site.site_email', 'greenarrowacademic@gmail.com');
        Setting::set('site.site_phone', '+966 50 826 0274');
        Setting::set('site.site_whatsapp', '+966 50 826 0274');
        Setting::set('site.site_address', 'الشارع العام، الخضراء، مكة المكرمة - حي الشرائع، مكة 24267');
        Setting::set('site.site_working_hours', 'الأحد - الخميس: 8:00 ص - 6:00 م');

        // SEO Meta
        Setting::set('seo.meta_title', 'أكاديمية السهم الأخضر للتدريب - مكة المكرمة');
        Setting::set('seo.meta_description', 'أكاديمية السهم الأخضر للتدريب بمكة المكرمة - دورات تدريبية متخصصة في البرمجة والإدارة واللغات والتقنية مع أفضل المدربين');
        Setting::set('seo.meta_keywords', 'أكاديمية تدريب، مكة المكرمة، دورات برمجة، دورات إدارة، دورات لغات، تدريب تقني');

        // Clear cache to ensure updated settings are reflected
        Setting::clearCache();

        $this->command->info('Social media settings and contact information updated successfully!');
    }
}
