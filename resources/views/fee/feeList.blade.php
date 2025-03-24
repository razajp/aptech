@extends('layouts.app')
@section('title', 'Fee Received List | Aptech')
@section('content')
@php
    $fees = [
        ['name' => 'MUHAMMAD TALHA', 'enroll' => '1367013', 'receipt' => '41337', 'against' => 'OV Charges', 'amount' => '3,500.00', 'date' => '2025-03-15', 'sro' => 'zainab'],
        ['name' => 'HUZAIFA HUSSAIN', 'enroll' => '1607488', 'receipt' => '41336', 'against' => 'OV Charges', 'amount' => '4,500.00', 'date' => '2025-03-15', 'sro' => 'zainab'],
        ['name' => 'TAHA KAZMI', 'enroll' => '1514118', 'receipt' => '41335', 'against' => 'OV Charges', 'amount' => '4,000.00', 'date' => '2025-03-15', 'sro' => 'zainab'],
        ['name' => 'HABIB ULLAH', 'enroll' => '1518307', 'receipt' => '41321', 'against' => 'OV Charges', 'amount' => '4,000.00', 'date' => '2025-03-14', 'sro' => 'zainab'],
        ['name' => 'IKHLAS AHMED', 'enroll' => '1507192', 'receipt' => '41319', 'against' => 'OV Charges', 'amount' => '4,000.00', 'date' => '2025-03-14', 'sro' => 'zainab'],
    ];
@endphp
<div class="max-w-7xl mx-auto bg-[--secondary-bg-color] shadow-lg rounded-xl p-8 h-[50rem]">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-[--text-color]">Fee Received List</h2>
        <a href="{{ route('receivingFee') }}" class="bg-[--bg-success] text-[--text-success] font-medium border border-[--border-success] px-5 py-1.5 rounded-lg transition-all 0.3s ease-in-out hover:bg-[--h-bg-success]">Insert</a>
    </div>

    <form action="#" method="GET">
        <div class="bg-[--h-bg-color] border border-gray-300 py-4 px-5 rounded-xl mb-2 flex items-end gap-5">
            <div class="w-full">
                <x-input label="Student Enrollment" name="enrollment" id="enrollment" placeholder="Enter Enrollment No" />
            </div>

            <div class="w-full">
                <x-input label="From" name="from_date" id="from_date" type="date" />
            </div>

            <div class="w-full">
                <x-input label="To" name="to_date" id="to_date" type="date" />
            </div>

            <button type="submit" class="bg-blue-400 text-gray-100 font-medium px-6 py-2.5 rounded-lg border border-transparent transition-all 0.3s ease-in-out hover:bg-blue-500">Search</button>
        </div>
    </form>

    <div class="flex justify-between my-4 px-4">
        <span class="text-blue-500">5077 Records</span>
        <span class="text-blue-500">Total Amount: Rs 34,882,580.00</span>
    </div>

    <div class="overflow-x-auto text-sm">
        <div class="flex bg-[--h-bg-color] rounded-lg font-medium py-2 px-3">
            <div class="w-full">Name</div>
            <div class="w-full">Enrollment No.</div>
            <div class="w-full">Receipt No.</div>
            <div class="w-full">Recv'd Against</div>
            <div class="w-full">Paid Amount</div>
            <div class="w-full">Payment Rec Date</div>
            <div class="w-full">SRO</div>
            <div class="w-[10%]">Edit</div>
        </div>
        <div class="search_container overflow-y-auto grow my-scrollbar-2">
            @foreach ($fees as $fee)
                <div class="relative group flex border-b border-gray-300 items-center py-2 px-3 cursor-pointer hover:bg-[--bg-color] transition-all fade-in ease-in-out">
                    <span class="w-full">{{ $fee['name'] }}</span>
                    <span class="w-full">{{ $fee['enroll'] }}</span>
                    <span class="w-full">{{ $fee['receipt'] }}</span>
                    <span class="w-full">{{ $fee['against'] }}</span>
                    <span class="w-full">{{ $fee['amount'] }}</span>
                    <span class="w-full">{{ $fee['date'] }}</span>
                    <span class="w-full">{{ $fee['sro'] }}</span>
                    <span class="w-[10%]"><a href="#" class="text-blue-500 hover:underline">✎</a></span>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
