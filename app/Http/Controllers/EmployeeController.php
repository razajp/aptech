<?php

namespace App\Http\Controllers;

use App\Models\employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index() 
    {
        $employees = Employee::with('attendance')->get();
        // return $employees;
        return view('employees.index', compact('employees'));
    }
    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'empid' => 'required|integer',
            'name' => 'required|string',
            'email' => 'nullable|email',
            'username' => 'required|string|unique:employees,username',
            'password' => 'required|string|min:4',
            'designation' => 'required|string',
            'department' => 'required|string',
            'joining_date' => 'required|date',
            'salary' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        employee::create($data);
        
        return redirect(route('employees.index'));
    }
}
