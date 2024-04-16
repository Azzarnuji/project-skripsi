<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\WebHomeController;
use App\Http\Controllers\WebAdminController;
use App\Http\Controllers\WebCalonSiswaController;
use App\Http\Controllers\WebGuruTUController;
use App\Http\Controllers\WebSiswaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WebHomeController::class, 'index']);
Route::get('/login',[WebAuthController::class,'login']);
Route::get('/registrasi',[WebAuthController::class,'registrasi']);
Route::get('/kata_sambutan', [WebHomeController::class, 'kataSambutan']);
Route::get('/visi_misi',[WebHomeController::class,'visiMisi']);
Route::get('/guru',[WebHomeController::class,'guru']);
Route::get('/siswa',[WebHomeController::class,'siswa']);
Route::get('/prestasi_siswa',[WebHomeController::class,'prestasiSiswa']);
Route::get('/berita',[WebHomeController::class,'berita']);
Route::get('/berita/berita_detail/{id}',[WebHomeController::class,'beritaDetail']);
Route::get('/pengumuman',[WebHomeController::class,'pengumuman']);
Route::get('/agenda',[WebHomeController::class,'agenda']);
Route::get('/galeri',[WebHomeController::class,'galeri']);
Route::get('/galeri/album/{id}',[WebHomeController::class,'album']);
Route::get('/download',[WebHomeController::class,'download']);
Route::get('/download-file/{id}',[WebHomeController::class,'download_file']);
Route::get('/kontak',[WebHomeController::class,'kontak']);
Route::get('/download-file-format',[WebHomeController::class,'download_file_format']);
Route::get('/forgot-password',[WebAuthController::class,'forgotPassword']);
Route::prefix('calon_siswa')->group(function(){
    Route::get('/dashboard',[WebCalonSiswaController::class,'dashboard']);
    Route::get('/ppdb',[WebCalonSiswaController::class,'ppdb']);
    Route::get('/pembayaran',[WebCalonSiswaController::class,'pembayaran']);
    Route::get('/ujian/{ujianID}',[WebCalonSiswaController::class,'ujian']);
    Route::get('/hasilUjian/{ujianID}',[WebCalonSiswaController::class,'hasilUjian']);
});

Route::prefix('admin')->group(function() {
    Route::get('/dashboard', [WebAdminController::class, 'dashboard']);
    Route::get('/kelas', [WebAdminController::class, 'kelas']);
    Route::get('/guru', [WebAdminController::class, 'guru']);
    Route::get('/pembayaran', [WebAdminController::class, 'pembayaran']);
    Route::get('/ujian', [WebAdminController::class, 'ujian']);
    Route::get('/data-siswa',[WebAdminController::class, 'dataSiswa']);
    Route::get('/berita',[WebAdminController::class, 'berita']);
    Route::get('/agenda',[WebAdminController::class, 'agenda']);
    Route::get('/gallery',[WebAdminController::class, 'gallery']);
    Route::get('/files',[WebAdminController::class, 'files']);
});

Route::prefix('guru_tu')->group(function(){
    Route::get('/dashboard',[WebGuruTUController::class,'dashboard']);
    Route::get('/ppdb',[WebGuruTUController::class,'ppdb']);
    Route::get('/pembayaran',[WebGuruTUController::class,'pembayaran']);
    Route::get('/data-siswa',[WebGuruTUController::class,'dataSiswa']);
});

Route::prefix('siswa')->group(function(){
    Route::get('/dashboard',[WebSiswaController::class,'dashboard']);
    Route::get('/pembayaran',[WebSiswaController::class,'pembayaran']);
    Route::get('/siswaLama',[WebSiswaController::class,'siswaLama']);
});
