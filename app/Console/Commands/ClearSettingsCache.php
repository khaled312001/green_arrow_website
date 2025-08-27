<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Setting;

class ClearSettingsCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'settings:clear-cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all settings cache to ensure fresh data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Clearing settings cache...');
        
        Setting::clearCache();
        
        $this->info('Settings cache cleared successfully!');
        
        return 0;
    }
} 