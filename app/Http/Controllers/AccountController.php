<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class AccountController extends Controller
{
  public function home(): Response
  {
    return Inertia::render("Account/Home", [
      'user' => Auth::user()
    ]);
  }

  public function update(Request $request): RedirectResponse
  {
    $user = Auth::user();

    $request->validate([
      'name' => 'required|string|min:3',
      'email' => 'required|string|email|max:255|unique:users,email,' . $user->id . ',id',
      'address' => 'required|string|max:255',
      'phone' => 'required|numeric|min:3',
    ], [
      'name.required' => 'Nama Tidak Boleh Kosong!',
      'name.min' => 'Nama Minimal Terdiri Dari 3 Karakter!',
      'email.required' => 'Alamat Email Tidak Boleh Kosong!',
      'email.email' => 'Format Email Tidak Sesuai!',
      'email.unique' => 'Alaman Email Ini Sudah Digunakan!',
      'address.required' => 'Alamat Tidak Boleh Kosong!',
      'phone.required' => 'No Telephone Tidak Boleh Kosong!',
      'phone.numeric' => 'No Telephone Harus Berupa Angka!'
    ]);

    if ($request->input('old_password')) {
      $request->validate([
        'old_password' => 'required',
        'password' => 'required',
      ], [
        'password.required' => 'Kata Sandi Baru Tidak Boleh Kosong!'
      ]);

      if (!Hash::check($request->input('old_password'), Auth::user()->password)) {
        return Redirect::route('account.home')->withErrors([
          'old_password' => 'Kata Sandi Lama Tidak Sesuai! Code: ' . strtoupper(Str::random(5))
        ]);
      }

      User::find($user->id)->update([
        'password' => Hash::make($request->password)
      ]);
    }

    User::find($user->id)->update([
      'name' => $request->name,
      'email' => $request->email,
      'avatar' => "https://gravatar.com/avatar/" . hash("sha256", $request->email),
      'updated_at' => Carbon::now()
    ]);

    return Redirect::route('account.home')->with('status', 'Berhasil Mengubah Data User! Code: ' . strtoupper(Str::random(5)));
  }
}
