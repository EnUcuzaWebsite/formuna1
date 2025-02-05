<?php

use App\Livewire\Home;
use App\Models\Log;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// test route
Route::get('/test', function () {
    $user = auth()->user();

    $user_logs = Log::where('user_id', $user->id)->get();

    dd($user_logs->toArray());
});

Volt::route('/login', 'pages.auth.login')->name('login');
Route::get('/logout', function () {
    Auth::logout();

    return redirect()->route('login');
})->name('logout');

// Protected routes
Route::group(['middleware' => 'auth'], function () {
    Volt::route('/', Home::class)->name('home');
    Volt::route('/post/{post}', \App\Livewire\PostDetail::class)->name('post.show');
});

require __DIR__.'/auth.php';
