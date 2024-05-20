<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Complaint;
use App\Models\RedeemPoint;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Role; // Import the Role model

class AdminController extends Controller
{
    public function getDashboard()
    {
        return view('admin.dashboard');
    }

    public function getManageUser()
    {
        return view('admin.manageuser');
    }

    public function showUsers()
    {
        $users = User::all(); // Fetch all users from the database
        return view('admin.manageuser', ['users' => $users]);
    }
    
    public function edit(User $user)
    {
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, User $user) 
{
    // Validate the incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
        'role_id' => 'required|integer',
        'address' => 'nullable|string|max:255',
        'phoneNo' => 'nullable|string|max:15',
        'created_at' => 'required|date',
        'total_points' => 'required|integer'
    ]);

    // Update the user with the validated data
    $user->update($request->all());

    // Redirect to a page after updating
    return redirect()->route('manageuser')->with('success', 'User updated successfully.');
}

    public function getResponseComplaint()
    {
        $complaintdata = Complaint::all();
        return view('admin.response-complaint', compact('complaintdata'));
    }

    public function historyAllReedemPoint()
    {
        $data['history'] = RedeemPoint::select("redeem_points.*",'user.name')
                            ->leftJoin('user','user.user_id','=','redeem_points.user_id')
                            ->get();
        return view('admin.reedem-point-history',$data);
    }

    public function getHistory()
    {
        $data_order = Order::all();
        return view('historyschedulepickup.index', ['data_order' => $data_order]);
    }
    
    public function deleteHistory(Request $request, $id)
    {
        error_log($request->id);
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('history')->with('success', 'Data history berhasil dihapus');
    }

    public function destroy($id)
    {
        // Cari mobil berdasarkan ID
        $order = Order::find($id);
    
        // Pastikan mobil ditemukan
        if (!$order) {
            return redirect()->back()->with('error', 'order tidak ditemukan.');
        }
    
        // Hapus mobil
        $order->delete();
    
        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Mobil berhasil dihapus.');
    }   

    
    // public function dataComplaint() 
    // {
    //     $complaintdata = Complaint::all();
    //     return view('admin.response-complaint', compact('laboratoriums'));
    // }
}
