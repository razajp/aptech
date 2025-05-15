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
            $allUsers = $zk->getUsers();

            foreach ($allUsers as $user) {
                // Check if employee already exists by uid
                $employee = Employee::where('empid', $user['userid'])->first();

                if (!$employee) {
                    // If not found, create new employee
                    $employee = new Employee();
                    $employee->empid = $user['userid'];
                    $employee->name = $user['name'];
                    $employee->password = $user['password'];
                    $employee->save();
                }
            }

            $allEmployees = Employee::all();    

            $allAttendance = $zk->getAttendanceLogs();

            foreach ($allAttendance as $data) {
                if ($data) {
                    $attendance = new Attendance();
                    $attendance->empid = $data['id'];
                    $attendance->state = $data['state'];
                    $attendance->timestamp = $data['timestamp'];
                    $attendance->type = $data['type'];
                    $attendance->save();
                }
            }

            if (!empty($allAttendance)) {
                $zk->clearAttendance();
            } 

            $allAttendanceDB = Attendance::all();   

            $zk->disconnect();
            return response()->json(['data' => $allAttendanceDB]);
        } 

        return redirect()->route('home');
    }
}
