<?php

namespace App\Console\Commands;

use App\Http\Controllers\LogController;
use App\Models\BiometricLog;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class LogImport extends Command
{
   
    protected $signature = 'log:import';
    
    protected $name = "log-import";

    protected $description = 'Run this command to import raw attendance logs for forign database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
       
        Log::info("Log cron is working fine!");

        $controller = new LogController();
        $controller->findTable();

    }
}
