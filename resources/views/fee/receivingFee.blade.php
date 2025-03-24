@extends('layouts.app')
@section('title', 'Show Articles | Aptech')
@section('content')
@php
    $studentDetailsOptions = [
        '1157082' => ['text' => '1157082 | Soha Jawed'],
    ];

    $paymentTypeOptions = [
        'cash' => ['text' => 'Cash'],
        'credit_card' => ['text' => 'Credit Card'],
        'bank_transfer' => ['text' => 'Bank Transfer'],
    ];
@endphp

<div class="max-w-4xl mx-auto bg-[--secondary-bg-color] shadow-lg rounded-xl p-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-[--text-color]">Receiving Student Fee</h2>
    </div>

    <div class="bg-[--h-bg-color] border border-gray-300 py-3 px-5 rounded-lg mb-6">
        <h3 class="text-lg font-semibold text-[--text-color]">Collection Details</h3>
    </div>

    <form action="#" method="POST" class="space-y-5">
        <div class="grid grid-cols-2 gap-5">
            <x-select label="Student Details" name="student_details" id="student_details" showDefault :options="$studentDetailsOptions" />

            <x-input label="SRO Name" name="sro_name" id="sro_name" placeholder="Enter SRO Name" required/>

            <x-input label="Receipt No." name="receipt_no" id="receipt_no" type="number" placeholder="Enter Receipt Number" required/>
            
            <x-input label="Payment Received Date" name="payment_received_date" id="payment_received_date" type="date" required/>
            
            <x-input label="Paid Amount" name="paid_amount" id="paid_amount" type="number" placeholder="Enter Paid Amount" required/>
            
            <x-input label="Balance Amount" name="balance_amount" id="balance_amount" type="number" placeholder="Enter Balance Amount" required/>
        </div>

        <x-checkbox-group 
            label="On Account Of" 
            name="account_of" 
            :options="['Admission Fee', 'Monthly Fee', 'OV Fee', 'Examination Fee', 'Other']"
        />
 
        <x-select label="Payment Type" name="paymentType" id="paymentType" :options="$paymentTypeOptions" />

        <div class="flex items-center justify-end gap-5">
            <button class="bg-[--bg-success] text-[--text-success] font-medium border border-[--border-success] px-5 py-1.5 rounded-lg transition-all 0.3s ease-in-out hover:bg-[--h-bg-success]">Save</button>
            <button class="bg-gray-200 text-gray-800 px-5 py-1.5 rounded-lg border border-transparent transition-all 0.3s ease-in-out hover:bg-gray-300">Back To List</button>
        </div>
    </form>
</div>
@endsection