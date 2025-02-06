<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\keckelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\forumanakController;
use App\Http\Controllers\CFCIController;
use App\Http\Controllers\CFCISkController;

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
// HalamanCFCISk
// Route::get('/galeri', [GaleriController::class, 'galeri'])->name('galeri');


// Route halaman CFCI
Route::get('/CFCI/Kegiatan', [CFCIController::class, 'HalamanCFCI'])->name('CFCIKegiatan');
Route::get('/CFCI/SK', [CFCIController::class, 'HalamanCFCISk'])->name('CFCISK');
Route::get('/CFCI/ArtikelKegiatan', [CFCIController::class, 'ArtikelKegiatan'])->name('HalamanArtikel');
Route::get('/CFCI/Galeri', [CFCIController::class, 'GaleriCFCI'])->name('HalamanGaleri');
Route::get('/CFCI/Sk-Kecamatan', [CFCIController::class, 'SkKecamatan'])->name('CFCISkecam');
Route::get('/CFCI/SK-Kelurahan', [CFCIController::class, 'SkKelurahan'])->name('SkKelurahan');

Route::get('/CFCI/SK-Kecamatan', [CFCIController::class, 'Ckecamatan'])->name('Ckecamatan');

// BATAS SELESAI Route halaman CFCI

// ROUTE HALAMAN GALERI
Route::get('/Galeri-Kota-Layak-Anak', [GaleriController::class, 'galeriKotaLayakAnak'])->name('galeri-kota-layakanak');
Route::get('/Galeri-Anak', [GaleriController::class, 'GaleriAnak'])->name('GaleriAnak');
// SELESAI HALAMAN GALERI


// BATAS HALAMAN FORUM ANAK 

Route::get('/skkec', [forumanakController::class, 'skkec'])->name('Skkecam');
Route::get('/skkel', [forumanakController::class, 'skkel'])->name('Skkel');
Route::get('/kasrpa', [keckelController::class, 'kasrpa'])->name('Kasrpa');
Route::get('/pemantauananak', [forumanakController::class, 'pemantauananak'])->name('pemantauananak');
Route::get('/kegareksby', [forumanakController::class, 'kegareksby'])->name('kegareksby');

Route::get('/coba', [forumanakController::class, 'coba'])->name('coba');

// ROUTE HALAMAN FORUM ANAK

// HALAMAN BAGIAN KLASTER

// BATAS BAGIAN HALAMAN KLASTER


// HALAMAN BAGIAN KOTA LAYAK ANAK

// BATAS HALAMAN BAGIAN KOTA LAYAK ANAK

// HALAMAN BAGIAN PISA

// BATAS HALAMAN PISA

// HALAMAN BAGIAN SUARA ANAK

// BATAS HALAMAN BAGIAN SUARA ANAK

// HALAMAN BAGIAN MITRA ANAK

// BATAS HALAMAN BAGIAN MITRA ANAK


Route::get('/', function () {return view('frontend.content.landing-page');})->name('content');


//Backend autentikasi 

//Logout
Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/loop', function () {
    return ('<h1>Admin</h1>');
})->middleware(['auth', 'verified','role:developer']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
