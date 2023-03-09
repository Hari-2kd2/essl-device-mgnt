<?php

namespace App\Http\Controllers;

use App\Models\BiometricLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;

class LogController extends Controller
{
    public function export(Request $request)
    {
        Log::info('import done at :' . date('Y-m-d H:i:s'));

        DB::beginTransaction();
        $device = new BiometricLog();
        $device->primary_id = $request->primary_id;
        $device->ID = $request->ID;
        $device->datetime = $request->datetime;
        $device->device = $request->devuid;
        $device->device = $request->device;
        $device->device = $request->device_name;
        $device->punching_time = $request->punching_time;
        $device->save();
        DB::commit();

        return json_encode(['status' => 'success', 'message' => 'Device Log Successfully updated !'], 200);

    }

    public function searchTable(Request $request)
    {
        \set_time_limit(0);
        $schema = Schema::connection("sqlsrv")->hasTable($request->table_name);
        $logInfo = BiometricLog::max('datetime');
        if ($schema) {
            $result = $this->import($request->table_name);
            if ($result) {
                return Redirect::back()->withErrors(['success' => 'Data saved successfuly...']);
            }
            return Redirect::back()->withErrors(['success' => 'No new datas found...']);
        } else {
            return Redirect::back()->withErrors(['error' => 'Table schema not found!']);
            info('Table Schema Not Found ' . $request->table_name);
        }
    }

    public function findTable()
    {

        \set_time_limit(0);

        $myLogDTStr = '';
        $sqlLogDTStr = '';
        $mStartDTStr = '';
        $schema = '';

        $date = date('Y-m-d');
        $lDate = date('Y-m-t');
        $lDay = date('l', strtotime($lDate));
        $uT = strtotime(date('Y-m-d H:i:s', strtotime('+5 hours 30 Minutes')));

        $date = date('Y-m-d', strtotime('-5 hours -30 minutes'));
        $date = date('Y-m-d');
        $carbon_parse = Carbon::parse($date)->format("Ym");

        $logInfo = BiometricLog::max('datetime');

        $tableName = 'T_LG' . $carbon_parse;

        $schema = Schema::connection("sqlsrv")->hasTable($tableName);
        

        if ($logInfo != null && $schema != '') {

            $myLogDTStr = date('Y-m-d H:i:s', strtotime($logInfo));

            $sqlLog = DB::connection('sqlsrv')->table($tableName)->where($tableName . '.EVT', 4867)->max('DEVDT');
            $sqlLogDTStr = date('Y-m-d H:i:s', $sqlLog);

            $mStartDTStr = date('Y-m-01 05:30:00');
            $lMonth = date('Ym', strtotime('-1 month'));

            if ($mStartDTStr >= $myLogDTStr) { 
                  $tableName = 'T_LG' . $lMonth;
                  $sqlLog = DB::connection('sqlsrv')->table($tableName)->where($tableName . '.EVT', 4867)->max('DEVDT');
                  $sqlLogDTStr = date('Y-m-d H:i:s', $sqlLog);
     	if($myLogDTStr >= $sqlLogDTStr){
	     $tableName = 'T_LG' . $carbon_parse;
	}
                info($lMonth);  info($tableName); 
            }

        }

        $schema = Schema::connection("sqlsrv")->hasTable($tableName);

        if ($schema) {

            $this->import($tableName, $logInfo);

        } else {

            echo 'Table Schema Not Found ' . $tableName;
            info('Table Schema Not Found ' . $tableName);

        }


        // dd($tableName);	
        // dd((date('Y-m-d H:i:s')));
         info($myLogDTStr);
         info($sqlLogDTStr);	
    }

    public function import($table_name, $lastLogRow = false)
    {
        \set_time_limit(0);

        info("import function...! " . '||' . $table_name . '||' . $lastLogRow);

        $insertData = [];
        $time_start = microtime(true);

        $date = Carbon::now()->subDay(1)->format('Y-m-d');

        try {

            DB::beginTransaction();

            if ($lastLogRow) {

                $LogCollections = DB::connection('sqlsrv')->table($table_name)
                    ->select('DEVDT', 'USRID', 'DEVUID', 'SRVDT', 'EVTLGUID')
                    ->where($table_name . '.EVT', 4867)
                    ->orderBy('SRVDT', 'ASC')
                    ->where('SRVDT', '>=', $lastLogRow)
                    ->groupBy('DEVDT', 'USRID', 'DEVUID', 'SRVDT', 'EVTLGUID')
                    ->get();

            } else {

                $LogCollections = DB::connection('sqlsrv')->table($table_name)
                    ->select('DEVDT', 'USRID', 'DEVUID', 'SRVDT', 'EVTLGUID')
                    ->where($table_name . '.EVT', 4867)
                    ->orderBy('SRVDT', 'ASC')
                    ->groupBy('USRID', 'DEVUID', 'SRVDT', 'EVTLGUID', 'DEVDT')
                    ->get();

            }

            $newRecord = false;

            foreach ($LogCollections as $key => $log) {

                if ($lastLogRow) {
                    $check_record = DB::table('ms_sqls')->where('ID', $log->USRID)->where('evtlguid', $log->EVTLGUID)->where('devdt', $log->DEVDT)->first();
                } else {
                    $check_record = DB::table('ms_sqls')->where('ID', $log->USRID)->where('devdt', $log->DEVDT)->first();
                }

                if (!$check_record) {

                    $newRecord = true;

                    $insertData[] = [
                        'evtlguid' => $log->EVTLGUID,
                        'ID' => $log->USRID,
                        'datetime' => date('Y-m-d H:i:s', $log->DEVDT),
                        'punching_time' => $log->SRVDT,
                        'devuid' => $log->DEVUID,
                        'devdt' => $log->DEVDT,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];

                }
            }

            BiometricLog::insert($insertData);

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();
            echo "<pre>";
            print_r($e->getMessage());
            echo "</pre>";

            echo $e->getMessage();

        } finally {

            if (!$newRecord) {

                echo ('No New Records Found');
                info('No New Records Found');
                return true;

            } else {

                $time_end = microtime(true);
                $execution_time = ($time_end - $time_start);
                echo 'Attendance Log Imported Successfully...' . '  Process Duration : ' . \number_format($execution_time * 1000, 2, '.', '') . ' Milliseconds';
                return true;

            }

        }
    }
}
