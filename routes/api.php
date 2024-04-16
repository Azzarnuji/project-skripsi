<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiAdminController;
use App\Http\Controllers\Api\ApiCalonSiswaController;
use App\Http\Controllers\Api\ApiUjianController;
use App\Http\Controllers\Api\ApiGuruTUController;
use App\Http\Controllers\Api\ApiPembayaranController;
use App\Http\Controllers\Api\ApiSiswaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function(){
    Route::post('/login',[ApiAuthController::class,'login']);
    Route::post('/register',[ApiAuthController::class,'register']);
    Route::post('/logout',[ApiAuthController::class,'logout']);
    Route::post('/refresh',[ApiAuthController::class,'refresh']);
    Route::post('/me',[ApiAuthController::class,'me']);
    Route::post('/sendOtp',[ApiAuthController::class,'sendOtp']);
    Route::post('/verifyOtp',[ApiAuthController::class,'verifyOtp']);
    Route::post('/resetPassword',[ApiAuthController::class,'resetPassword']);
    Route::post('/updateProfile',[ApiAuthController::class,'updateProfile']);
});

Route::prefix('admin')->group(function(){
    Route::post('/kelas',[ApiAdminController::class,'kelas']);
    Route::post('/editKelas',[ApiAdminController::class,'editKelas']);
    Route::post('/pembayaran',[ApiAdminController::class,'pembayaran']);
    Route::post('/tambahMetodePembayaran',[ApiAdminController::class,'tambahMetodePembayaran']);
    Route::post('/guru',[ApiAdminController::class,'guru']);
    Route::post('/tambahListSiswa',[ApiAdminController::class,'tambahListSiswa']);
    Route::post('/tambahBerita',[ApiAdminController::class,'tambahBerita']);
    Route::post('/tambahAgenda',[ApiAdminController::class,'tambahAgenda']);
    Route::post('/tambahFile',[ApiAdminController::class,'tambahFile']);
    Route::post('/buatAlbum',[ApiAdminController::class,'buatAlbum']);
    Route::post('/tambahFotoBaru',[ApiAdminController::class,'tambahFotoBaru']);


    Route::get('/getAlbumGalleryById/{id}',[ApiAdminController::class,'getAlbumGalleryById']);
    Route::get('/hapusAlbum/{id}',[ApiAdminController::class,'hapusAlbum']);
    Route::get('/getAllAlbum',[ApiAdminController::class,'getAllAlbum']);
    Route::get('/hapusFile/{id}',[ApiAdminController::class,'hapusFile']);
    Route::get('/hapusBerita/{id}',[ApiAdminController::class,'hapusBerita']);
    Route::get('/hapusAgenda/{id}',[ApiAdminController::class,'hapusAgenda']);
    Route::get('/hapusMetodePembayaran/{id}',[ApiAdminController::class,'hapusMetodePembayaran']);
    Route::get('/hapusGuru/{email}',[ApiAdminController::class,'hapusGuru']);
    Route::post('/ujian',[ApiAdminController::class,'ujian']);
    Route::get('/hapusUjian/{ujianID}',[ApiAdminController::class,'hapusUjian']);
    Route::get('/hapusPembayaran/{id}',[ApiAdminController::class,'hapusPembayaran']);
    Route::get('/activePembayaran/{id}',[ApiAdminController::class,'activePembayaran']);
    Route::get('/getSubKelas/{kelas}',[ApiAdminController::class,'getSubKelas']);
    Route::get('/getSiswaByKelas/{kelas}',[ApiAdminController::class,'getSiswaByKelas']);
});

Route::prefix('ujian')->group(function(){
   Route::get('/getById/{id}',[ApiUjianController::class,'getById']);
});

Route::prefix('pembayaran')->group(function(){
    Route::get('/getMetodePembayaran',[ApiPembayaranController::class,'getMetodePembayaran']);
    Route::post('/bayarPendaftaran',[ApiPembayaranController::class,'bayarPendaftaran']);
});

Route::prefix('guru_tu')->group(function(){
    Route::get('detailSiswa/{email}/{idPembayaran}',[ApiGuruTUController::class,'detailSiswa']);
    Route::post('/updateStatusPembayaranDaftarBaru',[ApiGuruTUController::class,'updateStatusPembayaranDaftarBaru']);
    Route::get('/getDataByFilter/{filter}',[ApiGuruTUController::class,'getDataByFilter']);
    Route::get('/detailPPDB/{email}',[ApiGuruTUController::class,'detailPPDB']);
    Route::post('/updatStatusPPDBCalonSiswa',[ApiGuruTUController::class,'updatStatusPPDBCalonSiswa']);
    Route::get('/getSubKelas/{kelas}',[ApiAdminController::class,'getSubKelas']);
    Route::get('/getSiswaByKelas/{kelas}',[ApiAdminController::class,'getSiswaByKelas']);
});

Route::prefix('calon_siswa')->group(function(){
    Route::post('/ujian/{ujianID}',[ApiCalonSiswaController::class,'ujian']);
    Route::post('/ppdb',[ApiCalonSiswaController::class,'ppdb']);
});

Route::prefix("siswa")->group(function(){
    Route::get('/getSiswaByNIS/{NIS}',[ApiSiswaController::class,'getSiswaByNIS']);
    Route::post('/bayar',[ApiSiswaController::class,'bayar']);
    Route::post('/daftarSiswaLama',[ApiSiswaController::class,'daftarSiswaLama']);
});
