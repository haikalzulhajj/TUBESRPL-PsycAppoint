<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;

class AdminController extends Controller
{
    public function getDashboard()
    {
        return view('admin.dashboard');
    }

    public function getResponseComplaint()
    {
        $complaintdata = Complaint::all();
        return view('admin.response-complaint', compact('complaintdata'));
    }

    // public function dataComplaint() 
    // {
    //     $complaintdata = Complaint::all();
    //     return view('admin.response-complaint', compact('laboratoriums'));
    // }
}
