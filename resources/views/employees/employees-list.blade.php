@extends('layouts.app')
@section('title', 'Employee Attendance | Payroll')
@section('content')
<div class="max-w-7xl mx-auto bg-[--secondary-bg-color] shadow-lg rounded-xl p-8 h-[50rem] border">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-[--text-color]">Employee Attendance List</h2>
        <a href="#" class="bg-[--bg-success] text-[--text-success] font-medium border border-[--border-success] px-5 py-1.5 rounded-lg transition-all 0.3s ease-in-out hover:bg-[--h-bg-success]">Insert</a>
    </div>

    <form action="#" method="GET">
        <div class="bg-[--h-bg-color] border border-gray-300 py-4 px-5 rounded-xl mb-2 flex items-end gap-5">
            <div class="w-full">
                <x-input label="Employee Name" name="employee_name" id="employee_name" placeholder="Enter Employee Name" />
            </div>

            <div class="w-full">
                <x-input label="Month" name="month" id="month" type="month" />
            </div>

            <button type="submit" class="bg-blue-400 text-gray-100 font-medium px-6 py-2.5 rounded-lg border border-transparent transition-all 0.3s ease-in-out hover:bg-blue-500">Search</button>
        </div>
    </form>

    <div class="flex justify-between my-4 px-4">
        <span class="text-blue-500">5 Records</span>
        <span class="text-blue-500">Total Present: 14</span>
    </div>

    <div class="overflow-x-auto text-sm">
        <div class="flex bg-[--h-bg-color] rounded-lg font-medium py-2 px-3">
            <div class="w-full">Employee Name</div>
            <div class="w-full">Machine Code</div>
            <div class="w-full">Machine Name</div>
            <div class="w-full">Working Days</div>
            <div class="w-full">Off Days</div>
            <div class="w-full">Holidays</div>
            <div class="w-full">Leaves</div>
            <div class="w-full">PR</div>
            <div class="w-full">AB</div>
            <div class="w-[10%]">Detail</div>
        </div>
        <div class="search_container overflow-y-auto grow my-scrollbar-2">
            @foreach ($employees as $employees)
                <div class="relative group flex border-b border-gray-300 items-center py-2 px-3 cursor-pointer hover:bg-[--bg-color] transition-all fade-in ease-in-out">
                    <span class="w-full">{{ $employees['name'] }}</span>
                    <span class="w-full">{{ $employees['machine_code'] }}</span>
                    <span class="w-full">{{ $employees['machine_name'] }}</span>
                    <span class="w-full">{{ $employees['working_days'] }}</span>
                    <span class="w-full">{{ $employees['off_days'] }}</span>
                    <span class="w-full">{{ $employees['holidays'] }}</span>
                    <span class="w-full">{{ $employees['leaves'] }}</span>
                    <span class="w-full">{{ $employees['attendance']->count() }}</span>
                    <span class="w-full">{{ $employees['ab'] }}</span>
                    <span class="w-[10%]"><a href="#" class="text-blue-500 hover:underline">Detail</a></span>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
