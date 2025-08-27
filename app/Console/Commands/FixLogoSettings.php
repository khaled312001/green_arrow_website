<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class FixLogoSettings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'settings:fix-logo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix logo settings by updating the database to point to existing files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking logo settings...');

        // Check what files exist in the settings directory
        $files = Storage::disk('public')->files('settings');
        $this->info('Found ' . count($files) . ' files in settings directory:');
        foreach ($files as $file) {
            $this->line('- ' . $file);
        }

        // Get current logo setting
        $logoSetting = Setting::where('key', 'site_logo')->first();
        if ($logoSetting) {
            $this->info('Current logo setting: ' . ($logoSetting->value ?: 'empty'));
            
            // Check if the file exists (only if value is not empty)
            if ($logoSetting->value && !Storage::disk('public')->exists($logoSetting->value)) {
                $this->warn('Logo file does not exist: ' . $logoSetting->value);
                
                // Find the first image file
                $imageFiles = array_filter($files, function($file) {
                    return in_array(pathinfo($file, PATHINFO_EXTENSION), ['png', 'jpg', 'jpeg', 'gif', 'svg']);
                });
                
                if (!empty($imageFiles)) {
                    $newLogoPath = reset($imageFiles);
                    $this->info('Updating logo to: ' . $newLogoPath);
                    
                    $logoSetting->update(['value' => $newLogoPath]);
                    $this->info('Logo setting updated successfully!');
                } else {
                    $this->error('No image files found in settings directory');
                }
                            } else {
                    if ($logoSetting->value) {
                        $this->info('Logo file exists and is correct');
                    } else {
                        $this->warn('Logo setting is empty, updating to first available image');
                        
                        // Find the first image file
                        $imageFiles = array_filter($files, function($file) {
                            return in_array(pathinfo($file, PATHINFO_EXTENSION), ['png', 'jpg', 'jpeg', 'gif', 'svg']);
                        });
                        
                        if (!empty($imageFiles)) {
                            $newLogoPath = reset($imageFiles);
                            $this->info('Updating logo to: ' . $newLogoPath);
                            
                            $logoSetting->update(['value' => $newLogoPath]);
                            $this->info('Logo setting updated successfully!');
                        } else {
                            $this->error('No image files found in settings directory');
                        }
                    }
                }
        } else {
            $this->error('No logo setting found in database');
        }

        // Clear cache
        Setting::clearCache();
        $this->info('Settings cache cleared');

        return 0;
    }
} 