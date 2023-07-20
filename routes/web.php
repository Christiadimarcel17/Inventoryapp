<?php

use App\Http\Controllers\DatabarangController;
use App\Http\Controllers\DatakeluarController;
use App\Http\Controllers\PermintaanbarangController;
use App\Http\Controllers\DatamasukController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/databarang', DatabarangController::class);
Route::resource('/permintaanbarang', PermintaanbarangController::class);
Route::resource('/databarangmasuk', DatamasukController::class);
Route::get('/tampilkanbarang', [App\Http\Controllers\DatamasukController::class, 'tampilkan']);
Route::get('/editbarangmasuk/{id}/edit/{nama}/{jumlah}/{totalharga}/{tgl}/{ket}', [App\Http\Controllers\DatamasukController::class, 'editbarang'])->name('editbrgmasuk');
Route::delete('/deletebarangmasuk/{id}/{nama}', [App\Http\Controllers\DatamasukController::class, 'destroybarang'])->name('hapusbarang');

Route::resource('/databarangkeluar', DatakeluarController::class);
Route::get('/tampilkanbarangkeluar', [App\Http\Controllers\DatakeluarController::class, 'tampilkan'])->name('tampilbarangkeluar');
Route::get('/editbarangmakeluar/{id}/edit/{nama}/{jumlah}/{totalharga}/{tgl}/{ket}', [App\Http\Controllers\DatakeluarController::class, 'editbarangkel'])->name('editbrgkeluar');
Route::delete('/deletebarangmasukkel/{id}/{nama}', [App\Http\Controllers\DatakeluarController::class, 'destroybarangkel'])->name('hapusbarangkel');


