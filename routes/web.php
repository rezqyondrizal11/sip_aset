<?php

use App\Http\Controllers\AsetTetapController;
use App\Http\Controllers\AsetTidakTetapController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisbarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenghapusanAsetController;
use App\Http\Controllers\UserController;
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

Route::group(['middleware' => 'auth'], function () {

    Route::prefix('/system')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home.index');


        //profile
        Route::group(['prefix' => '/profile', 'as' => 'profile.'], function () {
            Route::get('profile', [LoginController::class, 'profile'])->name('profile');
            Route::get('change-password', [LoginController::class, 'changepassword'])->name('changepassword');
            Route::post('updateprofile', [LoginController::class, 'updateprofile'])->name('updateprofile');
            Route::post('updatechangepassword', [LoginController::class, 'updatechangepassword'])->name('updatechangepassword');
        });



        Route::group(['middleware' => 'role:admin'], function () {
            //user
            Route::group(['prefix' => '/user', 'as' => 'user.'], function () {
                Route::get('/', [UserController::class, 'index'])->name('index');
                Route::get('/create', [UserController::class, 'create'])->name('create');
                Route::post('/store', [UserController::class, 'store'])->name('store');
                Route::get('edit/{id}/', [UserController::class, 'edit'])->name('edit');
                Route::put('update', [UserController::class, 'update'])->name('update');
                Route::get('/destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
                Route::post('/update-status', [UserController::class, 'updateStatus'])->name('updateStatus');
            });

            //kategori
            Route::group(['prefix' => '/kategori', 'as' => 'kategori.'], function () {
                Route::get('/', [KategoriController::class, 'index'])->name('index');
                Route::get('/create', [KategoriController::class, 'create'])->name('create');
                Route::post('/store', [KategoriController::class, 'store'])->name('store');
                Route::get('edit/{id}/', [KategoriController::class, 'edit'])->name('edit');
                Route::post('show/{id}/', [KategoriController::class, 'show'])->name('show');

                Route::put('update', [KategoriController::class, 'update'])->name('update');
                Route::get('/destroy/{id}', [KategoriController::class, 'destroy'])->name('destroy');
            });

            //jenis barang
            Route::group(['prefix' => '/jenis-barang', 'as' => 'jenisbarang.'], function () {
                Route::get('/', [JenisbarangController::class, 'index'])->name('index');
                Route::get('/create', [JenisbarangController::class, 'create'])->name('create');
                Route::post('/store', [JenisbarangController::class, 'store'])->name('store');
                Route::get('edit/{id}/', [JenisbarangController::class, 'edit'])->name('edit');
                Route::put('update', [JenisbarangController::class, 'update'])->name('update');
                Route::get('/destroy/{id}', [JenisbarangController::class, 'destroy'])->name('destroy');
            });
        });

        // Rute untuk pegawai
        Route::group(['middleware' => 'role:pegawai'], function () {
            //aset tetap
            Route::group(['prefix' => '/aset-tetap', 'as' => 'asettetap.'], function () {
                Route::get('/', [AsetTetapController::class, 'index'])->name('index');
                Route::get('/create/{id}', [AsetTetapController::class, 'create'])->name('create');
                Route::post('/store', [AsetTetapController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [AsetTetapController::class, 'edit'])->name('edit');
                Route::put('/update', [AsetTetapController::class, 'update'])->name('update');
                Route::get('/destroy/{id}', [AsetTetapController::class, 'destroy'])->name('destroy');
                Route::get('/data/{categoryId}', [AsetTetapController::class, 'getData'])->name('data');
                Route::get('/print/{id}/{year}', [AsetTetapController::class, 'print'])->name('print');
            });

            //penghapusan aset
            Route::group(['prefix' => '/penghapusan-aset', 'as' => 'penghapusanaset.'], function () {
                Route::get('/', [PenghapusanAsetController::class, 'index'])->name('index');
                Route::get('/data/{categoryId}', [PenghapusanAsetController::class, 'getData'])->name('data');
                Route::get('/print/{id}/{year}', [PenghapusanAsetController::class, 'print'])->name('print');
                Route::get('/destroy/{id}', [PenghapusanAsetController::class, 'destroy'])->name('destroy');
            });

            //aset tidak tetap
            Route::group(['prefix' => '/aset-tidak-tetap', 'as' => 'asettidaktetap.'], function () {
                Route::get('/', [AsetTidakTetapController::class, 'index'])->name('index');
                Route::get('/create', [AsetTidakTetapController::class, 'create'])->name('create');
                Route::post('/store', [AsetTidakTetapController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [AsetTidakTetapController::class, 'edit'])->name('edit');
                Route::put('/update', [AsetTidakTetapController::class, 'update'])->name('update');
                Route::get('/destroy/{id}', [AsetTidakTetapController::class, 'destroy'])->name('destroy');


                Route::get('/barang-masuk/{id}', [AsetTidakTetapController::class, 'masuk'])->name('masuk');
                Route::get('/barang-keluar/{id}', [AsetTidakTetapController::class, 'keluar'])->name('keluar');


                Route::post('/update-barang-masuk', [AsetTidakTetapController::class, 'updatemasuk'])->name('updatemasuk');
                Route::post('/update-barang-keluar', [AsetTidakTetapController::class, 'updatekeluar'])->name('updatekeluar');

                Route::get('/print/{year}', [AsetTidakTetapController::class, 'print'])->name('print');
            });
        });

        // Rute untuk walinagari
        Route::group(['middleware' => 'role:walinagari'], function () {

            //aset tetap
            Route::group(['prefix' => '/aset-tetap', 'as' => 'asettetap.'], function () {
                Route::get('/index/wali', [AsetTetapController::class, 'indexwali'])->name('indexwali');
                Route::get('/data-wali/{categoryId}', [AsetTetapController::class, 'getDataWali'])->name('datawali');
                // Jika rute 'print' berbeda aksesnya, sesuaikan namanya atau group-nya
                Route::get('/print-wali/{id}/{year}', [AsetTetapController::class, 'print'])->name('printwali');
            });

            //aset tidak tetap
            Route::group(['prefix' => '/aset-tidak-tetap/wali', 'as' => 'asettidaktetapwali.'], function () {
                Route::get('/', [AsetTidakTetapController::class, 'indexwali'])->name('index');

                Route::get('/print/{year}', [AsetTidakTetapController::class, 'print'])->name('print');
            });

            //penghapusan aset
            Route::group(['prefix' => '/penghapusan-aset/wali', 'as' => 'penghapusanasetwali.'], function () {
                Route::get('/', [PenghapusanAsetController::class, 'index'])->name('index');
                Route::get('/data/{categoryId}', [PenghapusanAsetController::class, 'getData'])->name('data');
                Route::get('/print/{id}/{year}', [PenghapusanAsetController::class, 'print'])->name('print');
            });
        });
    });


    Route::get('/', [HomeController::class, 'index'])->name('home.index');
});



// Rute untuk login dan autentikasi
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::get('logout', [LoginController::class, 'signout'])->name('logout');
Route::post('authenticate-login', [LoginController::class, 'authenticate'])->name('login.authenticate');
