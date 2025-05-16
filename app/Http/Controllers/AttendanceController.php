<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\employee;
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

            $allAttendance = $zk->getAttendanceLogs();

            foreach ($allAttendance as $data) {
                if ($data) {
                    $employeeExists = Employee::where('empid', $data['id'])->exists();

                    if ($employeeExists) {
                        $attendance = new Attendance();
                        $attendance->empid = $data['id'];
                        $attendance->state = $data['state'];
                        $attendance->timestamp = $data['timestamp'];
                        $attendance->type = $data['type'];
                        $attendance->save();
                    }
                }
            }

            if (!empty($allAttendance)) {
                $zk->clearAttendance();
            } 

            $allAttendanceDB = Attendance::all();   

            $zk->disconnect();
            return response()->json(['data' => $allAttendance]);
        } 

        return redirect()->route('home');
    }
}
