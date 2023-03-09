<?php

namespace App\Http\Controllers;

use App\Models\EsslDevice;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function test()
    {

        $devices = EsslDevice::pluck('ip_address')->toArray();
        $onlineDevices = [];
        foreach ($devices as $device) {
            $response = Http::get('http://localhost:8282/GetLogsbydate?ip=' . $device . '&fromdate=' . date('d-m-Y', strtotime('+1 days')) . '&todate=' . date('d-m-Y', strtotime('+1 days')) . '');
            $body = json_decode($response->body());
            $BodyData =  $body;

            if ($BodyData->status == true) {
                array_push($onlineDevices, $device);
            }
        }

        return $this->GetLogsByDate($onlineDevices);
    }



    public function GetLogsByDate()
    {
        set_time_limit(0);
        $onlineDevices = EsslDevice::pluck('ip_address')->toArray();

        foreach ($onlineDevices as $key => $device) {

            $from_date = DATE('01-m-Y');
            $lastlogRow = DB::table('mysql_dummies')->where('ip_address', $device)->max('datetime');

            if ($lastlogRow)
                $from_date = DATE('d-m-Y', strtotime($lastlogRow));

            $response = Http::get('http://localhost:8282/GetLogsbydate?ip=' . $device . '&fromdate=' . $from_date . '&todate=' . Date('d-m-Y') . '');
            $body = json_decode($response->body());

            if ($body->status == true) {

                foreach ($body->data as $key => $log) {
                    $exist = DB::table('mysql_dummies')->where('ID', $log->sdwEnrollNumber)->where('ip_address', $device)->where('datetime', $log->logs)->first();
                    $type = DB::table('mysql_dummies')->where('ID', $log->sdwEnrollNumber)->orderByDesc('datetime')->first();

                    $inOut = 'in';

                    if ($type && strtolower($type->type) == 'in') {
                        $inout = 'out';
                    }

                    if (!$exist) {
                        DB::table('mysql_dummies')->insert([
                            'ID' => $log->sdwEnrollNumber,
                            'ip_address' => $device,
                            'datetime' => $log->logs,
                            'type' => $inOut,
                            'punching_time' => Carbon::now(),
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }
                }
            }
        }
    }
}
