<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Components\Common;
use App\Models\EsslDevice;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{


    public function getDevice(Request $request)
    {
        $essls =  EsslDevice::all();
        return view('superadmin.parts.deviceTable', compact('essls'));
    }
    public function deviceConnection(Request $request)
    {

        $response = Http::get('http://localhost:8282/Connect?ip=' . $request->ip_address . '');
        $body = json_decode($response->body());

        return response()->json([
            'status' => $body->status,
            'message' => $body->msg,
        ], 200);
    }

    public function pingDevice(Request $request)
    {
        set_time_limit(0);
        $response = Http::get('http://localhost:8282/ping?ip=' . $request->ip_address);
        $body = json_decode($response->body());

        if ($body->status == true) {
            echo $body->msg;
        } else {
            echo $body->msg;
        }
    }

    public function storeUserLog(Request $request)
    {
        return view('superadmin.parts.logAdd');
    }

    public function editDevice(Request $request)
    {
        $deviceStatusType = EsslDevice::select('device_type', 'status')->get();
        $essl = EsslDevice::where('essl_device_id', $request->id)->first();
        return view('superadmin.parts.deviceUpdate', compact('essl', 'deviceStatusType'));
    }

    public function updateDevice(Request $request)
    {
        $update = EsslDevice::where('essl_device_id', $request->essl_device_id)->update([
            'ip_address' => $request->ip_address,
            'description' => $request->description,
            'status' => $request->status,
            'device_type' => $request->device_type
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Device Updated Successfully',
        ], 200);
    }

    public static function deleteDevice(Request $request)
    {
        // dd($request->all());
        $delete = EsslDevice::where('essl_device_id', $request->id)->delete();
        return response()->json([
            'data' => $delete,
            'status' => true,
            'message' => 'Device Deleted Successfully',
        ], 200);
    }

    public function addDevice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ip_address' => function ($attribute, $value, $onFailure) {
                $value = trim($value);
                if (!preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\z/', $value)) {
                    $onFailure('Ip Address is invalid.');
                }
            },
            'description' => 'required',
            'status' => 'required',
            'device_type' => 'required|string',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->getMessageBag()->first()
            ], 200);
        }
        $device = EsslDevice::create(
            [
                'ip_address' => $request->ip_address,
                'description' => $request->description,
                'status' => $request->status,
                'device_type' => $request->device_type
            ]
        );
        return response()->json([
            'status' => true,
            'message' => 'Device Added Successfully',
        ], 200);
    }




    public function storeDevice(Request $request)
    {
        $input = $request->all();
        try {
            EsslDevice::create($input);
            $bug = 0;
        } catch (\Exception $e) {
            $bug = 1;
        }

        if ($bug == 0) {
            return redirect('essl_devices')->with('success', 'Device successfully saved.');
        } else {
            return redirect('essl_devices')->with('error', 'Something Error Found !, Please try again.');
        }
    }
    public function index()
    {
        $results = EsslDevice::get();

        return view('superadmin.mainscreen', ['results' => $results]);
    }
    public function storeLogsByDate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'ip_address' => function ($attribute, $value, $onFailure) {
                $value = trim($value);
                if (!preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\z/', $value)) {
                    $onFailure('Ip Address is invalid.');
                }
            },
            'from_date' => 'required',
            'to_date' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->getMessageBag()->first()
            ], 200);
        }

        $fromDate = \Carbon\Carbon::createFromFormat('m/d/Y', $request->from_date)
            ->format('d-m-Y');
        $toDate = \Carbon\Carbon::createFromFormat('m/d/Y', $request->to_date)
            ->format('d-m-Y');

        $response = Http::get('http://localhost:8282/GetLogsbydate?ip=' . $request->ip_address . '&fromdate=' . $fromDate . '&todate=' . $toDate . '');
        $body = json_decode($response->body());

        if ($body->status == true) {
            foreach ($body->data as $key => $data) {
                $checkType = EsslDevice::where('ip_address', $request->ip_address)->select('device_type')->first();

                $exist = DB::table('ms_sqls')->where('ID', $data->sdwEnrollNumber)->where('device_name', $request->ip_address)->where('datetime', $data->logs)->first();

                if (!$exist) {
                    DB::table('ms_sqls')->insert([
                        'ID' => $data->sdwEnrollNumber,
                        'device_name' =>  $request->ip_address,
                        'datetime' => $data->logs,
                        'status' => 1,
                        'type' => $checkType->device_type,
                        'punching_time' => Carbon::now(),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
            }
            return response()->json([
                'status' => true,
                'message' => 'Device Data Insert Successfully',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Please Connect the Device First (or) Some Error Occured',
            ], 200);
        }
    }
}
