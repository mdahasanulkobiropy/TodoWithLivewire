<?php

use App\Livewire\HomePage;
use App\Livewire\LoginPage;
use App\Livewire\LogoutPage;
use App\Livewire\RegistrationPage;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', LoginPage::class);
    Route::get('/registration', RegistrationPage::class);
});
Route::get('/', HomePage::class);
Route::get('/logout', LogoutPage::class);
