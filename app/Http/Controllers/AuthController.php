<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phoneNo' => 'required',
            'password' => 'required|min:3',
        ]);

        // Membuat pengguna baru
        $user = User::create([  
            'name' => $request->name,
            'address' => $request->address,
            'phoneNo' => $request->phoneNo,
            'password' => bcrypt($request->password),
        ]);

        Session::flash('status','Register Success');
        return redirect ('/');
    }

    public function authenticating(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if(Auth::user()->role_id == 1) {
                return redirect('index');
            } elseif(Auth::user()->role_id == 2) {
                return redirect('dashboard');
            } else {
                return redirect ('/');
            }

        } else {
            Session::flash('message','Account not found');
            return redirect('/');
        }
    }

    

    
}
