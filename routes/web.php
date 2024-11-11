<?php

use App\Livewire\Auth\LoginUser;
use App\Livewire\Auth\Logout;
use App\Livewire\Auth\RegisterUser;
use App\Livewire\HomeFeed;
use App\Livewire\Profile\UserProfile;
use App\Livewire\Profile\UserProfileEdit;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeFeed::class)->name('home');
Route::get('/register', RegisterUser::class)->name('register');
Route::get('/login', LoginUser::class)->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/profile/{user:username}', UserProfile::class)->name('profile.index');
    Route::get('/profile/{user:username}/edit', UserProfileEdit::class)->name('profile.edit');
    Route::get('/logout', Logout::class)->name('logout');
});
