@extends('layouts.app')
@section('title', 'Employee Attendance | Payroll')
@section('content')

<div id="modal"
    class="mainModal hidden fixed inset-0 z-50 text-sm flex items-center justify-center bg-[var(--overlay-color)] fade-in">
    <x-modal id="modalForm" closeAction="closeModal" action="{{ route('employees.store') }}">
        <!-- Modal Content Slot -->
        <div class="flex items-start relative">
            <div class="flex-1 h-full overflow-y-auto my-scrollbar-2">
                <h5 id="name" class="text-2xl my-1 text-[var(--text-color)] capitalize font-semibold">Add Employee</h5>
                <div class="grid grid-cols-2 gap-4">
                    <x-input label="Employee Id" name="empid" id="empid" placeholder="Employee Id"/>
                    <x-input label="Name" name="name" id="name" placeholder="Employee Name"/>
                    <x-input label="Email" name="email" type="email" id="email" placeholder="Email"/>
                    <x-input label="username" name="username" id="username" placeholder="Username"/>
                    <x-input label="Password" name="password" type="password" id="password" placeholder="Password"/>
                    <x-input label="Designation" name="designation" id="designation" placeholder="Designation"/>
                    <x-input label="Department" name="department" id="department" placeholder="Department"/>
                    <x-input label="Joining_date" name="joining_date" id="joining_date" type="date" validateMin min="{{ now()->subDays('5')->toDateString() }}" validateMax max="{{ now()->toDateString() }}" />
                    <div class="col-span-full">
                        <x-input label="Salary" name="salary" type="number" id="salary" placeholder="Salary"/>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Modal Action Slot -->
        <x-slot name="actions">
            <button onclick="closeModal()" type="button"
                class="px-4 py-2 bg-[var(--secondary-bg-color)] border border-gray-600 text-[var(--secondary-text)] rounded-lg hover:bg-[var(--h-bg-color)] transition-all duration-300 ease-in-out cursor-pointer">
                Cancel
            </button>
            <button type="submit"
                class="px-5 py-2 bg-[var(--bg-success)] border border-[var(--bg-success)] text-[var(--text-success)] font-medium text-nowrap rounded-lg hover:bg-[var(--h-bg-success)] transition-all duration-300 ease-in-out cursor-pointer">
                Add Employee
            </button>
        </x-slot>
    </x-modal>
</div>

<div class="max-w-7xl mx-auto bg-[--secondary-bg-color] shadow-lg rounded-xl p-8 h-[50rem] border">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-[--text-color]">Employee Attendance List</h2>
        <button type="button" id="add-employee-btn" onclick="openModal()" class="bg-[--bg-success] text-[--text-success] font-medium border border-[--border-success] px-5 py-1.5 rounded-lg transition-all 0.3s ease-in-out hover:bg-[--h-bg-success]">Add Employee</button>
    </div>

    <div class="bg-[--h-bg-color] border border-gray-300 py-4 px-5 rounded-xl mb-2 flex items-end gap-5">
        <div class="w-full">
            <x-input label="Employee Name" name="employee_name" id="employee_name" placeholder="Enter Employee Name" />
        </div>
    
        <div class="w-full">
            <x-input label="Month" name="month" id="month" type="month" />
        </div>
    
        <button type="button" id="searchBtn" class="bg-blue-400 text-gray-100 font-medium px-6 py-2.5 rounded-lg border border-transparent transition-all 0.3s ease-in-out hover:bg-blue-500">Search</button>
    </div>

    <div class="flex justify-between my-4 px-4">
        <span class="text-blue-500">5 Records</span>
        <span class="text-blue-500">Total Present: 14</span>
    </div>

    <div class="overflow-x-auto text-sm">
        <div class="flex bg-[--h-bg-color] rounded-lg font-medium py-2 px-3">
            <div class="w-full">Employee Id</div>
            <div class="w-full">Employee Name</div>
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
            @foreach ($employees as $employee)
                <div
                    class="relative group flex border-b border-gray-300 items-center py-2 px-3 cursor-pointer hover:bg-[--bg-color] transition-all fade-in ease-in-out employee-row"
                    data-name="{{ strtolower($employee->name) }}"
                    data-month="{{ optional($employee->attendance->first())->date?->format('Y-m') ?? now()->format('Y-m') }}"
                >
                <span class="w-full">{{ $employee->empid ?? '-' }}</span>
                    <span class="w-full">{{ $employee->name }}</span>
                    <span class="w-full">{{ $employee->machine_name ?? '-' }}</span>
                    <span class="w-full">{{ $employee->working_days ?? '-' }}</span>
                    <span class="w-full">{{ $employee->off_days ?? '-' }}</span>
                    <span class="w-full">{{ $employee->holidays ?? '-' }}</span>
                    <span class="w-full">{{ $employee->leaves ?? '-' }}</span>
                    <span class="w-full">{{ $employee->attendance->count() }}</span>
                    <span class="w-full">{{ $employee->ab ?? '-' }}</span>
                    <span class="w-[10%]">
                        <a href="{{ route('employees.show', $employee->id) }}" class="text-blue-500 hover:underline">
                            Detail
                        </a>
                    </span>
                </div>
            @endforeach
        </div>
    </div>
    
</div>
<script>
    document.getElementById('searchBtn').addEventListener('click', function () {
        const nameInput = document.getElementById('employee_name').value.toLowerCase();
        const monthInput = document.getElementById('month').value;
    
        document.querySelectorAll('.employee-row').forEach(row => {
            const name = row.getAttribute('data-name');
            const month = row.getAttribute('data-month');
    
            const nameMatch = name.includes(nameInput);
            const monthMatch = monthInput === '' || month === monthInput;
    
            if (nameMatch && monthMatch) {
                row.style.display = 'flex';
            } else {
                row.style.display = 'none';
            }
        });
    });

    let isModalOpened = false
    
    function openModal() {
        isModalOpened = true;
        let modal = document.getElementById('modal');
        modal.classList.remove('hidden');
    }
    
    function closeModal() {
        isModalOpened = false;
        let modal = document.getElementById('modal');
        modal.classList.add('fade-out');

        modal.addEventListener('animationend', () => {
            modal.classList.add('hidden');
            modal.classList.remove('fade-out');
        }, {
            once: true
        });
    }
</script>
@endsection
