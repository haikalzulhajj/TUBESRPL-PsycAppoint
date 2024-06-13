<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class UsersController extends Controller
{
  public function home(Request $request): Response
  {
    $user = Auth::user();

    if ($user->role == 'user') {
      return Redirect::route('dashboard');
    }

    return Inertia::render('Dashboard/Users/Home', [
      'users' => User::where([
        ['id', '<>', $user->id],
        ['role', $user->role == 'root' ? '<>' : '=', $user->role == 'root' ?  'root' : 'user'],
        ['name', $request->query('search') ? 'like' : '<>', $request->query('search') ? '%' . $request->query('search') . '%' : null]
      ])->orderBy('created_at', 'desc')->paginate(10)->withQueryString()
    ]);
  }

  public function edit($id): Response | RedirectResponse
  {
    $user = Auth::user();

    if ($user->role == 'user') {
      return Redirect::route('dashboard');
    }

    $user = User::where([
      ['id', '=', $id],
      ['id', '<>', $user->id]
    ])->first();

    if (!$user) {
      return Redirect::route('users.manage');
    }

    return Inertia::render('Dashboard/Users/Edit', [
      'user' => $user
    ]);
  }

  public function update(Request $request): RedirectResponse
  {
    $user = Auth::user();

    if ($user->role == 'user') {
      return Redirect::route('dashboard');
    }

    $request->validate([
      'id' => 'required|ulid',
      'email' => 'required|string|lowercase|email|max:255|unique:users,email,' . $request->input('id') . ',id',
      'service' => 'required|string|max:255',
      'role' => 'required|string|lowercase|max:255',
    ], [
      'email.required' => 'Alamat Email Tidak Boleh Kosong!',
      'email.email' => 'Format Email Tidak Sesuai!',
      'email.unique' => 'Alaman Email Ini Sudah Digunakan!',
    ]);

    User::find($request->input('id'))->update([
      'email' => $request->input('email'),
      'service' => $request->input('service'),
      'role' => $request->input('role'),
      'updated_at' => Carbon::now()
    ]);

    return Redirect::route('users.manage')->with('status', 'Berhasil Mengubah Data User!');
  }
}
