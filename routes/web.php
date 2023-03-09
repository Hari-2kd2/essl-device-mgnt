<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EsslUserController;
use App\Http\Controllers\RouteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [RouteController::class, 'index'])->name('dashboard');
    Route::get('/superadmin', [RouteController::class, 'superadmin'])->name('superadmin');
    Route::get('/device', [RouteController::class, 'device'])->name('device');
    Route::get('/userManagement', [RouteController::class, 'userManagement'])->name('userManagement');
    Route::get('/importAttendance', [RouteController::class, 'importAttendance'])->name('importAttendance');
    Route::get('/UserCopy', [RouteController::class, 'UserCopy'])->name('UserCopy');



    Route::get('/test', [RouteController::class, 'test'])->name('test');;
    Route::get('/test_ajax', [AuthController::class, 'testAjax']);
});
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard1');

require __DIR__ . '/auth.php';

Route::get('/searchTable', [LogController::class, 'searchTable'])
    ->name('searchTable');

Route::get('/index', [DashboardController::class, 'index'])->name('index');
Route::get('/get_device', [DashboardController::class, 'getDevice'])->name('getDevice');
Route::post('/add_device', [DashboardController::class, 'addDevice'])->name('addDevice');
Route::post('/store_device', [DashboardController::class, 'storeDevice'])->name('storeDevice');
Route::get('/edit_device', [DashboardController::class, 'editDevice'])->name('editDevice');
Route::post('/update_device', [DashboardController::class, 'updateDevice'])->name('updateDevice');
Route::get('/delete_device', [DashboardController::class, 'deleteDevice'])->name('deleteDevice');
Route::get('/device_status', [DashboardController::class, 'deviceConnection'])->name('deviceConnection');
Route::get('/ping_device', [DashboardController::class, 'pingDevice'])->name('pingDevice');

Route::get('/index', [EsslUserController::class, 'index'])->name('index');
Route::post('/add_user', [EsslUserController::class, 'addUser'])->name('addUser');
Route::get('/get_user', [EsslUserController::class, 'getUser'])->name('getDeviceUser');
Route::post('/edit_user', [EsslUserController::class, 'editUser'])->name('editUser');
Route::post('/update_user', [EsslUserController::class, 'updateUser'])->name('updateUser');
Route::post('/delete_user', [EsslUserController::class, 'deleteUser'])->name('deleteDeviceUser');
Route::post('/upload_user', [EsslUserController::class, 'uploadUser'])->name('uploadUser');
Route::get('/device_user', [EsslUserController::class, 'deviceUser'])->name('deviceUser');

Route::get('/storeUserLog', [DashboardController::class, 'storeUserLog'])->name('storeUserLog');
Route::post('/store_logs_by_date', [DashboardController::class, 'storeLogsByDate'])->name('DevicestoreLogsByDate');
Route::get('/download_user', [EsslUserController::class, 'downloadUser'])->name('downloadUser');
Route::get('/get_download_user', [EsslUserController::class, 'getDownloadUser'])->name('getDownloadUser');
Route::post('/essl_upload_user', [EsslUserController::class, 'esslUploadUser'])->name('esslUploadUser');
