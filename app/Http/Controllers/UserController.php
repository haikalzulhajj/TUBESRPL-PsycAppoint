<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getHome()
    {
        return view('customer.index');
    }

    public function createOrder()
    {
        return view('customer.order');
    }

    public function submitOrder(Request $request)
    {       
        $request->validate([
            'name' => 'required',
            'phoneNo' => 'required',
            'address' => 'required',
            'pickup_date' => 'required',
            'pickup_time' => 'required',
            'category_trash' => 'required',
            'amount' => 'required|numeric',
            'notes' => 'required',
            'file_payment' => 'required',
        ]);

        $user_id = Auth::id();

        $ordersubmission = Order::create([
            'user_id' => $user_id,
            'pickup_date'=> $request->input('pickup_date'),
            'pickup_time' => $request->input('pickup_time'),
            'category_trash'=> $request->input('category_trash'),
            'amount' => $request->input('amount'),
            'notes' => $request->input('notes'),
            'file_payment' => $request->input('file_payment'),
        ]);

        if($ordersubmission) {
            $user = User::find($user_id);
            $amount = $request->input('amount');
            if ($user) {
                $user->total_daur_ulang += $amount;
                if($amount < 10 ) {
                    $user->total_points += 5;
                } elseif ($amount > 10 && $amount < 20) {
                    $user->total_points += 10;
                } elseif ($amount > 20 ) {
                    $user->total_points += 15;
                }
                $user->save();
            }
            return view ('customer.form-success');
        }
    }

    public function getHistory()
    {
        $data_order = Order::all();
        return view('historyschedulepickup.index', ['data_order' => $data_order]);
    }
    
    public function deleteHistory($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('history')->with('success', 'Data history berhasil dihapus');
    }

    

    public function getRedeemspoints()
    {
        return view('customer.redeempoint1');
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
    
}

//     public function delete($id)
// {
//     // Cari mobil berdasarkan ID
//     $order = Order::find($id);

//     // Pastikan mobil ditemukan
//     if (!$history) {
//         return redirect()->back()->with('error', 'order tidak ditemukan.');
//     }

//     // Hapus mobil
//     $history->delete();

//     // Redirect kembali ke halaman sebelumnya dengan pesan sukses
//     return redirect()->back()->with('success', 'Mobil berhasil dihapus.');
// }






