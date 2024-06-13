<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/home', 'home')
            ->name('home');
        Route::get('/dashboard', 'dashboard')
            ->name('dashboard');
    });
    Route::controller(AppointmentController::class)->group(function () {
        Route::prefix('/appointment')->group(function () {
            Route::get('/', 'home')
                ->name('appointment.home');
            Route::post('/create', 'create')
                ->name('appointment.create');
        });
        Route::prefix('/dashboard/appointment')->group(function () {
            Route::get('/', 'manage')
                ->name('appointment.manage');
            Route::get('/view/{id}', 'view')
                ->name('appointment.view');
            Route::post('/status/{id}/{action}', 'status')
                ->name('appointment.status');
            Route::get('/review/{id}', 'review')
                ->name('appointment.review');
            Route::post('/completed/{id}', 'completed')
                ->name('appointment.completed');
        });
    });
    Route::controller(BlogController::class)->group(function () {
        Route::prefix('/blog')->group(function () {
            Route::get('/', 'home')
                ->name('blog.home');
            Route::get('/view/{slug}', 'view')
                ->name('blog.view');
        });
        Route::prefix('/dashboard/blog')->group(function () {
            Route::get('/', 'manage')
                ->name('blog.manage');
            Route::get('/create', 'create')
                ->name('blog.create');
            Route::post('/post', 'post')
                ->name('blog.post');
            Route::get('/edit/{id}', 'edit')
                ->name('blog.edit');
            Route::post('/update', 'update')
                ->name('blog.update');
            Route::get('/preview/{slug}', 'preview')
                ->name('blog.preview');
            Route::post('/status/{id}/{action}', 'status')
                ->name('blog.status');
            Route::post('/delete/{id}', 'delete')
                ->name('blog.delete');
        });
    });
    Route::controller(JournalController::class)->group(function () {
        Route::prefix('/journal')->group(function () {
            Route::get('/', 'home')
                ->name('journal.home');
            Route::get('/view/{slug}', 'view')
                ->name('journal.view');
        });
        Route::prefix('/dashboard/journal')->group(function () {
            Route::get('/', 'manage')
                ->name('journal.manage');
            Route::get('/create', 'create')
                ->name('journal.create');
            Route::post('/post', 'post')
                ->name('journal.post');
            Route::get('/edit/{id}', 'edit')
                ->name('journal.edit');
            Route::post('/update', 'update')
                ->name('journal.update');
            Route::get('/preview/{slug}', 'preview')
                ->name('journal.preview');
            Route::post('/delete/{id}', 'delete')
                ->name('journal.delete');
        });
    });
    Route::controller(PointsController::class)->group(function () {
        Route::prefix('/points')->group(function () {
            Route::get('/', 'home')
                ->name('points.home');
            Route::post('/redeem/{amount}', 'redeem')
                ->name('points.redeem');
        });
    });
    Route::controller(UsersController::class)->prefix('/dashboard/users')
        ->group(function () {
            Route::get('/', 'home')
                ->name('users.manage');
            Route::get('/edit/{id}', 'edit')
                ->name('users.edit');
            Route::post('/update', 'update')
                ->name('users.update');
        });
    Route::controller(AccountController::class)->group(function () {
        Route::prefix('/account')->group(function () {
            Route::get('/', 'home')
                ->name('account.home');
            Route::post('/update', 'update')
                ->name('account.update');
        });
    });
    Route::post('/ckeditor', [CKEditorController::class, 'upload'])
        ->name('ckeditor');
});

require __DIR__ . '/auth.php';
