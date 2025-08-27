<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class LogoSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Set logo files
        Setting::updateOrCreate(
            ['key' => 'site_logo'],
            [
                'value' => '/images/logo.svg',
                'type' => 'file',
                'group' => 'appearance',
                'label' => 'شعار الموقع',
                'description' => 'شعار الموقع الرئيسي',
                'is_public' => true
            ]
        );

        Setting::updateOrCreate(
            ['key' => 'site_logo_light'],
            [
                'value' => '/images/logo-light.svg',
                'type' => 'file',
                'group' => 'appearance',
                'label' => 'الشعار الفاتح',
                'description' => 'الشعار للخلفيات الداكنة',
                'is_public' => true
            ]
        );

        Setting::updateOrCreate(
            ['key' => 'site_favicon'],
            [
                'value' => '/favicon.svg',
                'type' => 'file',
                'group' => 'appearance',
                'label' => 'أيقونة الموقع',
                'description' => 'أيقونة الموقع في المتصفح',
                'is_public' => true
            ]
        );

        $this->command->info('Logo settings have been updated successfully!');
    }
}
