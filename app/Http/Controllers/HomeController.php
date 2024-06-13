<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
  public function home(): Response
  {
    return Inertia::render("Home", [
      'specialists' => User::where('service', '<>', 'none')->select('avatar')->get()
    ]);
  }

  public function dashboard(): RedirectResponse
  {
    return Redirect::route('appointment.manage');
  }
}
