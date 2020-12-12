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

//Start Route Dompet
    Route::get('/dompets', 'DompetController@index');
    Route::get('/dompets/create','DompetController@create');
    Route::get('/dompets/edit/{id}','DompetController@edit');
    Route::get('/dompets/changeStatus/{id}/{status_id}','DompetController@changeStatus');
    Route::get('/dompets/show/{id}','DompetController@show');
    Route::post('/dompets/store','DompetController@store');
    Route::post('/dompets/update','DompetController@update');
    Route::post('/dompets/filterStatus/{status_id}','DompetController@filterStatus');
//End Route Dompet

//Start Route Kategori
    Route::get('/kategoris', 'KategoriController@index');
    Route::get('/kategoris/create','KategoriController@create');
    Route::get('/kategoris/edit/{id}','KategoriController@edit');
    Route::get('/kategoris/changeStatus/{id}/{status_id}','KategoriController@changeStatus');
    Route::get('/kategoris/show/{id}','KategoriController@show');
    Route::post('/kategoris/store','KategoriController@store');
    Route::post('/kategoris/update','KategoriController@update');
    Route::post('/kategoris/filterStatus/{status_id}','KategoriController@filterStatus');
//End Route Kategori

//Start Route Dompet Masuk
    Route::get('/transaksis', 'TransaksiController@index');
    Route::get('/transaksis/create','TransaksiController@create');
    Route::post('/transaksis/store','TransaksiController@store');
//End Route Dompet Masuk

//Start Route Dompet Keluar
    Route::get('/transaksis/DompetKeluar', 'TransaksiController@indexDompetKeluar');
    Route::get('/transaksis/createDompetKeluar','TransaksiController@createDompetKeluar');
    Route::post('/transaksis/storeDompetKeluar','TransaksiController@storeDompetKeluar');
//End Route Dompet Keluar

//Start Route Laporan Transaksi
    Route::get('/transaksis/indexLaporan', 'TransaksiController@indexLaporan');
    Route::post('/transaksis/filterLaporan','TransaksiController@filterLaporan');
//End Route Laporan Transaksi