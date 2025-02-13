<?php

use App\Livewire\Home;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// test route
Route::get('/test', function () {
    $user = \App\Models\User::find(2);
    dd($user->find_id);
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
    Volt::route('/user-detail/{user}', \App\Livewire\UserDetails::class )->name('user.details');
    Volt::route("/saved", \App\Livewire\SavedFormsComponent::class)->name('saved.forms');
    Volt::route("/liked", \App\Livewire\LikedFormComponent::class)->name('liked.forms');
    Volt::route("/categories", \App\Livewire\CategoryComponent::class)->name('categories');
});

require __DIR__.'/auth.php';
