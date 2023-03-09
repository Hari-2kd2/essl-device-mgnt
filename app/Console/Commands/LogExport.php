<?php

namespace App\Console\Commands;

use App\Components\Common;
use App\Models\BiometricLog;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class LogExport extends Command
{

    protected $signature = 'log:export';
    protected $name = 'log-export';
    protected $description = 'Export Log';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {

        DB::beginTransaction();

        $client = new \GuzzleHttp\Client(['verify' => false]);
        $response = $client->request('GET', Common::liveurl() . "loghistory");
        $json = $response->getBody()->getContents();

        $json = json_decode($json);
        if (isset($json->data->primary_id)) {
            $serverID = $json->data->primary_id;
        } else {
            $serverID = 0;
        }

        $local_logID = BiometricLog::orderBy('primary_id', 'DESC')->first();

        if ($serverID && $local_logID->primary_id == $serverID) {

            return true;
        }
       
        BiometricLog::where('primary_id', '>', $serverID)->orderBy('primary_id', 'ASC')->chunk(5, function ($device_log) {
            foreach ($device_log as $index => $logs) {

                try {

                    $client = new \GuzzleHttp\Client(['verify' => false]);
                    $response = $client->request('POST', Common::liveurl() . "importlogs", [
                        'form_params' => [
                            'ID' => $logs->ID,
                            'evtlguid' => $logs->evtlguid,
                            'devdt' => $logs->devdt,
                            'devuid' => $logs->devuid,
                            'datetime' => $logs->datetime,
                            'punching_time' => $logs->punching_time,
                        ],

                    ]);

                } catch (\Throwable $th) {
                    info(['index' => $index]);
                    info($th->getMessage());
                }

            }

        });

        DB::commit();
    }
}
