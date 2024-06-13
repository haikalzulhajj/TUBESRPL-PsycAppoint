<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'address' => 'required|string|max:255',
            'phone' => 'required|numeric|min:3',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'name.required' => 'Nama Tidak Boleh Kosong!',
            'name.min' => 'Nama Minimal Terdiri Dari 3 Karakter!',
            'email.required' => 'Email Tidak Boleh Kosong!',
            'email.email' => 'Email Tidak Sesuai!',
            'email.unique' => 'Email Sudah Digunakan!',
            'address.required' => 'Alamat Tidak Boleh Kosong!',
            'phone.required' => 'No Telephone Tidak Boleh Kosong!',
            'phone.numeric' => 'No Telephone Harus Berupa Angka!',
            'phone.min' => 'No Telephone Minimal Terdiri Dari 3 Angka!',
            'password.required' => 'Kata Sandi Tidak Boleh Kosong!',
            'password.confirmed' => 'Konfirmasi Kata Sandi Tidak Sama!',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone_number' => $request->phone,
            'avatar' => "https://gravatar.com/avatar/" . hash("sha256", $request->email),
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home', absolute: false));
    }
}
