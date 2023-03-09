<?php

namespace App\Http\Controllers;

use App\Models\EsslDevice;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index()
    {
        return view("superadmin.mainscreen");
    }
    public function DeviceTable()
    {

        return view("superadmin.DeviceTable");
    }
    public function superadmin()
    {
        return view("superadmin.mainscreen");
    }
  
    public function device()
    {
        $ipAddress = EsslDevice::all();
        return view("superadmin.device",compact('ipAddress'));
    }
    public function userManagement()
    {
        $ipAddress = EsslDevice::all();
        return view("superadmin.userManagement", compact('ipAddress'));
    }
    public function importAttendance()
    {
        $ipAddress = EsslDevice::all();

        return view("superadmin.importAttendance", compact('ipAddress'));
    }
    public function UserCopy()
    {
        $ipAddress = EsslDevice::all();

        return view("superadmin.userCopy", compact('ipAddress'));
    }
}
