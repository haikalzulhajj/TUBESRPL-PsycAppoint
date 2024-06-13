<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class JournalController extends Controller
{
  public function home(Request $request): Response
  {
    return Inertia::render('Journal/Home', [
      'journals' => Journal::where([
        ['creator', '=', Auth::user()->id],
        ['title', $request->query('search') ? 'like' : '<>', $request->query('search') ? '%' . $request->query('search') . '%' : null]
      ])->join('users', 'journals.creator', '=', 'users.id')->select('slug', 'title', 'preview', 'users.name as creator', 'journals.created_at', 'users.avatar')->orderBy('created_at', 'desc')->paginate(10)->withQueryString()
    ]);
  }

  public function create(): Response
  {
    return Inertia::render('Dashboard/Journal/Create');
  }

  public function post(Request $request)
  {
    $user = Auth::user();

    $request->validate([
      'title' => 'required|max:255',
      'content' => 'required'
    ], [
      'title.required' => 'Judul Tidak Boleh Kosong!',
      'title.max' => 'Judul Tidak Boleh Lebih Dari 255 Karakter!',
      'content.required' => 'Konten Tidak Boleh Kosong!'
    ]);

    Journal::insert([
      'id' => Str::ulid(),
      'slug' => Str::of($request->input('title'))->slug('-'),
      'title' => $request->input('title'),
      'preview' => strip_tags(preg_replace('/((\w+\W*){' . (24) . '}(\w+))(.*)/', '${1}', $request->input('content')), '<br/>'),
      'content' => $request->input('content'),
      'creator' => $user->id,
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now()
    ]);

    return Redirect::route("journal.manage")->with('status', 'Sukses Membuat Journal!');
  }

  public function view($slug): Response | RedirectResponse
  {
    $journal = Journal::where('slug', $slug)->join('users', 'journals.creator', '=', 'users.id')->select('slug', 'title', 'content', 'users.name as creator', 'journals.created_at', 'users.avatar')->first();

    if (!$journal) {
      return Redirect::route('journal.home');
    }

    return Inertia::render('Journal/View', [
      'journal' => $journal
    ]);
  }

  public function manage(Request $request): Response
  {
    $user = Auth::user();

    return Inertia::render('Dashboard/Journal/Home', [
      'journals' => Journal::where([
        ['creator', '=', $user->id],
        ['title', $request->query('search') ? 'like' : '<>', $request->query('search') ? '%' . $request->query('search') . '%' : null]
      ])->join('users', 'journals.creator', '=', 'users.id')->select('journals.id', 'slug', 'title', 'users.name as creator', 'users.avatar', 'journals.created_at')->orderBy('created_at', 'desc')->paginate(10)->withQueryString()
    ]);
  }

  public function preview($slug): Response
  {
    $journal = Journal::where('slug', $slug)->join('users', 'journals.creator', '=', 'users.id')->select('journals.id', 'slug', 'title', 'content', 'users.name as creator', 'journals.created_at', 'users.avatar')->first();

    if (!$journal) {
      return Redirect::route('journal.manage');
    }

    return Inertia::render('Dashboard/Journal/Preview', [
      'journal' => $journal
    ]);
  }

  public function edit($id): Response | RedirectResponse
  {
    $journal = Journal::where('id', $id)->first();

    if (!$journal) {
      return Redirect::route('journal.manage');
    }

    return Inertia::render('Dashboard/Journal/Edit', [
      'journal' => $journal
    ]);
  }

  public function update(Request $request)
  {
    $request->validate([
      'title' => 'required|max:255',
      'content' => 'required'
    ], [
      'title.required' => 'Judul Tidak Boleh Kosong!',
      'title.max' => 'Judul Tidak Boleh Lebih Dari 255 Karakter!',
      'content.required' => 'Konten Tidak Boleh Kosong!'
    ]);

    Journal::where('id', $request->input('id'))->update([
      'slug' => Str::of($request->input('title'))->slug('-'),
      'title' => $request->input('title'),
      'preview' => strip_tags(preg_replace('/((\w+\W*){' . (24) . '}(\w+))(.*)/', '${1}', $request->input('content')), '<br/>'),
      'content' => $request->input('content'),
      'updated_at' => Carbon::now()
    ]);

    return Redirect::route("journal.manage")->with('status', 'Sukses Mengupdate Journal!');
  }

  public function delete($id)
  {
    $query = Journal::where('id', $id);

    $blog = $query->first();

    Storage::delete('public/' . $blog->heading);

    Journal::where('id', $id)->delete();

    return Redirect::route("journal.manage")->with('status', 'Sukses Menghapus Journal!');
  }
}
