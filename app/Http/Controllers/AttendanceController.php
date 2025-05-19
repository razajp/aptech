<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Services\ZKTecoService;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index() {
        $attendances = Attendance::with('employee')->get();
        return view('attendances.index', compact('attendances'));
    }
    /**
     * Fetch attendance logs from the ZKTeco device.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchLogs()
    {
        $zk = new ZKTecoService;

        if ($zk->connect()) {
            $allAttendance = $zk->getAttendanceLogs();

            foreach ($allAttendance as $data) {
                if (!empty($data)) {
                    $empid = $data['id'];
                    $type = $data['type'] ?? null;
                    $timestamp = Carbon::parse($data['timestamp']);
                    $date = $timestamp->toDateString();

                    $employeeExists = Employee::where('empid', $empid)->exists();

                    if ($employeeExists && in_array($type, [0, 1, 4, 5])) {
                        // 1. Get last attendance date for the employee
                        $lastAttendance = Attendance::where('empid', $empid)
                            ->orderByDesc('date')
                            ->first();

                        if ($lastAttendance && $lastAttendance->date < $date) {
                            // 2. Fill missing dates with "Absent" or "Off Day"
                            $missingDate = Carbon::parse($lastAttendance->date)->addDay();
                            $currentLogDate = Carbon::parse($date);

                            while ($missingDate->lt($currentLogDate)) {
                                $status = $missingDate->isSunday() ? 'Off Day' : 'Absent';

                                Attendance::updateOrInsert(
                                    ['empid' => $empid, 'date' => $missingDate->toDateString()],
                                    ['status' => $status]
                                );

                                $missingDate->addDay();
                            }
                        }

                        // 3. Insert/update current check-in/out
                        $fields = [];

                        if (in_array($type, [0, 4])) {
                            $fields['check_in'] = $timestamp;
                        }

                        if (in_array($type, [1, 5])) {
                            // check-in must exist first
                            $existing = Attendance::where('empid', $empid)->where('date', $date)->first();
                            if (empty($existing?->check_in)) {
                                continue; // skip this check-out
                            }

                            $fields['check_out'] = $timestamp;
                        }

                        if (!empty($fields)) {
                            Attendance::updateOrInsert(
                                ['empid' => $empid, 'date' => $date],
                                array_merge($fields, ['status' => 'Present'])
                            );
                        }
                    }
                }
            }

            if (!empty($allAttendance)) {
                $zk->clearAttendance();
            }

            $zk->disconnect();

            return redirect()->back()->with('success', 'Attendance logs fetched successfully.');
        } else {
            return redirect()->back()->with('error', 'Unable to connect to the ZKTeco device. Please check the device or network connection.');
        }

        return redirect()->back()->with('error', 'Unable to connect to the ZKTeco device.');
    }
}
