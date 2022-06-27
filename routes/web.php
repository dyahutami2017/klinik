<?php

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
    return view('welcome');
});
Route::group(['namespace' => 'kasir', 'prefix' => 'kasir'], function() {
    Route::get('/dashboard', function () {return view('kasir.dashboard');});
    Route::get('/pasien_ralan', function () {return view('kasir.pasien_ralan');});
    Route::get('/tarif', function () {return view('kasir.list_tarif');});
    Route::get('/get_history_kunjungan', '\App\Http\Controllers\KasirController@GetHistory');
    Route::get('/get_pasien_ralan', '\App\Http\Controllers\KasirController@GetPasien');
    Route::get('/nota_ralan_all', '\App\Http\Controllers\KasirController@GetNota');
    Route::get('/get_obat', '\App\Http\Controllers\KasirController@GetNotaObat');
    Route::get('/get_list_obat', '\App\Http\Controllers\KasirController@GetListObat');
    Route::post('/transaksi_q', '\App\Http\Controllers\KasirController@PostTransaksi');
    Route::post('/add_obat', '\App\Http\Controllers\KasirController@PostTransaksiObat');
});