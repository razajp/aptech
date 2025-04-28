<?php

namespace App\Http\Controllers;

use App\Services\ZKTecoService;

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
        
        if ($zk) {
            $zk->connect();
            $data = $zk->getAttendanceLogs();

            return response()->json(['data' => $data]);
        } 
        $zk->disconnect();

        return redirect()->route('home');
    }
}
