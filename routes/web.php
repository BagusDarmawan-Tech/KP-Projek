<?php

use App\Http\Controllers\ArtikelLandingPage;
use App\Http\Controllers\ArtikelLandingPageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CFCIController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\pisaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserManagement;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConfigController;

use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KlasterController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\forumanakController;
use App\Http\Controllers\MitraAnakController;
use App\Http\Controllers\SuaraAnakController;
use App\Http\Controllers\DokumenSkCfciController;
use App\Http\Controllers\KotaLayakAnakController;
use App\Http\Controllers\landingpagescontroller;

use App\Http\Controllers\WebManagementController;
use App\Http\Controllers\KecamatanLayakController;
use App\Http\Controllers\UsulanKegiatanController;
use App\Http\Controllers\KelurahanLayakAnakController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\KegiatanArekSuroboyoController;
use App\Http\Controllers\PusatInformasiSahabatController;
use App\Http\Controllers\KegiatanForumArekSurabayaController;

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
Route::get('/CFCI/Kegiatan-arek-suroboyo', [CFCIController::class, 'kegiatanSuroboyo'])->name('HalamanGaleri');
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
Route::get('/dokumenPisa', [pisaController::class, 'dokumenPisa'])->name('HalamanPisa');
Route::get('/KegiatanPisa', [pisaController::class, 'KegiatanPisa'])->name('KegiatanPisa');

// BATAS HALAMAN PISA

// HALAMAN BAGIAN SUARA ANAK
Route::get('/PantauSuaraAnak', [SuaraAnakController::class, 'PsuaraAnak'])->name('suaraanak');
Route::get('/KaryaAnak', [SuaraAnakController::class, 'karyaAnak'])->name('KaryaAnak');


// HALAMAN MITRA ANAK
Route::get('/HalamanArtikelMitra', [ArtikelLandingPageController::class, 'ArtikelMitraAnak'])->name('HArtikelMitra');
Route::get('/HalamanKegiatanMitra', [ArtikelLandingPageController::class, 'KegiatanMitraAnak'])->name('HKegiatanMitra');




//Landing Page
// Route::get('/', function () {return view('frontend.content.landing-page');})->name('content');
Route::get('/', [landingpagescontroller::class, 'slider'])->name('content');



//=======================  Backend  =============================//
//Bagian Kelurahan Layak Anak
Route::middleware('auth')->group(function () {
    Route::get('/KelurahanLayakAnak', [KelurahanLayakAnakController::class, 'HalamanDokumenLayakAnak'])
        ->name('HalamanDokument')
        ->middleware(['auth', 'verified', 'can:dokumen kelurahan-list']);

    Route::get('/KegiatanLayakAnak', [KelurahanLayakAnakController::class, 'KegiatanKelurahanAnak'])
        ->name('Kegiatankelurahan')
        ->middleware(['auth', 'verified', 'can:kegiatan kelurahan-list']);
        

    //tambah
    Route::post('/createDokumenKelurahan', [KelurahanLayakAnakController::class, 'storeDokumenKelurahan'])
        ->name('createDokumenKelurahan')
        ->middleware(['auth', 'verified', 'can:dokumen kelurahan-add']);

    Route::post('/createKegiatanKelurahan', [KelurahanLayakAnakController::class, 'storeKegiatanKelurahan'])
        ->name('createKegiatanKelurahan')
        ->middleware(['auth', 'verified', 'can:kegiatan kelurahan-add']);

    //edit
    Route::put('/dokumenKelurahan/update/{id}', [KelurahanLayakAnakController::class, 'updateDokumenKelurahan'])
        ->name('updateDokumenKelurahan')
        ->middleware(['auth', 'verified', 'can:dokumen kelurahan-edit']);

    Route::put('/kegiatanKelurahan/update/{id}', [KelurahanLayakAnakController::class, 'updateKegiatanKelurahan'])
        ->name('updateKegiatanKelurahan')
        ->middleware(['auth', 'verified', 'can:kegiatan kelurahan-add']);
    
    //delete
    Route::delete('/dokumenKelurahan/hapus/{id}', [KelurahanLayakAnakController::class, 'destroyDokumenKelurahan'])
        ->name('destroyDokumenKelurahan')
        ->middleware(['auth', 'verified', 'can:dokumen kelurahan-delete']);

    Route::delete('/kegiatanKelurahan/hapus/{id}', [KelurahanLayakAnakController::class, 'destroyKegiatanKelurahan'])
        ->name('destroyKegiatanKelurahan')
        ->middleware(['auth', 'verified', 'can:kegiatan kelurahan-delete']);
});


// Halaman Pusat Informasi Sahabat Anak
Route::middleware('auth')->group(function () {
    Route::get('/HalamananDokumenPisa', [PusatInformasiSahabatController::class, 'HalamanDokumen'])
        ->name('DokumenLayakAnak')
        ->middleware(['auth', 'verified', 'can:dokumen pisa-list']);

    Route::get('/HalamananKegiatanPisa', [PusatInformasiSahabatController::class, 'HalamanKegiatan'])
        ->name('KegiatanLayakanak')
        ->middleware(['auth', 'verified', 'can:kegiatan pisa-list']);

    // Tambah
    Route::post('/createDokumenPisa', [PusatInformasiSahabatController::class, 'storeDokumenPisa'])
        ->name('createDokumenPisa')
        ->middleware(['auth', 'verified', 'can:dokumen pisa-add']);

    Route::post('/createKegiatanPisa', [PusatInformasiSahabatController::class, 'storeKegiatanPisa'])
        ->name('createKegiatanPisa')
        ->middleware(['auth', 'verified', 'can:kegiatan pisa-add']);

    //edit
    Route::put('/DokumenPisa/update/{id}', [PusatInformasiSahabatController::class, 'updateDokumenPisa'])
        ->name('updateDokumenPisa')
        ->middleware(['auth', 'verified', 'can:dokumen pisa-edit']);

    Route::put('/kegiatanPisa/update/{id}', [PusatInformasiSahabatController::class, 'updateKegiatanPisa'])
        ->name('updateKegiatanPisa')
        ->middleware(['auth', 'verified', 'can:kegiatan pisa-edit']);

    //delete
    Route::delete('/halamanDokumenPisa/hapus/{id}', [PusatInformasiSahabatController::class, 'destroyHalamanDokumenPisa'])
        ->name('destroyHalamanDokumenPisa')
        ->middleware(['auth', 'verified', 'can:dokumen pisa-delete']);

    Route::delete('/kegiatanPisa/hapus/{id}', [PusatInformasiSahabatController::class, 'destroyKegiatanPisa'])
        ->name('destroyKegiatanPisa')
        ->middleware(['auth', 'verified', 'can:kegiatan pisa-delete']);

});

// Halaman Kegiatan Forum Anak surabaya
Route::middleware('auth')->group(function () {
    Route::get('/HalamanForumAnakaSurabaya', [KegiatanForumArekSurabayaController::class, 'HalamanForum'])
        ->name('KegiatanForumSurabaya')
        ->middleware(['auth', 'verified', 'can:kegiatan forum anak suroboyo-list']);

    //create
    Route::post('/createForumAnakSurabaya', [KegiatanForumArekSurabayaController::class, 'storeForumAnakSurabaya'])
        ->name('createForumAnakSurabaya')
        ->middleware(['auth', 'verified', 'can:kegiatan forum anak suroboyo-add']);

    //update
    Route::put('/halamanForum/update/{id}', [KegiatanForumArekSurabayaController::class, 'updateHalamanForum'])
        ->name('updateHalamanForum')
        ->middleware(['auth', 'verified', 'can:kegiatan forum anak suroboyo-edit']);

    //delete
    Route::delete('/halamanForumAnakSurabaya/hapus/{id}', [KegiatanForumArekSurabayaController::class, 'destroyHalamanForum'])
        ->name('destroyHalamanForum')
        ->middleware(['auth', 'verified', 'can:kegiatan forum anak suroboyo-delete']);


});

// Halaman Config
Route::middleware('auth')->group(function () {
    //read
    Route::get('/HalamanRoleManagement', [ConfigController::class, 'RoleManagementt'])
        ->name('HalamanRole')
        ->middleware(['auth', 'verified', 'can:role management-list']);

    Route::get('/HalamanConfigurasiAPP', [ConfigController::class, 'ConfigurasiAPP'])
        ->name('HalamanConfigurasi')
        ->middleware(['auth', 'verified', 'can:configurasi app-list']);
    
    Route::get('/admin/config', [UserManagement::class, 'UserManagement'])
        ->name('UserManagement')
        ->middleware(['auth', 'verified', 'can:user management-list']);

    Route::get('/role/{role}/edit', [ConfigController::class, 'RoleEdit'])
        ->name('EditRole')
        ->middleware(['auth', 'verified', 'can:role management-edit']);

    //tambah
    Route::post('/createConfigurasiAPP', [ConfigController::class, 'storeConfigurasiAPP'])
        ->name('createConfigurasiAPP')
        ->middleware(['auth', 'verified', 'can:configurasi app-add']);
    

    Route::post('/role/create', [ConfigController::class, 'storeRoleManagement'])
        ->name('storeRoleManagement')
        ->middleware(['auth', 'verified', 'can:role management-add']);

    //edit
    Route::put('/configurasiAPP/update/{id}', [ConfigController::class, 'updateConfigurasiAPP'])
        ->name('updateConfigurasiAPP')
        ->middleware(['auth', 'verified', 'can:configurasi app-edit']);

    Route::put('/admin/{role}', [ConfigController::class, 'update'])
        ->name('updateRole')
        ->middleware(['auth', 'verified', 'can:role management-edit']);

    //delete
    Route::delete('/ConfigurasiAPP/hapus/{id}', [ConfigController::class, 'destroyConfigurasiAPP'])
        ->name('destroyConfigurasiAPP')
        ->middleware(['auth', 'verified', 'can:configurasi app-delete']);

    Route::delete('/role/delete/{role}', [ConfigController::class, 'destroy'])
        ->name('deleteRole')
        ->middleware(['auth', 'verified', 'can:role management-delete']);

});



//Backend autentikasi 
//sesi waktu login
Route::get('/session-keep-alive', function () {
    session()->put('lastActivityTime', time());
    session()->put('sessionExpiresAt', time() + (config('session.lifetime') * 60));
    return response()->json(['sessionUpdated' => true]);
});

//Web Management
Route::middleware('auth')->group(function () {
    Route::get('/slider', [WebManagementController::class, 'slider'])
        ->name('slider')
        ->middleware(['auth', 'verified', 'can:slider-list']);

    Route::get('/sub-kegiatan', [WebManagementController::class, 'subkegiatan'])
        ->name('sub-kegiatan')
        ->middleware(['auth', 'verified', 'can:sub kegiatan-list']);

    Route::get('/galeri', [WebManagementController::class, 'galeri'])
        ->name('galeri')
        ->middleware(['auth', 'verified', 'can:galeri-list']);

    Route::get('/forum-anak', [WebManagementController::class, 'forumanak'])
        ->name('forum-anak')
        ->middleware(['auth', 'verified', 'can:forum anak-list']);

    Route::get('/PemantauanUsulan', [WebManagementController::class, 'PemantauanUsulan'])
        ->name('PemantauanUsulanAnak')
        ->middleware(['auth', 'verified', 'can:pemantauan usulan-list']);
        
    Route::get('/HalamanMenuManagement', [WebManagementController::class, 'ManagementMenu'])
        ->name('MenuManagement')
        ->middleware(['auth', 'verified', 'can:halaman-list']);

    Route::get('/KategoriArtikel', [WebManagementController::class, 'kategoriArtikel'])
        ->name('kategoriArtikel')
        ->middleware(['auth', 'verified', 'can:kategori artikel-list']);

    Route::get('/Klaster', [WebManagementController::class, 'Klaster1'])
        ->name('Klaster')
        ->middleware(['auth', 'verified', 'can:klaster-list']);

    Route::get('/bagianHalaman', [WebManagementController::class, 'BagianHalaman'])
        ->name('Halamandong')
        ->middleware(['auth', 'verified', 'can:halaman-list']);

    Route::get('/Artikel', [WebManagementController::class, 'BagianArtikel'])
        ->name('Artikel')
        ->middleware(['auth', 'verified', 'can:artikel-list']);

    //Tambah data
    Route::post('/createKategoriArtikel', [WebManagementController::class, 'storeKategoriArtikel'])
        ->name('createKategoriArtikel')
        ->middleware(['auth', 'verified', 'can:kategori artikel-add']);

    Route::post('/createSlider', [WebManagementController::class, 'storeSlider'])
        ->name('createSlider')
        ->middleware(['auth', 'verified', 'can:slider-add']);

    Route::post('/createPemantauanUsulan', [WebManagementController::class, 'storepemantauanUsulan'])
        ->name('createPemantauanUsulan')
        ->middleware(['auth', 'verified', 'can:pemantauan usulan-add']);

    Route::post('/createKlaster', [WebManagementController::class, 'storeKlaster'])
        ->name('createKlaster')
        ->middleware(['auth', 'verified', 'can:klaster-add']);

    Route::post('/createHalaman', [WebManagementController::class, 'storeHalaman'])
        ->name('createHalaman')
        ->middleware(['auth', 'verified', 'can:halaman-add']);

    Route::post('/createGaleri', [WebManagementController::class, 'storeGaleri'])
        ->name('createGaleri')
        ->middleware(['auth', 'verified', 'can:galeri-add']);

    Route::post('/createForumAnak', [WebManagementController::class, 'storeForumAnak'])
        ->name('createForumAnak')
        ->middleware(['auth', 'verified', 'can:forum anak-add']);

    Route::post('/createSubKegiatan', [WebManagementController::class, 'storeSubKegiatan'])
        ->name('createSubKegiatan')
        ->middleware(['auth', 'verified', 'can:sub kegiatan-add']);

    Route::post('/createArtikel', [WebManagementController::class, 'storeArtikel'])
        ->name('createArtikel')
        ->middleware(['auth', 'verified', 'can:artikel-add']);

    //Edit data
    Route::put('/kategori-artikel/update/{id}', [WebManagementController::class, 'updateKategoriArtikel'])
        ->name('updateKategoriArtikel')
        ->middleware(['auth', 'verified', 'can:kategori artikel-edit']);

    Route::put('/slider/update/{id}', [WebManagementController::class, 'updateSlider'])
        ->name('updateSlider')
        ->middleware(['auth', 'verified', 'can:slider-edit']);

    Route::put('/klaster/update/{id}', [WebManagementController::class, 'updateKlaster'])
        ->name('updateKlaster')
        ->middleware(['auth', 'verified', 'can:klaster-edit']);

    Route::put('/halaman/update/{id}', [WebManagementController::class, 'updateHalaman'])
        ->name('updateHalaman')
        ->middleware(['auth', 'verified', 'can:halaman-edit']);

    Route::put('/forumAnak/update/{id}', [WebManagementController::class, 'updateForumAnak'])
        ->name('updateForumAnak')
        ->middleware(['auth', 'verified', 'can:forum anak-edit']);

    Route::put('/galeri/update/{id}', [WebManagementController::class, 'updateGaleri'])
        ->name('updateGaleri')
        ->middleware(['auth', 'verified', 'can:galeri-edit']);

    Route::put('/subKegiatan/update/{id}', [WebManagementController::class, 'updateSubKegiatan'])
        ->name('updateSubKegiatan')
        ->middleware(['auth', 'verified', 'can:sub kegiatan-edit']);

    Route::put('/artikel/update/{id}', [WebManagementController::class, 'updateArtikel'])
        ->name('updateArtikel')
        ->middleware(['auth', 'verified', 'can:artikel-edit']);

    Route::put('/pemantauan/update/{id}', [WebManagementController::class, 'updatePemantauanUsulan'])
        ->name('updatePemantauaUsulan')
        ->middleware(['auth', 'verified', 'can:pemantauan usulan-edit']);


    //Delete data
    Route::delete('/kategori/hapus/{id}', [WebManagementController::class, 'destroyKategoriArtikel'])
        ->name('destroyKategoriArtikel')
        ->middleware(['auth', 'verified', 'can:kategori artikel-delete']);

    Route::delete('/slider/hapus/{id}', [WebManagementController::class, 'destroySlider'])
        ->name('destroySlider')
        ->middleware(['auth', 'verified', 'can:slider-delete']);

    Route::delete('/galeri/hapus/{id}', [WebManagementController::class, 'destroyGaleri'])
        ->name('destroyGaleri')
        ->middleware(['auth', 'verified', 'can:galeri-delete']);

    Route::delete('/klaster/hapus/{id}', [WebManagementController::class, 'destroyKlaster'])
        ->name('destroyKlaster')
        ->middleware(['auth', 'verified', 'can:klaster-delete']);

    Route::delete('/halaman/hapus/{id}', [WebManagementController::class, 'destroyHalaman'])
        ->name('destroyHalaman')
        ->middleware(['auth', 'verified', 'can:halaman-delete']);

    Route::delete('/subKegiatan/hapus/{id}', [WebManagementController::class, 'destroySubKegiatan'])
        ->name('destroySubKegiatan')
        ->middleware(['auth', 'verified', 'can:sub kegiatan-delete']);

    Route::delete('/forumAnak/hapus/{id}', [WebManagementController::class, 'destroyForumAnak'])
        ->name('destroyForumAnak')
        ->middleware(['auth', 'verified', 'can:forum anak-delete']);

    Route::delete('/pemantauan/hapus/{id}', [WebManagementController::class, 'destroyPemantauan'])
        ->name('destroyPemantauan')
        ->middleware(['auth', 'verified', 'can:pemantauan usulan-delete']);

    Route::delete('/artikel/hapus/{id}', [WebManagementController::class, 'destroyArtikel'])
        ->name('destroyArtikel')
        ->middleware(['auth', 'verified', 'can:artikel-delete']);

});

//Kecamatan Layak Anak
Route::middleware('auth')->group(function () {
    Route::get('/dokumen-kec', [KecamatanLayakController::class, 'dokumenkec'])
        ->name('dokumen-kec')
        ->middleware(['auth', 'verified', 'can:dokumen kecamatan-list']);

    Route::get('/kegiatan-kecamatan', [KecamatanLayakController::class, 'kegiatanKecamatan'])
        ->name('kegiatan-kecamatan')
        ->middleware(['auth', 'verified', 'can:kegiatan kecamatan-list']);

    //Tambah Data
    Route::post('/createDokumenKecamatan', [KecamatanLayakController::class, 'storeDokumenKecamatan'])
        ->name('createDokumenKecamatan')
        ->middleware(['auth', 'verified', 'can:dokumen kecamatan-add']);

    Route::post('/createKegiatanKecamatan', [KecamatanLayakController::class, 'storeKegiatanKecamatan'])
        ->name('createKegiatanKecamatan')
        ->middleware(['auth', 'verified', 'can:kegiatan kecamatan-add']);

    //edit
    Route::put('/dokumenKecamatan/update/{id}', [KecamatanLayakController::class, 'updateDokumenKecamatan'])
        ->name('updateDokumenKecamatan')
        ->middleware(['auth', 'verified', 'can:dokumen kecamatan-edit']);

    Route::put('/kegiatanKecamatan/update/{id}', [KecamatanLayakController::class, 'updateKegiatanKecamatan'])
        ->name('updateKegiatanKecamatan')
        ->middleware(['auth', 'verified', 'can:kegiatan kecamatan-edit']);

    //delete
    Route::delete('/dokumenKecamatan/hapus/{id}', [KecamatanLayakController::class, 'destroyDokumenKecamatan'])
        ->name('destroyDokumenKecamatan')
        ->middleware(['auth', 'verified', 'can:dokumen kecamatan-delete']);

    Route::delete('/kegiatanKecamatan/hapus/{id}', [KecamatanLayakController::class, 'destroyKegiatanKecamatan'])
        ->name('destroyKegiatanKecamatan')
        ->middleware(['auth', 'verified', 'can:kegiatan kecamatan-delete']);

});

//Mitra Anak
Route::middleware('auth')->group(function () {
    Route::get('/kegiatan-cfci', [MitraAnakController::class, 'kegiatanCfci'])
        ->name('kegiatan-cfci')
        ->middleware(['auth', 'verified', 'can:cfci-list']);
        
    Route::get('/artikel-mitraanak', [MitraAnakController::class, 'artikelmitraanak'])
        ->name('artikel-mitraanak')
        ->middleware(['auth', 'verified', 'can:artikel anak-list']);

    Route::get('/kegiatan-mitra', [MitraAnakController::class, 'kegiatanMitraAnak'])
        ->name('kegiatan-mitra')
        ->middleware(['auth', 'verified', 'can:kegiatan mitra anak-list']);


    //Tambah
    Route::post('/createKegiatanMitraAnak', [MitraAnakController::class, 'storeKegiatanMitraAnak'])
        ->name('createKegiatanMitraAnak')
        ->middleware(['auth', 'verified', 'can:kegiatan mitra anak-add']);

    Route::post('/createMitraCfci', [MitraAnakController::class, 'storeKegiatanCfci'])
        ->name('createMitraCfci')
        ->middleware(['auth', 'verified', 'can:cfci-add']);

    Route::post('/createArtikelMitra', [MitraAnakController::class, 'storeArtikelMitra'])
        ->name('createArtikelMitra')
        ->middleware(['auth', 'verified', 'can:artikel anak-add']);

    //Update Data
    Route::put('/artikelMitra/update/{id}', [MitraAnakController::class, 'updateArtikelMitra'])
        ->name('updateArtikelMitra')
        ->middleware(['auth', 'verified', 'can:artikel anak-edit']);

    Route::put('/kegiatanMitra/update/{id}', [MitraAnakController::class, 'updateKegiatanMitra'])
        ->name('updatekegiatanMitra')
        ->middleware(['auth', 'verified', 'can:kegiatan mitra anak-edit']);

    Route::put('/update/{id}', [MitraAnakController::class, 'update'])
        ->name('updateCfci')
        ->middleware(['auth', 'verified', 'can:cfci-edit']);

    //delete
    Route::delete('/artikelMitra/hapus/{id}', [MitraAnakController::class, 'destroyArtikelMitra'])
        ->name('destroyArtikelMitra')
        ->middleware(['auth', 'verified', 'can:artikel anak-delete']);

    Route::delete('/kegiatanMitra/hapus/{id}', [MitraAnakController::class, 'destroyKegiatanMitra'])
        ->name('destroyKegiatanMitra')
        ->middleware(['auth', 'verified', 'can:kegiatan mitra anak-delete']);

    Route::delete('/mitraCfci/hapus/{id}', [MitraAnakController::class, 'destroyMitraCfci'])
        ->name('destroyMitraCfci  ')
        ->middleware(['auth', 'verified', 'can:cfci-delete']);

});

//Kegiatan Arek Suroboyo
Route::middleware('auth')->group(function () {
    Route::get('/kegiatan-arek', [KegiatanArekSuroboyoController::class, 'kegiatanarek'])
        ->name('kegiatan-arek')
        ->middleware(['auth', 'verified', 'can:kegiatan arek suroboyo-list']);

    //tambah
    Route::post('/createKegiatanArekSuroboyo', [KegiatanArekSuroboyoController::class, 'storeKegiatanArekSuroboyo'])
        ->name('createKegiatanArekSuroboyo')
        ->middleware(['auth', 'verified', 'can:kegiatan arek suroboyo-add']);
    
    //update
    Route::put('/KegiatanArekSuroboyo/update/{id}', [KegiatanArekSuroboyoController::class, 'updateKegiatanArekSuroboyo'])
        ->name('updateKegiatanArekSuroboyo')
        ->middleware(['auth', 'verified', 'can:kegiatan arek suroboyo-edit']);

    //delete
    Route::delete('/KegiatanArekSuroboyo/hapus/{id}', [KegiatanArekSuroboyoController::class, 'destroyKegiatanArekSuroboyo'])
        ->name('destroyKegiatanArekSuroboyo')
        ->middleware(['auth', 'verified', 'can:kegiatan arek suroboyo-delete']);

});

//Usulan Kegiatan
Route::middleware('auth')->group(function () {
    Route::get('/pemantauan-suara', [UsulanKegiatanController::class, 'pemantauansuara'])
        ->name('pemantauan-suara')
        ->middleware(['auth', 'verified', 'can:pemantauan suara anak-list']);

    Route::get('/karya-anak', [UsulanKegiatanController::class, 'karyaanak'])
        ->name('karya-anak')
        ->middleware(['auth', 'verified', 'can:karya-list']);

    //Tambah data
    Route::post('/createPemantauanSuara', [UsulanKegiatanController::class, 'storePemantauanSuara'])
        ->name('createPemantauanSuara')
        ->middleware(['auth', 'verified', 'can:pemantauan suara anak-add']);

    Route::post('/createTindakLanjut', [UsulanKegiatanController::class, 'storeTindakLanjut'])
        ->name('createTindakLanjut')
        ->middleware(['auth', 'verified', 'can:pemantauan suara anak-verifikasi']);

    Route::post('/createKaryaAnak', [UsulanKegiatanController::class, 'storeKaryaAnak'])
        ->name('createKaryaAnak')
        ->middleware(['auth', 'verified', 'can:karya-add']);

    //update
    Route::put('/karya-anak/update/{id}', [UsulanKegiatanController::class, 'updateKaryaAnak'])
        ->name('updateKaryaAnak')
        ->middleware(['auth', 'verified', 'can:karya-edit']);

    Route::put('/karya-anak/verifikasi/{id}', [UsulanKegiatanController::class, 'verifikasiKaryaAnak'])
        ->name('updateKaryaAnak')
        ->middleware(['auth', 'verified', 'can:karya-verifikasi']);

    Route::put('/pemantauan-suara/update/{id}', [UsulanKegiatanController::class, 'updatePemantauanSuara'])
        ->name('updatePemantauanSuara')
        ->middleware(['auth', 'verified', 'can:pemantauan suara anak-edit']);

    Route::put('/tindak-lanjut/update/{id}', [UsulanKegiatanController::class, 'updateTindakLanjut'])
        ->name('updateTindakLanjut')
        ->middleware(['auth', 'verified', 'can:pemantauan suara anak-verifikasi']);

    Route::put('/verifikasi/update/{id}', [UsulanKegiatanController::class, 'updateVerifikasiUsulan'])
        ->name('updateVerifikasi')
        ->middleware(['auth', 'verified', 'can:pemantauan suara anak-verifikasi']);

    //delete
    Route::delete('/karya-anak/hapus/{id}', [UsulanKegiatanController::class, 'destroyKaryaAnak'])
        ->name('destroyKaryaAnak')
        ->middleware(['auth', 'verified', 'can:karya-delete']);

    Route::delete('/pemantauan-suara/hapus/{id}', [UsulanKegiatanController::class, 'destroyPemantauanSuara'])
        ->name('destroyPemantauanSuara')
        ->middleware(['auth', 'verified', 'can:pemantauan suara anak-delete']);

});

//Dokumen SK FAS, CFCI DAN KLA
Route::middleware('auth')->group(function () {
    Route::get('/dokumen-skcfci', [DokumenSkCfciController::class, 'dokumenSkCfciKla'])
        ->name('dokumen-skcfci')
        ->middleware(['auth', 'verified', 'can:dokumen sk fas, cfci dan kla-list']);
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
