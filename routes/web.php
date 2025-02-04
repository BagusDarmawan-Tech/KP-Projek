<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\forumanakController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\keckelController;
use App\Http\Controllers\ProfileController;
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

Route::get('/galeri', [GaleriController::class, 'galeri'])->name('galeri');
Route::get('/skkec', [forumanakController::class, 'skkec'])->name('Skkec');
Route::get('/skkel', [forumanakController::class, 'skkel'])->name('Skkel');
Route::get('/kasrpa', [keckelController::class, 'kasrpa'])->name('Kasrpa');
Route::get('/pemantauananak', [forumanakController::class, 'pemantauananak'])->name('pemantauananak');
Route::get('/kegareksby', [forumanakController::class, 'kegareksby'])->name('kegareksby');


Route::get('/', function () {
    return view('frontend.HalamanHome');
});

Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
