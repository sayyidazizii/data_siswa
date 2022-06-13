<?php
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('datasiswa', 'SiswaController', [
	'except' => ['create']
]);
Route::get('datasiswa/{id}/edit', 'SiswaController@edit')->name('datasiswa.edit');
Route::get('api/datasiswa', 'SiswaController@apiSiswa')->name('api.datasiswa');
Route::get('/export_datasiswa', 'SiswaController@exportSiswa');



Route::resource('datanilai', 'NilaiController', [
	'except' => ['create']
]);
// Route::post('nilai', 'NilaiController@store')->name('nilai.store');
Route::get('datanilai/{id}/edit', 'NilaiController@edit')->name('datanilai.edit');
Route::get('dataapi/nilai', 'NilaiController@apiNilai')->name('api.datanilai');
Route::get('/export_datanilai', 'NilaiController@exportNilai');