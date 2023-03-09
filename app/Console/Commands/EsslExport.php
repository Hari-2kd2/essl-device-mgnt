<?php

namespace App\Console\Commands;

use App\Http\Controllers\Controller;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\LogController;

class EsslExport extends Command
{
    protected $signature = 'essl:export';
    protected $name = "essl-export";
    protected $description = 'Run this command to import raw attendance logs for forign database';
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {

        Log::info("Log cron is working fine!");

        $controller = new Controller();
        $controller->GetLogsByDate();
    }
}
