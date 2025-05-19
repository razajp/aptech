@extends('layouts.app')
@section('title', 'Employee Attendance Details')
@section('content')

<div id="modal"
    class="mainModal hidden fixed inset-0 z-50 text-sm flex items-center justify-center bg-[var(--overlay-color)] fade-in">
    <!-- Modal for Attendance Details (optional) -->
    <x-modal id="modalForm" closeAction="closeModal">
        <!-- Modal Content Slot -->
        <div class="flex items-start relative">
            <div class="flex-1 h-full overflow-y-auto my-scrollbar-2">
                <h5 id="name" class="text-2xl my-1 text-[var(--text-color)] capitalize font-semibold">Attendance Details</h5>
                <!-- Detailed Attendance Content -->
            </div>
        </div>
    
        <!-- Modal Action Slot -->
        <x-slot name="actions">
            <button onclick="closeModal()" type="button"
                class="px-4 py-2 bg-[var(--secondary-bg-color)] border border-gray-600 text-[var(--secondary-text)] rounded-lg hover:bg-[var(--h-bg-color)] transition-all duration-300 ease-in-out cursor-pointer">
                Close
            </button>
        </x-slot>
    </x-modal>
</div>

<div class="max-w-7xl mx-auto bg-[--secondary-bg-color] shadow-lg rounded-xl p-8 h-[50rem] border">

    <!-- Employee Details Box -->
    <form action="{{ route('attendances.index') }}" method="POST" class="mb-6">
        <div class="bg-[--h-bg-color] border border-gray-300 py-4 px-5 rounded-xl mb-4 flex items-end gap-5">
            <div class="w-full grow">
                <x-input label="Employee Name" name="employee_name" id="employee_name" placeholder="Enter Employee Name" />
            </div>

            <div class="w-full grow">
                <x-input label="Month" name="month" id="month" type="month" />
            </div>

            <button type="submit" id="searchBtn" class="bg-blue-400 text-gray-100 font-medium px-6 py-2.5 rounded-lg border border-transparent transition-all 0.3s ease-in-out hover:bg-blue-500">
                Search
            </button>
        </div>
    </form>

    <!-- Employee Summary Box -->
    <div class="bg-[--h-bg-color] border border-gray-300 py-4 px-5 rounded-xl mb-6 flex justify-between items-center">
        <div class="text-md font-semibold text-[var(--text-color)]">
            <span id="employee-name-display">Employee: Hasan</span>
        </div>
        <div class="text-md font-semibold text-[var(--text-color)]">
            <span id="month-display">Month: May-2025</span>
        </div>
        <div class="text-md font-semibold text-[var(--text-color)]">
            <span id="total-days">Working Days: {{ $attendances->count() }}</span>
        </div>
        <div class="text-md font-semibold text-[var(--text-color)]">
            <span id="total-present">Total Present: {{ $attendances->where('status', 'Present')->count() }}</span>
        </div>
        <div class="text-md font-semibold text-[var(--text-color)]">
            <span id="total-absent">Total Absent: {{ $attendances->where('status', 'Absent')->count() }}</span>
        </div>
        <div class="text-md font-semibold text-[var(--text-color)]">
            <span id="total-off-days">Total Off Days: {{ $attendances->where('status', 'Off Day')->count() }}</span>
        </div>
        <div class="text-md font-semibold text-[var(--text-color)]">
            <span id="salary">Salary: $2000</span> <!-- This is an example, you can calculate based on worked hours -->
        </div>
    </div>

    <div class="flex justify-between my-4 px-4">
        <span class="text-blue-500">1 Records</span>
        <span class="text-blue-500">Total Present: 1</span> <!-- You can calculate total present here -->
    </div>

    <div class="overflow-x-auto text-sm">
        <div class="flex bg-[--h-bg-color] rounded-lg font-medium py-2 px-3">
            <div class="w-full">S.No.</div>
            <div class="w-full">Date</div>
            <div class="w-full">Check In</div>
            <div class="w-full">Check Out</div>
            <div class="w-full">Status</div>
            <div class="w-full">Working Time</div> <!-- AB = Absent without leave -->
        </div>
    
        <div class="search_container overflow-y-auto grow my-scrollbar-2">
            @foreach ($attendances as $index => $attendance)
                <div
                    class="relative group flex border-b border-gray-300 items-center py-2 px-3 cursor-pointer hover:bg-[--bg-color] transition-all fade-in ease-in-out employee-row"
                    data-name="{{ strtolower($attendance->name) }}"
                    data-month="{{ $attendance->date?->format('Y-m') ?? now()->format('Y-m') }}"
                >
                    <span class="w-full">{{ $index + 1 }}</span>
                    <span class="w-full">{{ optional($attendance->date)->format('d-M-Y, D') ?? '-' }}</span> <!-- Working Days -->
                    <span class="w-full">{{ optional($attendance->check_in)->format('h:i A') ?? '-' }}</span> <!-- Off Days -->
                    <span class="w-full">{{ optional($attendance->check_out)->format('h:i A') ?? '-' }}</span> <!-- Holidays -->
                    <span class="w-full">{{ $attendance->status ?? '-' }}</span> <!-- Leaves -->
                    <span class="w-full">
                        @if ($attendance->check_in && $attendance->check_out)
                            {{ number_format($attendance->check_in->diffInMinutes($attendance->check_out) / 60, 2) }}
                        @else
                            - 
                        @endif
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
