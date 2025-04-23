<?php

use App\Http\Controllers\WebManagementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//=================== OPD =========================
// Route::middleware('auth')->group(function () {
    Route::get('/opd', [WebManagementController::class, 'opdAPI']);

    Route::post('/opdStoreApi', [WebManagementController::class, 'storeOPDAPI'])
        ->name('api.createOPD');

    Route::match(['put', 'patch'], '/opdUpdateApi/{id}', [WebManagementController::class, 'updateOPDAPI'])
        ->name('api.updateOPD');

    Route::delete('/opdDeleteApi/{id}', [WebManagementController::class, 'destroyOPDAPI'])
        ->name('api.deleteOPD');
// });

//=================== END OPD ======================


//=================== Kelurahan =========================

//=================== END Kelurahan =====================

