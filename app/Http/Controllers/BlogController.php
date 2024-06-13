<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class BlogController extends Controller
{
  public function home(Request $request): Response
  {
    return Inertia::render('Blog/Home', [
      'blogs' => Blog::where([
        ['status', '=', 'accepted'],
        ['title', $request->query('search') ? 'like' : '<>', $request->query('search') ? '%' . $request->query('search') . '%' : null]
      ])->join('users', 'blogs.creator', '=', 'users.id')->select('slug', 'title', 'heading', 'preview', 'users.name as creator', 'blogs.created_at', 'users.avatar')->orderBy('created_at', 'desc')->paginate(6)->withQueryString()
    ]);
  }

  public function create(): Response
  {
    return Inertia::render('Dashboard/Blog/Create');
  }

  public function post(Request $request)
  {
    $user = Auth::user();

    $request->validate([
      'title' => 'required|max:255',
      'heading' => 'required|mimes:jpeg,jpg,png|max:10240',
      'content' => 'required'
    ], [
      'title.required' => 'Judul Tidak Boleh Kosong!',
      'title.max' => 'Judul Tidak Boleh Lebih Dari 255 Karakter!',
      'heading.required' => 'Heading Tidak Boleh Kosong!',
      'heading.max' => 'Ukuran File Tidak Boleh Lebih Dari 10MB!',
      'content.required' => 'Konten Tidak Boleh Kosong!'
    ]);

    $file = $request->file('heading');
    $name = Str::random() . '.' . $file->extension();

    Storage::putFileAs('public/post', $file, $name);

    Blog::insert([
      'id' => Str::ulid(),
      'slug' => Str::of($request->input('title'))->slug('-'),
      'heading' => 'post/' . $name,
      'title' => $request->input('title'),
      'preview' => strip_tags(preg_replace('/((\w+\W*){' . (24) . '}(\w+))(.*)/', '${1}', $request->input('content')), '<br/>'),
      'content' => $request->input('content'),
      'creator' => $user->id,
      'status' => $user->role != 'user' || $user->service != 'none' ? 'accepted' : 'pending',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now()
    ]);

    return Redirect::route("blog.manage")->with('status', 'Sukses Membuat Blog!');
  }

  public function view($slug): Response | RedirectResponse
  {
    $blog = Blog::where('slug', $slug)->join('users', 'blogs.creator', '=', 'users.id')->select('slug', 'title', 'heading', 'content', 'users.name as creator', 'blogs.created_at', 'users.avatar')->first();

    if (!$blog) {
      return Redirect::route("blog.home");
    }

    return Inertia::render('Blog/View', [
      'blog' => $blog
    ]);
  }

  public function manage(Request $request): Response
  {
    $user = Auth::user();

    return Inertia::render('Dashboard/Blog/Home', [
      'blogs' => Blog::where([
        ['title', $request->query('search') ? 'like' : '<>', $request->query('search') ? '%' . $request->query('search') . '%' : null],
        ['creator', $user->role == 'root' | $user->role == 'admin' ? '<>' : '=', $user->role == 'root' | $user->role == 'admin' ? null : $user->id]
      ])->join('users', 'blogs.creator', '=', 'users.id')->select('blogs.id', 'slug', 'title', 'heading', 'users.name as creator', 'users.avatar', 'blogs.created_at', 'status')->orderBy('created_at', 'desc')->paginate(10)->withQueryString()
    ]);
  }

  public function preview($slug): Response | RedirectResponse
  {
    $blog = Blog::where('slug', $slug)->join('users', 'blogs.creator', '=', 'users.id')->select('blogs.id', 'slug', 'title', 'heading', 'content', 'users.name as creator', 'blogs.created_at', 'users.avatar', 'status')->first();

    if (!$blog) {
      return Redirect::route("blog.manage");
    }

    return Inertia::render('Dashboard/Blog/Preview', [
      'blog' => $blog
    ]);
  }

  public function edit($id): Response | RedirectResponse
  {
    $blog = Blog::where('id', $id)->first();

    if (!$blog) {
      return Redirect::route("blog.manage");
    }

    return Inertia::render('Dashboard/Blog/Edit', [
      'blog' => $blog
    ]);
  }

  public function update(Request $request)
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

    if ($request->hasFile('heading')) {
      $request->validate([
        'heading' => 'required|mimes:jpeg,jpg,png|max:10240',
      ], [
        'heading.required' => 'Heading Tidak Boleh Kosong!',
        'heading.max' => 'Ukuran File Tidak Boleh Lebih Dari 10MB!'
      ]);

      Storage::delete('public/' . $request->input('old_heading'));

      $file = $request->file('heading');
      $name = Str::random() . '.' . $file->extension();

      Storage::putFileAs('public/post', $file, $name);

      Blog::where('id', $request->input('id'))->update([
        'heading' => 'post/' . $name
      ]);
    }

    Blog::where('id', $request->input('id'))->update([
      'slug' => Str::of($request->input('title'))->slug('-'),
      'title' => $request->input('title'),
      'preview' => strip_tags(preg_replace('/((\w+\W*){' . (24) . '}(\w+))(.*)/', '${1}', $request->input('content')), '<br/>'),
      'content' => $request->input('content'),
      'status' => $user->role != 'user' ? '	accepted' : 'pending',
      'updated_at' => Carbon::now()
    ]);

    return Redirect::route('blog.manage')->with('status', 'Sukses Mengupdate Blog!');
  }

  public function status($id, $action)
  {
    $blog = Blog::where('id', $id);

    if ($action == 'accepted' && $blog->first()->points == 0) {
      User::find($blog->first()->creator)->increment('points', 10);
    }

    $blog->update([
      'status' => $action,
      'points' => true,
      'updated_at' => Carbon::now()
    ]);

    return Redirect::route('blog.manage')->with('status', 'Sukses Mengupdate Status Blog!');
  }

  public function delete($id)
  {
    $query = Blog::where('id', $id);

    $blog = $query->first();

    Storage::delete('public/' . $blog->heading);

    Blog::where('id', $id)->delete();

    return Redirect::route("blog.manage")->with('status', 'Sukses Menghapus Blog!');
  }
}
