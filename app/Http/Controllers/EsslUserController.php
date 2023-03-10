<?php

namespace App\Http\Controllers;

use App\Models\AccessControl;
use App\Models\EsslDevice;
use App\Models\EsslUser;
use App\Models\UserCopy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EsslUserController extends Controller
{

    public function esslUploadUser(Request $request)
    {
        set_time_limit(0);
        ini_set('memory_limit', '2048M');

        $device = EsslDevice::where('ip_address', $request->ip_address)->first();
        $accessControl =   AccessControl::where('essl_device_id', $device->essl_device_id)->where('status', 1)->pluck('essl_user_id')->toArray();

        $allUsers = EsslUser::pluck('essl_user_id')->toArray();
        $newUsers = array_diff($allUsers, $accessControl);
        $newUsers = EsslUser::whereIn('essl_user_id', $newUsers)->get()->toArray();
        $dataSet = [];
        $msg = '';

        foreach ($newUsers as $user) {
            $master =   AccessControl::where('essl_user_id', $user['essl_user_id'])->where('status', 1)->with('device')->first();
            $newDevice = EsslDevice::where('ip_address', $request->ip_address)->first();
            $isThere = AccessControl::where('essl_user_id', $user['essl_user_id'])->where('essl_device_id', $newDevice->essl_device_id)->first();

            $accessControlData = [
                'essl_user_id' => $user['essl_user_id'],
                'essl_device_id' => $newDevice->essl_device_id,
                'status' => 2
            ];

            $isThere ? $isThere->update($accessControlData) : AccessControl::create($accessControlData);

            unset($user['essl_user_id']);
            unset($user['ip']);
            unset($user['created_at']);
            unset($user['updated_at']);

            $user['fromip'] = $master->device->ip_address;
            $user['toip'] = $request->ip_address;

            $dataSet[] = $user;
        }

        $dataSet = json_encode($dataSet);
        $dataSet = json_decode($dataSet);
        try {
            $response = Http::post('http://localhost:8282/uploaduser',  $dataSet);
            $content = $response->getBody()->getContents();
            $data = json_decode($content);
            return response()->json([
                'status' => true,
                'message' => 'Successfully upload fingerprint templates'
            ], 200);
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return response()->json([
                'message' => 'Please Connect the Device First!!!'
            ], 200);
        }
    }


    public function getUser(Request $request, EsslUser $esslUser, EsslDevice $esslDevice)
    {
        set_time_limit(0);
        $response = Http::get('http://localhost:8282/Getuser?ip=' . $request->ip_address);
        $body = json_decode($response->body());

        if ($body->status == true) {

            $users = [];
            $accessControl = [];

            $device = $esslDevice->where('ip_address', $request->ip_address)->first();

            foreach ($body->Fingerlist as $key => $userList) {
                // $exist = EsslUser::where('sdwEnrollNumber', $userList->sdwEnrollNumber)->first();
                // if (!$exist) {
                $users[$key] = EsslUser::updateOrcreate([
                    'ip' => $request->ip_address,
                    'sdwEnrollNumber' => $userList->sdwEnrollNumber,
                    'sName' => $userList->sName,
                    'idwFingerIndex' => $userList->idwFingerIndex,

                ]);
                if ($users[$key]['id']) {
                    $accessControl[] = AccessControl::updateOrCreate([
                        'essl_device_id' => $device->essl_device_id,
                        'essl_user_id' => $users[$key]['id'],
                    ]);
                } else {
                    $accessControl[] = AccessControl::updateOrCreate([
                        'essl_device_id' => $device->essl_device_id,
                        'essl_user_id' => $users[$key]['essl_user_id'],
                    ]);
                }
            }
            $deviceAddress = EsslDevice::where('ip_address', $request->ip_address)->select('ip_address')->first();
            $employeeDetails = EsslUser::where('ip', $request->ip_address)->get();

            return view('superadmin.employeeDetails', compact('employeeDetails', 'deviceAddress'));
        } else {
            echo $body->msg;
        }
    }

    public function deleteUser(Request $request)
    {
        $data = explode('-', $request->id);
        dd($data);
        $user_id = $data[0];
        $finger_id = $data[1];
        $ip_address = $data[2];

        $response = Http::delete('http://localhost:8282/deleteuser?userid=' . $user_id . '&fingerindex=' . $finger_id . '&ip=' . $ip_address . '');
        $body = json_decode($response->body());
        if ($body->status == true) {
            return response()->json([
                'message' => $body->msg,
            ], 200);
        } else {
            return response()->json([
                'status' => $body->status,
                'message' => $body->msg,
            ], 200);
        }
    }
    public function uploadUser(Request $request)
    {
        set_time_limit(0);
        $getCopiedUser = UserCopy::all();
        $body = json_decode($getCopiedUser);
        $rawData = [];
        foreach ($body as $user) {
            $rawData[] = [
                'sdwEnrollNumber' => $user->sdwEnrollNumber,
                'sName' => $user->sName,
                'idwFingerIndex' => $user->idwFingerIndex,
                'iPrivilege' => $user->iPrivilege,
                'sPassword' => $user->sPassword,
                'sTmpData' => $user->sTmpData,
                'sEnabled' => $user->sEnabled,
                'sLastEnrollNumber' => $user->sLastEnrollNumber,
                'iFlag' => $user->iFlag,
                'iTmpLength' => $user->iTmpLength,
                'fromip' => $user->fromip,
                'toip' => $request->ip_address,
            ];
        }

        $response = Http::post('http://localhost:8282/uploaduser',  $rawData);

        $content = $response->getBody()->getContents();
        $data = json_decode($content);

        // $client = new \GuzzleHttp\Client();
        // $response = $client->request('POST', 'http://localhost:8282', $rawData);
        // dd($response);
        // $statusCode = $response->getStatusCode();
        // $content = $response->getBody()->getContents();
        // $data = json_decode($content);
        dd($data);
    }
    // public function getDownloadUser(Request $request)
    // {
    //     $ipAddress = EsslDevice::all();
    //     $getCopiedUser = EsslUser::where('ip', $request->ip_address)->get();
    //     return view("superadmin.parts.downloadUserTable", compact('getCopiedUser', 'ipAddress'));
    // }
    public function downloadUser(Request $request)
    {
        set_time_limit(0);
        $response = Http::get('http://localhost:8282/downloaduser?ip=' . $request->ip_address . '');
        $body = json_decode($response->body());

        if ($body->status == true) {
            foreach ($body->userlist as $key => $user) {

                $data = [
                    'sdwEnrollNumber' => $user->sdwEnrollNumber,
                    'sName' => $user->sName,
                    'idwFingerIndex' => $user->idwFingerIndex,
                    'iPrivilege' => $user->iPrivilege,
                    'sPassword' => $user->sPassword,
                    'sTmpData' => $user->sTmpData,
                    'sEnabled' => $user->sEnabled,
                    'sLastEnrollNumber' => $user->sLastEnrollNumber,
                    'iFlag' => $user->iFlag,
                    'iTmpLength' => $user->iTmpLength,
                    'fromip' => $request->ip_address
                ];

                $user =   UserCopy::where('sdwEnrollNumber', $user->sdwEnrollNumber)->first();

                if ($user) {
                    $user->update($data);
                } else {
                    UserCopy::insert($data);
                }
            }

            echo $body->msg;
        } else {
            echo $body->msg;
        }
    }
    public function deviceUser(Request $request)
    {

        $ipAddress = EsslDevice::all();
        $getdeviceUser =  EsslUser::paginate(PER_PAGE_LIMIT);
        return view("superadmin.parts.downloadUserTable", compact('getdeviceUser', 'ipAddress'));
    }
}
