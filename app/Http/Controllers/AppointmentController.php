<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class AppointmentController extends Controller
{
  public function home(): Response
  {
    return Inertia::render("Appointment/Home", [
      'specialists' => User::where([['service', '<>', 'none'], ['id', '<>', Auth::user()->id]])->select('id', 'name', 'service')->get()
    ]);
  }

  public function create(Request $request)
  {
    $user = Auth::user();

    $request->validate([
      'id' => 'required',
      'dateTime' => 'required',
      'message' => 'required|string',
      'payment' => 'required|mimes:jpeg,jpg,png|max:10240'
    ], [
      'id.required' => 'Harap Pilih Spesialist!',
      'dateTime.required' => 'Tanggal Booking Tidak Boleh Kosong!',
      'message.required' => 'Pesan Tidak Boleh Kosong!',
      'message.string' => 'Pesan Harus Berupa Text!',
      'payment.required' => 'Bukti Pembayaran Tidak Boleh Kosong!',
      'payment.mimes' => 'Bukti Pembayaran Harus Berupa jpg, jpeg, atau png!',
      'payment.max' => 'Ukuran File Tidak Boleh Lebih Dari 10MB!',
    ]);

    $file = $request->file('payment');
    $name = Str::random() . '.' . $file->extension();

    Storage::putFileAs('public/appointment/' . $user->id . '/payment', $file, $name);

    Appointment::insert([
      'id' => Str::ulid(),
      'user_id' => $user->id,
      'specialist_id' => $request->input('id'),
      'time' => $request->input('dateTime'),
      'message' => $request->input('message'),
      'payment' => 'appointment/' . $user->id . '/payment/' . $name,
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now()
    ]);

    return Redirect::route('home')->with('status', 'Sukses Membuat Appointment!');
  }

  public function manage(Request $request): Response
  {
    $user = Auth::user();

    return Inertia::render('Dashboard/Appointment/Home', [
      'appointments' => Appointment::join(DB::raw('users u1'), 'appointments.user_id', '=', 'u1.id')->join(DB::raw('users u2'), 'appointments.specialist_id', '=', 'u2.id')->where([
        [$user->service == 'none' ? 'user_id' : 'specialist_id', '=', $user->id],
        [$user->service == 'none' ? 'u2.name' : 'u1.name', $request->query('search') ?  'like' : '<>', $request->query('search') ? '%' . $request->query('search') . '%' : null]
      ])->select('appointments.id', 'u1.id as user_id', 'u1.name as requester_name', 'u1.avatar as requester_avatar', 'u2.id as specialist_id', 'u2.name as specialist_name', 'u2.avatar as specialist_avatar', 'u2.service', 'time', 'status', 'completed')->orderBy('appointments.created_at', 'desc')->paginate(10)->withQueryString()
    ]);
  }

  public function view($id)
  {
    $user = Auth::user();

    $appointment = Appointment::join(DB::raw('users u1'), 'appointments.user_id', '=', 'u1.id')->join(DB::raw('users u2'), 'appointments.specialist_id', '=', 'u2.id')->where([
      ['appointments.id', '=', $id],
      [$user->service == 'none' ? 'appointments.user_id' : 'appointments.specialist_id', '=', $user->id]
    ])->select($user->service != 'none' ? ['appointments.id', 'u1.id as user_id', 'u1.name as requester_name', 'u1.avatar as requester_avatar', 'u2.id as specialist_id', 'u2.name as specialist_name', 'u2.avatar as specialist_avatar', 'u2.service', 'time', 'u2.address', 'message', 'payment', 'review', 'feedback', 'status', 'completed'] : ['appointments.id', 'u1.id as user_id', 'u1.name as requester_name', 'u1.avatar as requester_avatar', 'u2.id as specialist_id', 'u2.name as specialist_name', 'u2.avatar as specialist_avatar', 'u2.service', 'time', 'u2.address', 'message', 'payment', 'status', 'completed'])->first();

    if ($appointment) {
      return Inertia::render('Dashboard/Appointment/View', [
        'appointment' => $appointment
      ]);
    }

    return Redirect::route('appointment.manage');
  }

  public function status($id, $action)
  {
    $appointment = Appointment::where('id', $id);

    $message = $action == 'completed' ? 'Menyelesaikan' : ($action == 'accepted' ? 'Menerima' : 'Menolak');

    $appointment->update([
      'status' => $action,
      'completed' => $action == 'rejected' ? true : false,
      'updated_at' => Carbon::now()
    ]);

    return Redirect::route('appointment.manage')->with('status', 'Sukses ' .  $message . ' Permintaan!');
  }

  public function review($id)
  {
    $user = Auth::user();

    $appointment = Appointment::join(DB::raw('users u1'), 'appointments.user_id', '=', 'u1.id')->join(DB::raw('users u2'), 'appointments.specialist_id', '=', 'u2.id')->where([
      ['appointments.id', '=', $id],
      [$user->service == 'none' ? 'appointments.user_id' : 'appointments.specialist_id', '=', $user->id]
    ])->select($user->service != 'none' ? ['appointments.id', 'u1.id as user_id', 'u1.name as requester_name', 'u1.avatar as requester_avatar', 'u2.id as specialist_id', 'u2.name as specialist_name', 'u2.avatar as specialist_avatar', 'u2.service', 'time', 'message', 'payment', 'review', 'feedback', 'status', 'completed'] : ['appointments.id', 'u1.id as user_id', 'u1.name as requester_name', 'u1.avatar as requester_avatar', 'u2.id as specialist_id', 'u2.name as specialist_name', 'u2.avatar as specialist_avatar', 'u2.service', 'time', 'message', 'payment', 'status', 'completed'])->first();

    if ($appointment->completed != 1) {
      return Inertia::render('Dashboard/Appointment/Review', [
        'appointment' => $appointment
      ]);
    }

    return Redirect::route('appointment.manage');
  }

  public function completed($id, Request $request)
  {
    $appointment = Appointment::where('id', $id);

    $appointment->update([
      'review' => $request->input('review'),
      'feedback' => $request->input('feedback'),
      'completed' => true,
      'updated_at' => Carbon::now()
    ]);

    return Redirect::route('appointment.manage')->with('status', 'Sukses Memberikan Review & Feedback Pada Permintaan!');
  }
}
