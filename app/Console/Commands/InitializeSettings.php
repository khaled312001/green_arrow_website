<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Setting;

class InitializeSettings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'settings:initialize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize all default settings in the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Initializing settings...');

        // Initialize default settings
        Setting::initializeDefaults();

        $this->info('Settings initialized successfully!');

        // Show current settings count
        $count = Setting::count();
        $this->info("Total settings in database: {$count}");

        // Show appearance settings specifically
        $appearanceSettings = Setting::where('group', 'appearance')->get();
        $this->info('Appearance settings:');
        foreach ($appearanceSettings as $setting) {
            $this->line("- {$setting->key}: {$setting->value} ({$setting->type})");
        }

        // Clear cache
        Setting::clearCache();
        $this->info('Settings cache cleared');

        return 0;
    }
}
