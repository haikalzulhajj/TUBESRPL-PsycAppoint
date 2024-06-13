<?php

namespace App\Http\Controllers;

use App\Models\Points;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Inertia\Inertia;

class PointsController extends Controller
{
  public function home()
  {
    return Inertia::render('Points/Home', [
      'coupons' => Points::where('user_id', Auth::user()->id)->select('id', 'coupon', 'code')->orderBy('created_at', 'desc')->paginate(10)->withQueryString()
    ]);
  }

  public function redeem($amount)
  {
    $user = Auth::user();

    if ($amount == 100 || $amount == 250 || $amount == 500 || $amount == 1000) {
      if ($user->points >= $amount) {
        User::find($user->id)->decrement('points', $amount);

        Points::insert([
          'id' => Str::ulid(),
          'user_id' => $user->id,
          'coupon' => $amount * 100,
          'code' => strtoupper(Str::random(10)),
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ]);

        return Redirect::route('points.home')->with('status', 'Berhasil Menukarkan ' . $amount . ' Points! Code: ' . strtoupper(Str::random(5)));
      }

      return Redirect::route('points.home')->withErrors([
        'points' => 'Point Kamu Tidak Cukup Untuk Membeli Kupon Rp. ' . number_format(($amount * 100), 0, ",", ".") . '! Code: ' . strtoupper(Str::random(5))
      ]);
    }

    return Redirect::route('points.home');
  }
}
