<?php

use App\Http\Controllers\DownloadController;
use App\Http\Controllers\GoogleDriveController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;

Route::view('/', 'welcome')->name('welcome');

Route::view('/profil', 'profil')->name('profil');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Auth::routes();

//Normal Users Routes List
Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('/mahasiswa/beranda', [HomeController::class, 'index'])->name('mahasiswa.beranda');
    Route::get('/profile/profileuser', [App\Http\Controllers\ProfileController::class, 'index'])->name('profileuser.index');
    Route::patch('/profile/profileuser/{id}', [App\Http\Controllers\ProfileController::class, 'update'])->name('profileuser.update');

    Route::get('/download', [DownloadController::class, 'download'])->name('download');

    Route::get('/mahasiswa/tracing/{id}/pengajuanspta', [App\Http\Controllers\MahasiswaController::class, 'pengajuanSuratSptatracing'])->name('pengajuan_surat_tracing');
    Route::get('/mahasiswa/tracing/{id}/pengajuansemta', [App\Http\Controllers\MahasiswaController::class, 'pengajuanSuratSemtatracing'])->name('pengajuan_surat_tracing');
    Route::get('/mahasiswa/tracing/{id}/pengajuansta', [App\Http\Controllers\MahasiswaController::class, 'pengajuanSuratStatracing'])->name('pengajuan_surat_tracing');
    Route::get('/mahasiswa/tracing/{id}/pengajuanskp', [App\Http\Controllers\MahasiswaController::class, 'pengajuanSuratSkptracing'])->name('pengajuan_surat_tracing');
    Route::get('/mahasiswa/tracing/{id}/pengajuanpskkp', [App\Http\Controllers\MahasiswaController::class, 'pengajuanSuratPskkptracing'])->name('pengajuan_surat_tracing');
    Route::get('/mahasiswa/tracing/{id}/pengajuanpptakp', [App\Http\Controllers\MahasiswaController::class, 'pengajuanSuratPptakptracing'])->name('pengajuan_surat_tracing');
    Route::get('/mahasiswa/tracing/{id}/legalisasi', [App\Http\Controllers\MahasiswaController::class, 'pengajuanLegalisasitracing'])->name('pengajuan_surat_tracing');
    Route::get('/mahasiswa/tracing/{id}/pengajuanpskta', [App\Http\Controllers\MahasiswaController::class, 'pengajuanSuratPsktatracing'])->name('pengajuan_surat_tracing');

    Route::view('mahasiswa/notifikasi-mahasiswa', 'mahasiswa/notifikasi_mahasiswa')->name('notifikasi_mahasiswa');
});


//Admin Routes List
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/admin/beranda', [HomeController::class, 'admin'])->name('admin.beranda');
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Route::get('/admin/dashboard', [HomeController::class, 'admin'])->name('admin.dashboard');
    // Route::get('/admin/beranda', [App\Http\Controllers\AdminController::class, 'beranda'])->name('admin.beranda');
    Route::get('/admin/profileadmin', [App\Http\Controllers\AdminController::class, 'index'])->name('profileadmin.index');
    Route::patch('/admin/profileadmin/{id}', [App\Http\Controllers\AdminController::class, 'update'])->name('profileadmin.update');
    Route::get('admin/daftar-informasi', [App\Http\Controllers\AdminController::class, 'informasi'])->name('daftar_informasi');
    Route::POST('admin/tambah-informasi', [App\Http\Controllers\AdminController::class, 'tambahinformasi'])->name('tambah_informasi');

    Route::get('/admin/beranda/{id}/delete', [App\Http\Controllers\AdminController::class, 'deleteinformasi'])->name('delete_informasi');

    Route::get('admin/pengajuansptaa', [App\Http\Controllers\AdminController::class, 'pengajuansptaa'])->name('pengajuansptaa');
    Route::get('admin/pengajuansptaa2', [App\Http\Controllers\AdminController::class, 'pengajuansptaa2'])->name('pengajuansptaa2');
    Route::get('admin/pengajuansptaa3', [App\Http\Controllers\AdminController::class, 'pengajuansptaa3'])->name('pengajuansptaa3');
    Route::get('admin/tolakpengajuansptaa/{id}', [App\Http\Controllers\AdminController::class, 'tolakpengajuansptaa'])->name('tolakpengajuansptaa');
    Route::get('admin/terimapengajuansptaa/{id}', [App\Http\Controllers\AdminController::class, 'terimapengajuansptaa'])->name('terimapengajuansptaa');
    Route::get('admin/prosespengajuansptaa/{id}', [App\Http\Controllers\AdminController::class, 'prosespengajuansptaa'])->name('prosespengajuansptaa');

    Route::get('admin/pengajuansemtaa', [App\Http\Controllers\AdminController::class, 'pengajuansemtaa'])->name('pengajuansemtaa');
    Route::get('admin/pengajuansemtaa2', [App\Http\Controllers\AdminController::class, 'pengajuansemtaa2'])->name('pengajuansemtaa2');
    Route::get('admin/pengajuansemtaa3', [App\Http\Controllers\AdminController::class, 'pengajuansemtaa3'])->name('pengajuansemtaa3');
    Route::get('admin/tolakpengajuansemtaa/{id}', [App\Http\Controllers\AdminController::class, 'tolakpengajuansemtaa'])->name('tolakpengajuansemtaa');
    Route::get('admin/terimapengajuansemtaa/{id}', [App\Http\Controllers\AdminController::class, 'terimapengajuansemtaa'])->name('terimapengajuansemtaa');
    Route::get('admin/prosespengajuansemtaa/{id}', [App\Http\Controllers\AdminController::class, 'prosespengajuansemtaa'])->name('prosespengajuansemtaa');

    Route::get('admin/pengajuanstaa', [App\Http\Controllers\AdminController::class, 'pengajuanstaa'])->name('pengajuanstaa');
    Route::get('admin/pengajuanstaa2', [App\Http\Controllers\AdminController::class, 'pengajuanstaa2'])->name('pengajuanstaa2');
    Route::get('admin/pengajuanstaa3', [App\Http\Controllers\AdminController::class, 'pengajuanstaa3'])->name('pengajuanstaa3');
    Route::get('admin/tolakpengajuanstaa/{id}', [App\Http\Controllers\AdminController::class, 'tolakpengajuanstaa'])->name('tolakpengajuanstaa');
    Route::get('admin/terimapengajuanstaa/{id}', [App\Http\Controllers\AdminController::class, 'terimapengajuanstaa'])->name('terimapengajuanstaa');
    Route::get('admin/prosespengajuanstaa/{id}', [App\Http\Controllers\AdminController::class, 'prosespengajuanstaa'])->name('prosespengajuanstaa');

    Route::get('admin/pengajuanskpp', [App\Http\Controllers\AdminController::class, 'pengajuanskpp'])->name('pengajuanskpp');
    Route::get('admin/pengajuanskpp2', [App\Http\Controllers\AdminController::class, 'pengajuanskpp2'])->name('pengajuanskpp2');
    Route::get('admin/pengajuanskpp3', [App\Http\Controllers\AdminController::class, 'pengajuanskpp3'])->name('pengajuanskpp3');
    Route::get('admin/tolakpengajuanskpp/{id}', [App\Http\Controllers\AdminController::class, 'tolakpengajuanskpp'])->name('tolakpengajuanskpp');
    Route::get('admin/terimapengajuanskpp/{id}', [App\Http\Controllers\AdminController::class, 'terimapengajuanskpp'])->name('terimapengajuanskpp');
    Route::get('admin/prosespengajuanskpp/{id}', [App\Http\Controllers\AdminController::class, 'prosespengajuanskpp'])->name('prosespengajuanskpp');

    Route::get('admin/pengajuanpskkpp', [App\Http\Controllers\AdminController::class, 'pengajuanpskkpp'])->name('pengajuanpskkpp');
    Route::get('admin/pengajuanpskkpp2', [App\Http\Controllers\AdminController::class, 'pengajuanpskkpp2'])->name('pengajuanpskkpp2');
    Route::get('admin/pengajuanpskkpp3', [App\Http\Controllers\AdminController::class, 'pengajuanpskkpp3'])->name('pengajuanpskkpp3');
    Route::get('admin/tolakpengajuanpskkpp/{id}', [App\Http\Controllers\AdminController::class, 'tolakpengajuanpskkpp'])->name('tolakpengajuanpskkpp');
    Route::get('admin/terimapengajuanpskkpp/{id}', [App\Http\Controllers\AdminController::class, 'terimapengajuanpskkpp'])->name('terimapengajuanpskkpp');
    Route::get('admin/prosespengajuanpskkpp/{id}', [App\Http\Controllers\AdminController::class, 'prosespengajuanpskkpp'])->name('prosespengajuanpskkpp');

    Route::get('admin/pengajuanbpitt', [App\Http\Controllers\AdminController::class, 'pengajuanbpitt'])->name('pengajuanbpitt');
    Route::get('admin/pengajuanbpitt2', [App\Http\Controllers\AdminController::class, 'pengajuanbpitt2'])->name('pengajuanbpitt2');
    Route::get('admin/pengajuanbpitt3', [App\Http\Controllers\AdminController::class, 'pengajuanbpitt3'])->name('pengajuanbpitt3');
    Route::get('admin/tolakpengajuanbpitt/{id}', [App\Http\Controllers\AdminController::class, 'tolakpengajuanbpitt'])->name('tolakpengajuanbpitt');
    Route::get('admin/terimapengajuanbpitt/{id}', [App\Http\Controllers\AdminController::class, 'terimapengajuanbpitt'])->name('terimapengajuanbpitt');
    Route::get('admin/prosespengajuanbpitt/{id}', [App\Http\Controllers\AdminController::class, 'prosespengajuanbpitt'])->name('prosespengajuanbpitt');

    Route::get('admin/pengajuanpptakpp', [App\Http\Controllers\AdminController::class, 'pengajuanpptakpp'])->name('pengajuanpptakpp');
    Route::get('admin/pengajuanpptakpp2', [App\Http\Controllers\AdminController::class, 'pengajuanpptakpp2'])->name('pengajuanpptakpp2');
    Route::get('admin/pengajuanpptakpp3', [App\Http\Controllers\AdminController::class, 'pengajuanpptakpp3'])->name('pengajuanpptakpp3');
    Route::get('admin/tolakpengajuanpptakpp/{id}', [App\Http\Controllers\AdminController::class, 'tolakpengajuanpptakpp'])->name('tolakpengajuanpptakpp');
    Route::get('admin/terimapengajuanpptakpp/{id}', [App\Http\Controllers\AdminController::class, 'terimapengajuanpptakpp'])->name('terimapengajuanpptakpp');
    Route::get('admin/prosespengajuanpptakpp/{id}', [App\Http\Controllers\AdminController::class, 'prosespengajuanpptakpp'])->name('prosespengajuanpptakpp');

    Route::get('admin/pengajuanulkpp', [App\Http\Controllers\AdminController::class, 'pengajuanulkpp'])->name('pengajuanulkpp');
    Route::get('admin/pengajuanulkpp2', [App\Http\Controllers\AdminController::class, 'pengajuanulkpp2'])->name('pengajuanulkpp2');
    Route::get('admin/pengajuanulkpp3', [App\Http\Controllers\AdminController::class, 'pengajuanulkpp3'])->name('pengajuanulkpp3');
    Route::get('admin/tolakpengajuanulkpp/{id}', [App\Http\Controllers\AdminController::class, 'tolakpengajuanulkpp'])->name('tolakpengajuanulkpp');
    Route::get('admin/terimapengajuanulkpp/{id}', [App\Http\Controllers\AdminController::class, 'terimapengajuanulkpp'])->name('terimapengajuanulkpp');
    Route::get('admin/prosespengajuanulkpp/{id}', [App\Http\Controllers\AdminController::class, 'prosespengajuanulkpp'])->name('prosespengajuanulkpp');

    Route::get('admin/pengajuanultaa', [App\Http\Controllers\AdminController::class, 'pengajuanultaa'])->name('pengajuanultaa');
    Route::get('admin/pengajuanultaa2', [App\Http\Controllers\AdminController::class, 'pengajuanultaa2'])->name('pengajuanultaa2');
    Route::get('admin/pengajuanultaa2', [App\Http\Controllers\AdminController::class, 'pengajuanultaa2'])->name('pengajuanultaa2');
    Route::get('admin/tolakpengajuanultaa/{id}', [App\Http\Controllers\AdminController::class, 'tolakpengajuanultaa'])->name('tolakpengajuanultaa');
    Route::get('admin/terimapengajuanultaa/{id}', [App\Http\Controllers\AdminController::class, 'terimapengajuanultaa'])->name('terimapengajuanultaa');
    Route::get('admin/prosespengajuanultaa/{id}', [App\Http\Controllers\AdminController::class, 'prosespengajuanultaa'])->name('prosespengajuanultaa');

    Route::get('admin/legalisasii', [App\Http\Controllers\AdminController::class, 'legalisasii'])->name('legalisasii');
    Route::get('admin/legalisasii2', [App\Http\Controllers\AdminController::class, 'legalisasii2'])->name('legalisasii2');
    Route::get('admin/legalisasii3', [App\Http\Controllers\AdminController::class, 'legalisasii3'])->name('legalisasii3');
    Route::get('admin/tolaklegalisasii/{id}', [App\Http\Controllers\AdminController::class, 'tolaklegalisasii'])->name('tolaklegalisasii');
    Route::get('admin/terimalegalisasii/{id}', [App\Http\Controllers\AdminController::class, 'terimalegalisasii'])->name('terimalegalisasii');
    Route::get('admin/proseslegalisasii/{id}', [App\Http\Controllers\AdminController::class, 'proseslegalisasii'])->name('proseslegalisasii');

    Route::get('admin/pengajuanpsktaa', [App\Http\Controllers\AdminController::class, 'pengajuanpsktaa'])->name('pengajuanpsktaa');
    Route::get('admin/pengajuanpsktaa2', [App\Http\Controllers\AdminController::class, 'pengajuanpsktaa2'])->name('pengajuanpsktaa2');
    Route::get('admin/pengajuanpsktaa3', [App\Http\Controllers\AdminController::class, 'pengajuanpsktaa3'])->name('pengajuanpsktaa3');
    Route::get('admin/tolakpengajuanpsktaa/{id}', [App\Http\Controllers\AdminController::class, 'tolakpengajuanpsktaa'])->name('tolakpengajuanpsktaa');
    Route::get('admin/terimapengajuanpsktaa/{id}', [App\Http\Controllers\AdminController::class, 'terimapengajuanpsktaa'])->name('terimapengajuanpsktaa');
    Route::get('admin/prosespengajuanpsktaa/{id}', [App\Http\Controllers\AdminController::class, 'prosespengajuanpsktaa'])->name('prosespengajuanpsktaa');

    Route::get('admin/daftar-user', [App\Http\Controllers\AdminController::class, 'user'])->name('daftar_userr');
    Route::POST('admin/tambah-user', [App\Http\Controllers\AdminController::class, 'tambahuser'])->name('tambah_user');
    Route::get('/admin/user/{id}/delete', [App\Http\Controllers\AdminController::class, 'deleteuserrr'])->name('delete_user');

    // Route::view('admin/notifikasi-masyarakat', 'masyarakat/notifikasi_masyarakat')->name('notifikasi_masyarakat');

    Route::get('admin/download-lampiran', [GoogleDriveController::class, 'download'])->name('downloadLampiran');

    Route::get('admin/info', [App\Http\Controllers\AdminController::class, 'info'])->name('info');


});

Route::get('/informasi', [App\Http\Controllers\AdminController::class, 'tampilinformasi'])->name('informasi');

//Admin Routes List
Route::middleware(['auth', 'user-access:administrator'])->group(function () {

    Route::get('/administrator/beranda', [HomeController::class, 'administrator'])->name('administrator.beranda');
    Route::get('/administrator/profileadministrator', [App\Http\Controllers\AdministratorController::class, 'index'])->name('profileadministrator.index');
    Route::patch('/administrator/profileadministrator/{id}', [App\Http\Controllers\AdministratorController::class, 'update'])->name('profileadministrator.update');

    Route::get('administrator/pengajuanspta', [App\Http\Controllers\AdministratorController::class, 'pengajuanspta'])->name('pengajuanspta');
    Route::get('administrator/pengajuanspta2', [App\Http\Controllers\AdministratorController::class, 'pengajuanspta2'])->name('pengajuanspta2');
	 Route::get('administrator/pengajuanspta3', [App\Http\Controllers\AdministratorController::class, 'pengajuanspta3'])->name('pengajuanspta3');
    Route::get('administrator/tolakpengajuanspta/{id}', [App\Http\Controllers\AdministratorController::class, 'tolakpengajuanspta'])->name('tolakpengajuanspta');
    Route::get('administrator/terimapengajuanspta/{id}', [App\Http\Controllers\AdministratorController::class, 'terimapengajuanspta'])->name('terimapengajuanspta');
    Route::get('administrator/prosespengajuanspta/{id}', [App\Http\Controllers\AdministratorController::class, 'prosespengajuanspta'])->name('prosespengajuanspta');

    Route::get('administrator/pengajuansemta', [App\Http\Controllers\AdministratorController::class, 'pengajuansemta'])->name('pengajuansemta');
    Route::get('administrator/pengajuansemta2', [App\Http\Controllers\AdministratorController::class, 'pengajuansemta2'])->name('pengajuansemta2');
	Route::get('administrator/pengajuansemta3', [App\Http\Controllers\AdministratorController::class, 'pengajuansemta3'])->name('pengajuansemta3');
    Route::get('administrator/tolakpengajuansemta/{id}', [App\Http\Controllers\AdministratorController::class, 'tolakpengajuansemta'])->name('tolakpengajuansemta');
    Route::get('administrator/terimapengajuansemta/{id}', [App\Http\Controllers\AdministratorController::class, 'terimapengajuansemta'])->name('terimapengajuansemta');
	Route::get('administrator/prosespengajuansemta/{id}', [App\Http\Controllers\AdministratorController::class, 'prosespengajuansemta'])->name('prosespengajuansemta');

    Route::get('administrator/pengajuansta', [App\Http\Controllers\AdministratorController::class, 'pengajuansta'])->name('pengajuansta');
    Route::get('administrator/pengajuansta2', [App\Http\Controllers\AdministratorController::class, 'pengajuansta2'])->name('pengajuansta2');
	Route::get('administrator/pengajuansta3', [App\Http\Controllers\AdministratorController::class, 'pengajuansta3'])->name('pengajuansta3');
    Route::get('administrator/tolakpengajuansta/{id}', [App\Http\Controllers\AdministratorController::class, 'tolakpengajuansta'])->name('tolakpengajuansta');
    Route::get('administrator/terimapengajuansta/{id}', [App\Http\Controllers\AdministratorController::class, 'terimapengajuansta'])->name('terimapengajuansta');
    Route::get('administrator/prosespengajuansta/{id}', [App\Http\Controllers\AdministratorController::class, 'prosespengajuansta'])->name('prosespengajuansta');

    Route::get('administrator/pengajuanskp', [App\Http\Controllers\AdministratorController::class, 'pengajuanskp'])->name('pengajuanskp');
    Route::get('administrator/pengajuanskp2', [App\Http\Controllers\AdministratorController::class, 'pengajuanskp2'])->name('pengajuanskp2');
	Route::get('administrator/pengajuanskp3', [App\Http\Controllers\AdministratorController::class, 'pengajuanskp3'])->name('pengajuanskp3');
    Route::get('administrator/tolakpengajuanskp/{id}', [App\Http\Controllers\AdministratorController::class, 'tolakpengajuanskp'])->name('tolakpengajuanskp');
    Route::get('administrator/terimapengajuanskp/{id}', [App\Http\Controllers\AdministratorController::class, 'terimapengajuanskp'])->name('terimapengajuanskp');
	Route::get('administrator/prosespengajuanskp/{id}', [App\Http\Controllers\AdministratorController::class, 'prosespengajuanskp'])->name('prosespengajuanskp');

    Route::get('administrator/pengajuanpskkp', [App\Http\Controllers\AdministratorController::class, 'pengajuanpskkp'])->name('pengajuanpskkp');
    Route::get('administrator/pengajuanpskkp2', [App\Http\Controllers\AdministratorController::class, 'pengajuanpskkp2'])->name('pengajuanpskkp2');
	Route::get('administrator/pengajuanpskkp3', [App\Http\Controllers\AdministratorController::class, 'pengajuanpskkp3'])->name('pengajuanpskkp3');
    Route::get('administrator/tolakpengajuanpskkp/{id}', [App\Http\Controllers\AdministratorController::class, 'tolakpengajuanpskkp'])->name('tolakpengajuanpskkp');
    Route::get('administrator/terimapengajuanpskkp/{id}', [App\Http\Controllers\AdministratorController::class, 'terimapengajuanpskkp'])->name('terimapengajuanpskkp');
	Route::get('administrator/prosespengajuanpskkp/{id}', [App\Http\Controllers\AdministratorController::class, 'prosespengajuanpskkp'])->name('prosespengajuanpskkp');

    Route::get('administrator/pengajuanbpit', [App\Http\Controllers\AdministratorController::class, 'pengajuanbpit'])->name('pengajuanbpit');
    Route::get('administrator/pengajuanbpit2', [App\Http\Controllers\AdministratorController::class, 'pengajuanbpit2'])->name('pengajuanbpit2');
	Route::get('administrator/pengajuanbpit3', [App\Http\Controllers\AdministratorController::class, 'pengajuanbpit3'])->name('pengajuanbpit3');
    Route::get('administrator/tolakpengajuanbpit/{id}', [App\Http\Controllers\AdministratorController::class, 'tolakpengajuanbpit'])->name('tolakpengajuanbpit');
    Route::get('administrator/terimapengajuanbpit/{id}', [App\Http\Controllers\AdministratorController::class, 'terimapengajuanbpit'])->name('terimapengajuanbpit');
	Route::get('administrator/prosespengajuanbpit/{id}', [App\Http\Controllers\AdministratorController::class, 'prosespengajuanbpit'])->name('prosespengajuanbpit');

    Route::get('administrator/pengajuanpptakp', [App\Http\Controllers\AdministratorController::class, 'pengajuanpptakp'])->name('pengajuanpptakp');
    Route::get('administrator/pengajuanpptakp2', [App\Http\Controllers\AdministratorController::class, 'pengajuanpptakp2'])->name('pengajuanpptakp2');
	Route::get('administrator/pengajuanpptakp3', [App\Http\Controllers\AdministratorController::class, 'pengajuanpptakp3'])->name('pengajuanpptakp3');
    Route::get('administrator/tolakpengajuanpptakp/{id}', [App\Http\Controllers\AdministratorController::class, 'tolakpengajuanpptakp'])->name('tolakpengajuanpptakp');
    Route::get('administrator/terimapengajuanpptakp/{id}', [App\Http\Controllers\AdministratorController::class, 'terimapengajuanpptakp'])->name('terimapengajuanpptakp');
	Route::get('administrator/prosespengajuanpptakp/{id}', [App\Http\Controllers\AdministratorController::class, 'prosespengajuanpptakp'])->name('prosespengajuanpptakp');

    Route::get('administrator/pengajuanulkp', [App\Http\Controllers\AdministratorController::class, 'pengajuanulkp'])->name('pengajuanulkp');
    Route::get('administrator/pengajuanulkp2', [App\Http\Controllers\AdministratorController::class, 'pengajuanulkp2'])->name('pengajuanulkp2');
    Route::get('administrator/tolakpengajuanulkp/{id}', [App\Http\Controllers\AdministratorController::class, 'tolakpengajuanulkp'])->name('tolakpengajuanulkp');
    Route::get('administrator/terimapengajuanulkp/{id}', [App\Http\Controllers\AdministratorController::class, 'terimapengajuanulkp'])->name('terimapengajuanulkp');

    Route::get('administrator/pengajuanulta', [App\Http\Controllers\AdministratorController::class, 'pengajuanulta'])->name('pengajuanulta');
    Route::get('administrator/pengajuanulta2', [App\Http\Controllers\AdministratorController::class, 'pengajuanulta2'])->name('pengajuanulta2');
    Route::get('administrator/tolakpengajuanulta/{id}', [App\Http\Controllers\AdministratorController::class, 'tolakpengajuanulta'])->name('tolakpengajuanulta');
    Route::get('administrator/terimapengajuanulta/{id}', [App\Http\Controllers\AdministratorController::class, 'terimapengajuanulta'])->name('terimapengajuanulta');

    Route::get('administrator/legalisasi', [App\Http\Controllers\AdministratorController::class, 'legalisasi'])->name('legalisasi');
    Route::get('administrator/legalisasi2', [App\Http\Controllers\AdministratorController::class, 'legalisasi2'])->name('legalisasi2');
    Route::get('administrator/legalisasi3', [App\Http\Controllers\AdministratorController::class, 'legalisasi3'])->name('legalisasi3');
    Route::get('administrator/tolaklegalisasi/{id}', [App\Http\Controllers\AdministratorController::class, 'tolaklegalisasi'])->name('tolaklegalisasi');
    Route::get('administrator/terimalegalisasi/{id}', [App\Http\Controllers\AdministratorController::class, 'terimalegalisasi'])->name('terimalegalisasi');
    Route::get('administrator/proseslegalisasi/{id}', [App\Http\Controllers\AdministratorController::class, 'proseslegalisasi'])->name('proseslegalisasi');


    Route::get('administrator/pengajuanpskta', [App\Http\Controllers\AdministratorController::class, 'pengajuanpskta'])->name('pengajuanpskta');
    Route::get('administrator/pengajuanpskta2', [App\Http\Controllers\AdministratorController::class, 'pengajuanpskta2'])->name('pengajuanpskta2');
    Route::get('administrator/pengajuanpskta3', [App\Http\Controllers\AdministratorController::class, 'pengajuanpskta3'])->name('pengajuanpskta3');
    Route::get('administrator/tolakpengajuanpskta/{id}', [App\Http\Controllers\AdministratorController::class, 'tolakpengajuanpskta'])->name('tolakpengajuanpskta');
    Route::get('administrator/terimapengajuanpskta/{id}', [App\Http\Controllers\AdministratorController::class, 'terimapengajuanpskta'])->name('terimapengajuanpskta');
    Route::get('administrator/prosespengajuanpskta/{id}', [App\Http\Controllers\AdministratorController::class, 'prosespengajuanpskta'])->name('prosespengajuanpskta');

    Route::get('administrator/daftar-user', [App\Http\Controllers\AdministratorController::class, 'user'])->name('daftar_user');
    Route::POST('administrator/tambah-user', [App\Http\Controllers\AdministratorController::class, 'tambahuser'])->name('tambah_user');
    Route::get('/administrator/user/{id}/delete', [App\Http\Controllers\AdministratorController::class, 'deleteuserrr'])->name('delete_user');

    // Route::view('administrator/notifikasi-masyarakat', 'masyarakat/notifikasi_masyarakat')->name('notifikasi_masyarakat');

    Route::get('administrator/download-lampiran', [GoogleDriveController::class, 'download'])->name('downloadLampiran');

    Route::get('administrator/info', [App\Http\Controllers\AdministratorController::class, 'info'])->name('info');

});


//Routes List Pengajuanspta
Route::get('/mahasiswa/pengajuanspta', [App\Http\Controllers\MahasiswaController::class, 'pengajuanspta'])->name('mahasiswa.pengajuanspta');
Route::post('/pengajuansptastore', [App\Http\Controllers\MahasiswaController::class, 'pengajuansptastore'])->name('pengajuansptastore');

//Routes List Pengajuansemta
Route::get('/mahasiswa/pengajuansemta', [App\Http\Controllers\MahasiswaController::class, 'pengajuansemta'])->name('mahasiswa.pengajuansemta');
Route::post('/pengajuansemtastore', [App\Http\Controllers\MahasiswaController::class, 'pengajuansemtastore'])->name('pengajuansemtastore');

//Routes List Pengajuansta
Route::get('/mahasiswa/pengajuansta', [App\Http\Controllers\MahasiswaController::class, 'pengajuansta'])->name('mahasiswa.pengajuansta');
Route::post('/pengajuanstastore', [App\Http\Controllers\MahasiswaController::class, 'pengajuanstastore'])->name('pengajuanstastore');

//Routes List Pengajuanskp
Route::get('/mahasiswa/pengajuanskp', [App\Http\Controllers\MahasiswaController::class, 'pengajuanskp'])->name('mahasiswa.pengajuanskp');
Route::post('/pengajuanskpstore', [App\Http\Controllers\MahasiswaController::class, 'pengajuanskpstore'])->name('pengajuanskpstore');

//Routes List Pengajuanpskkp
Route::get('/mahasiswa/pengajuanpskkp', [App\Http\Controllers\MahasiswaController::class, 'pengajuanpskkp'])->name('mahasiswa.pengajuanpskkp');
Route::post('/pengajuanpskkpstore', [App\Http\Controllers\MahasiswaController::class, 'pengajuanpskkpstore'])->name('pengajuanpskkpstore');

//Routes List Pengajuanpptakp
Route::get('/mahasiswa/pengajuanpptakp', [App\Http\Controllers\MahasiswaController::class, 'pengajuanpptakp'])->name('mahasiswa.pengajuanpptakp');
Route::post('/pengajuanpptakpstore', [App\Http\Controllers\MahasiswaController::class, 'pengajuanpptakpstore'])->name('pengajuanpptakpstore');

//Routes List Pengajuanulta
Route::get('/mahasiswa/pengajuanulta', [App\Http\Controllers\MahasiswaController::class, 'pengajuanulta'])->name('mahasiswa.pengajuanulta');
Route::post('/pengajuanultastore', [App\Http\Controllers\MahasiswaController::class, 'pengajuanultastore'])->name('pengajuanultastore');

//Routes List Pengajuanulkp
Route::get('/mahasiswa/pengajuanulkp', [App\Http\Controllers\MahasiswaController::class, 'pengajuanulkp'])->name('mahasiswa.pengajuanulkp');
Route::post('/pengajuanulkpstore', [App\Http\Controllers\MahasiswaController::class, 'pengajuanulkpstore'])->name('pengajuanulkpstore');

//Routes List Pengajuanbpit
Route::get('/mahasiswa/pengajuanbpit', [App\Http\Controllers\MahasiswaController::class, 'pengajuanbpit'])->name('mahasiswa.pengajuanbpit');
Route::post('/pengajuanbpitstore', [App\Http\Controllers\MahasiswaController::class, 'pengajuanbpitstore'])->name('pengajuanbpitstore');

//Routes List Legalisasi
Route::get('/mahasiswa/legalisasi', [App\Http\Controllers\MahasiswaController::class, 'legalisasi'])->name('mahasiswa.legalisasi');
Route::post('/legalisasistore', [App\Http\Controllers\MahasiswaController::class, 'legalisasistore'])->name('legalisasistore');

//Routes List Legalisasi
Route::get('/mahasiswa/pengajuanpskta', [App\Http\Controllers\MahasiswaController::class, 'pengajuanpskta'])->name('mahasiswa.pengajuanpskta');
Route::post('/pengajuanpsktastore', [App\Http\Controllers\MahasiswaController::class, 'pengajuanpsktastore'])->name('pengajuanpsktastore');
