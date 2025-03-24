<?php

namespace App\Http\Controllers;

use App\Services\ZKTecoService;
use Illuminate\Http\Request;
use Rats\Zkteco\Lib\ZKTeco;
// Import the class provided by the library. 
// Adjust the namespace if necessary based on the library's structure.
use Zkteco\ZK;

class AttendanceController extends Controller
{
    /**
     * Fetch attendance logs from the ZKTeco device.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchLogs()
    {

        $zk = new ZKTecoService;
        
        // Connect to the device
        if ($zk) {
            $zk->connect();
            // return response()->json(['message' => 'Connected to device']);
            // Fetch attendance logs
            $data = $zk->getAttendanceLogs();

            return response()->json(['data' => $data]);
        } 

        // // Disconnect from the device
        // $zk->disconnect();

        return response()->json(['logs' => 'hello']);
    }
}
