<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EsslUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/optimize', function () {
    $cache  = Artisan::call('optimize:clear');
    $cache  = Artisan::call('optimize');
    return response()->json(['status' => true, 'message' => 'Success'], 200); //Return anything
});
// Route::get('/device_status', [DashboardController::class, 'deviceStatus'])->name('deviceStatus');
// Route::get('/get_user', [EsslUserController::class, 'getUser'])->name('getUser');
Route::post('/delete_user', [EsslUserController::class, 'deleteUser'])->name('deleteUser');
// Route::post('/storeLogsByDate', [DashboardController::class, 'storeLogsByDate'])->name('storeLogsByDate');
// Route::get('/ping_device', [DashboardController::class, 'pingDevice'])->name('pingDevice');
// Route::get('/download_user', [EsslUserController::class, 'downloadUser'])->name('pingDevice');
// Route::get('/getDownloadUser', [EsslUserController::class, 'getDownloadUser'])->name('pingDevice');
// Route::post('/test', [EsslUserController::class, 'uploadUser']);
// Route::post('/sampleUploadUser', [EsslUserController::class, 'sampleUploadUser']);



// Route::get('import', [LogController::class,  'import']);
// Route::get('export', [LogController::class,  'export']);
// Route::get('GetLogsByDate', [Controller::class,  'GetLogsByDate']);
