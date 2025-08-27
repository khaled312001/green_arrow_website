<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class UpdateLogoSettings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'settings:update-logos {--logo=} {--favicon=} {--clear-cache}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update logo and favicon settings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating logo settings...');

        // Update logo if provided
        if ($logoPath = $this->option('logo')) {
            if (file_exists($logoPath)) {
                $this->updateLogoSetting('site_logo', $logoPath);
                $this->info("Logo updated: {$logoPath}");
            } else {
                $this->error("Logo file not found: {$logoPath}");
            }
        }

        // Update favicon if provided
        if ($faviconPath = $this->option('favicon')) {
            if (file_exists($faviconPath)) {
                $this->updateLogoSetting('site_favicon', $faviconPath);
                $this->info("Favicon updated: {$faviconPath}");
            } else {
                $this->error("Favicon file not found: {$faviconPath}");
            }
        }

        // Clear cache if requested
        if ($this->option('clear-cache')) {
            $this->call('cache:clear');
            $this->call('config:clear');
            $this->call('view:clear');
            Setting::clearCache();
            $this->info('Cache cleared successfully');
        }

        // Show current settings
        $this->showCurrentSettings();

        $this->info('Logo settings update completed!');
    }

    private function updateLogoSetting($key, $filePath)
    {
        // Copy file to storage
        $fileName = basename($filePath);
        $storagePath = "settings/{$fileName}";
        
        // Copy file to storage
        if (Storage::disk('public')->put($storagePath, file_get_contents($filePath))) {
            // Update setting
            Setting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $storagePath,
                    'type' => 'file',
                    'group' => 'appearance',
                    'label' => $key === 'site_logo' ? 'شعار الموقع' : 'أيقونة الموقع',
                    'description' => $key === 'site_logo' ? 'شعار الموقع الرئيسي' : 'أيقونة الموقع في المتصفح',
                    'is_public' => true
                ]
            );
        }
    }

    private function showCurrentSettings()
    {
        $this->info('Current logo settings:');
        $this->line('Site Logo: ' . (setting('site_logo') ?: 'Not set'));
        $this->line('Site Favicon: ' . (setting('site_favicon') ?: 'Not set'));
        $this->line('Site Name: ' . (setting('site_name') ?: 'Not set'));
    }
}
