<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class UpdateNotificationSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update notification settings with correct keys
        $notificationSettings = [
            'notifications_email_enabled' => '1',
            'notifications_sms_enabled' => '0',
            'notifications_push_enabled' => '1',
            'notifications_whatsapp_enabled' => '0',
            'notifications_sound_enabled' => '1',
            'notifications_frequency' => 'immediate',
        ];

        foreach ($notificationSettings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value,
                    'type' => $key === 'notifications_frequency' ? 'string' : 'boolean',
                    'group' => 'notifications',
                    'label' => $key,
                    'description' => 'Notification setting',
                    'is_public' => false
                ]
            );
        }

        // Clear settings cache
        Setting::clearCache();

        $this->command->info('Notification settings updated successfully!');
    }
} 