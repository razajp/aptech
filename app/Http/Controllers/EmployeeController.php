<?php

namespace App\Http\Controllers;

use App\Models\employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function employeeList() 
    {
        $employees = Employee::with('attendance')->get();
        // return $employees;
        return view('employees.employees-list', compact('employees'));
    }
}
