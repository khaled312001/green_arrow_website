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
    protected $description = 'Initialize default settings for the application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Initializing default settings...');
        
        Setting::initializeDefaults();
        
        $this->info('Settings initialized successfully!');
        
        return Command::SUCCESS;
    }
}
