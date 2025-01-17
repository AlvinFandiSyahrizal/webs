<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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




Route::get('/', function () {
    return view('welcome');
});



Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'processLogin'])->name('login.process');
Route::get('/dashboard', [LoginController::class, 'showDashboard'])->name('dashboard');

use App\Http\Controllers\UserController;


use App\Http\Controllers\DashboardController;






Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'processLogin'])->name('login.process');
Route::get('/dashboard', [LoginController::class, 'showDashboard'])->name('dashboard');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::resource('users', UserController::class);


// Route::post('/logout', function () {
//     Auth::logout();
//     return redirect()->route('login');
// })->name('logout');