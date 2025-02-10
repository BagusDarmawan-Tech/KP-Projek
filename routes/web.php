<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CFCIController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\pisaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KlasterController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\forumanakController;



use App\Http\Controllers\SuaraAnakController;
use App\Http\Controllers\KotaLayakAnakController;


use App\Http\Controllers\WebManagementController;
use App\Http\Controllers\KecamatanLayakController;
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
Route::get('/pemantauananak', [forumanakController::class, 'pemantauananak'])->name('pemantauananak');
Route::get('/kegareksby', [forumanakController::class, 'kegareksby'])->name('kegareksby');
Route::get('/kegiatan-forum-anak-kelurahan', [forumanakController::class, 'kegiatanforumanakkelurahan'])->name('kegiatanforumanakkelurahan');
Route::get('/kegiatan-forum-anak-kecamatan', [forumanakController::class, 'kegiatanforumanakkecamatan'])->name('kegiatanforumanakkecamatan');


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
Route::get('/kasrpa', [KotaLayakAnakController::class, 'kasrpa'])->name('Kasrpa');
Route::get('/kegiatan-kecamatan-layak-anak', [KotaLayakAnakController::class, 'kegiatankecamatanlayakanak'])->name('kegiatankecamatanlayakanak');
Route::get('/kegiatan-kelurahan-layak-anak', [KotaLayakAnakController::class, 'kegiatankelurahanlayakanak'])->name('kegiatankelurahanlayakanak');
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

//Landing Page
Route::get('/', function () {return view('frontend.content.landing-page');})->name('content');


//=======================  Backend  =============================//
//sesi waktu login
Route::get('/session-keep-alive', function () {
    session()->put('lastActivityTime', time());
    session()->put('sessionExpiresAt', time() + (config('session.lifetime') * 60));
    return response()->json(['sessionUpdated' => true]);
});

//Web Management
Route::middleware('auth')->group(function () {
    Route::get('/slider', [WebManagementController::class, 'slider'])->name('slider');
    Route::get('/sub-kegiatan', [WebManagementController::class, 'subkegiatan'])->name('sub-kegiatan');
    Route::get('/galeri', [WebManagementController::class, 'galeri'])->name('galeri');
    Route::get('/forum-anak', [WebManagementController::class, 'forumanak'])->name('forum-anak');
});

//Kecamatan Layak Anak
Route::middleware('auth')->group(function () {
    Route::get('/dokumen-kec', [KecamatanLayakController::class, 'dokumenkec'])->name('dokumen-kec');
    
});

//Logout
Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');

//Register
Route::get('register', [RegisteredUserController::class, 'create'])
            ->name('register')->middleware(['auth', 'verified','role:developer']);
Route::post('register', [RegisteredUserController::class, 'store']);

//Dashboard
Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');


//Ganti password
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
//======================= END Backend  =============================//
