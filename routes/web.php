<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\keckelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\forumanakController;
use App\Http\Controllers\CFCIController;

use App\Http\Controllers\SuaraAnakController;
use App\Http\Controllers\pisaController;



use App\Http\Controllers\KlasterController;


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
Route::get('/CFCI/Kegiatan', [CFCIController::class, 'Kegiatan'])->name('CFCIKegiatan');
Route::get('/CFCI/SK', [CFCIController::class, 'HalamanCFCISk'])->name('CFCISK');
Route::get('/CFCI/ArtikelKegiatan', [CFCIController::class, 'CFCIArtikel'])->name('HalamanArtikel');
Route::get('/CFCI/Galeri', [CFCIController::class, 'galeri'])->name('HalamanGaleri');
Route::get('/CFCI/SkKecamatan', [CFCIController::class, 'CFCIKecamatann'])->name('CFCIKecamatann'); //bagian kecamatan 
Route::get('/CFCI/SKKelurahan', [CFCIController::class, 'CFCIKelurahan'])->name('SkKelurahan');

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

Route::get('/haksipil', [KlasterController::class, 'haksipildankebebasan'])->name('haksipil');
Route::get('/kelembagaan', [KlasterController::class, 'kelembagaan'])->name('kelembagaan');
Route::get('/kesehatan-dasar', [KlasterController::class, 'kesehatandasar'])->name('kesehatan-dasar');
Route::get('/lingkungan-keluarga', [KlasterController::class, 'lingkungankeluarga'])->name('lingkungan-keluarga');
Route::get('/pendidikan-pemanfaatan', [KlasterController::class, 'pendidikanpemanfaatan'])->name('pendidikan-pemanfaatan');
Route::get('/perlindungan-khusus', [KlasterController::class, 'PerlindunganKhusus'])->name('perlindungan-khusus');
// BATAS BAGIAN HALAMAN KLASTER


// HALAMAN BAGIAN KOTA LAYAK ANAK

// BATAS HALAMAN BAGIAN KOTA LAYAK ANAK

// HALAMAN BAGIAN PISA

// BATAS HALAMAN PISA
Route::get('/dokumenPisa', [pisaController::class, 'dokumenPisa'])->name('HalamanPisa');
Route::get('/KegiatanPisa', [pisaController::class, 'KegiatanPisa'])->name('KegiatanPisa');

// HALAMAN BAGIAN SUARA ANAK
Route::get('/PantauSuaraAnak', [SuaraAnakController::class, 'PsuaraAnak'])->name('suaraanak');
Route::get('/KaryaAnak', [SuaraAnakController::class, 'karyaAnak'])->name('KaryaAnak');

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
