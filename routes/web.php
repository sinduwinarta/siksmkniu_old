<?php

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

//default route adalah login page
Route::get('/', function () {
    return view('welcome');
});

//login and register route
Route::get('/home', 'PegawaiController@index');
Route::get('/login', 'PegawaiController@login');
Route::post('/loginPost', 'PegawaiController@loginPost');
Route::get('/register', 'PegawaiController@register');
Route::post('/registerPost', 'PegawaiController@registerPost');
Route::get('/logout', 'PegawaiController@logout');

//login super admin
Route::get('/superadmin', 'SuperadminController@login');
Route::post('/superadmin/loginPost', 'SuperadminController@loginPost');
Route::get('/superadmin/logout', 'SuperadminController@logout');
Route::get('/superadmin_dataPegawai', 'SuperadminController@dataPegawai');

//data pegawai superadmin
Route::get('/superadmin_dataPegawai/setadmin/{id}', 'SuperadminController@setAdmin');
Route::get('/superadmin_dataPegawai/setpimpinan/{id}', 'SuperadminController@setPimpinan');
Route::get('/superadmin_dataPegawai/setstaf/{id}', 'SuperadminController@setStaf');
Route::delete('/superadmin_dataPegawai/delete/{id}', 'SuperadminController@destroyUser');

//route admin unggah surat
Route::get('/unggah', 'SuratController@createSurat');
Route::post('/unggah/baru', 'SuratController@storeSurat');

//rute surat
Route::get('/surat', 'SuratController@showSurat'); //page surat baru untuk staff atau pimpinan setelah upload
Route::get('/surat/proses/{id}', 'SuratController@prosesSurat'); //status ++
Route::get('/surat/detail/{id}', 'SuratController@detailSurat'); //detail surat
Route::get('/surat/cancel/{id}', 'SuratController@cancelSurat'); //surat tidak jadi ditinjau
Route::get('/surat/edit/{id}', 'SuratController@editSurat');   //buka halaman edit surat
Route::get('/surat/download/{id}', 'SuratController@downloadSurat'); //download surat
Route::patch('/surat/edit/update/{id}', 'SuratController@updateSurat'); //menyimpan hasil editing surat
Route::delete('surat/destroy', 'SuratController@destroySurat'); //hapus surat

//rute disposisis
Route::get('/disposisi', 'DisposisiController@index');
Route::get('/disposisi/detail/{id}', 'DisposisiController@detailDisposisi'); //detail disposisi
Route::get('/disposisi/selesai/{id}', 'DisposisiController@updateDisposisi'); //selesai salah satu disposisi
Route::post('/disposisi/baru/', 'DisposisiController@storeDisposisi'); //pimpinan memberikan dispo baru
Route::delete('/disposisi/destroy', 'DisposisiController@destroyDisposisi');

//rute arsip
Route::get('/arsip', 'ArsipController@index');
Route::get('/arsip/baru/{id}', 'ArsipController@createArsip');
Route::get('/arsip/detail/{id}', 'ArsipController@detailArsip');
Route::delete('/arsip/destroy', 'ArsipController@destroyArsip');

//route profile
Route::get('profil/edit', 'ProfilController@profil'); //halaman edit data profile
Route::patch('profil/update/avatar/{id}', 'ProfilController@updateAvatar');
Route::patch('profil/update/{id}', 'ProfilController@updateProfil');

//route dokumen baru pada disposisi
Route::post('disposisi/tambah/surat', 'DokumenController@addImage');
