<?php

use App\Livewire\Home;
use App\Livewire\PostDetail;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Volt::route('/login', 'pages.auth.login')->name('login');
Route::get('/logout', function () {
    Auth::logout();

    return redirect()->route('login');
})->name('logout');

// Protected routes
Route::group(['middleware' => 'auth'], function () {
    Volt::route('/', Home::class)->name('home');

});

require __DIR__ . '/auth.php';
