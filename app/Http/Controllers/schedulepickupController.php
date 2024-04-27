<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\schedulepickup;

class schedulepickupController extends Controller
{
    public function create(){
        return view('schedulepickup.create');
    }

    public function getHistory(){
        $schedulepickup = Order::all();

        return view('historyschedulepickup.index', ['data_order' => $schedulepickup]);
    }
    //
}