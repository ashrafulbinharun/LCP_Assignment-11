<?php

use App\Livewire\HomeFeed;
use App\Livewire\LoginUser;
use App\Livewire\Logout;
use App\Livewire\RegisterUser;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeFeed::class)->name('home');
Route::get('/register', RegisterUser::class)->name('register');
Route::get('/login', LoginUser::class)->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/logout', Logout::class)->name('logout');
});
