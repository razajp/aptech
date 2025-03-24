<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function receivingFee()
    {
        return view('fee.receivingFee');
    }
    public function feeList()
    {
        return view('fee.feeList');
    }
}
