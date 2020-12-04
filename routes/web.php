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


Auth::routes();
//interface
Route::get('/', 'user\WelcomeController@index')->name('home');
Route::get('/home', 'user\WelcomeController@index')->name('home2');
Route::get('/kontak', 'user\WelcomeController@kontak')->name('kontak');
Route::name('user.')->group(function () {
    Route::get('/menu', 'user\MenuController@index')->name('menu');
    Route::get('/menu/cari', 'user\MenuController@cari')->name('menu.cari');
    Route::get('/menu/{id}', 'user\MenuController@detail')->name('menu.detail');
});

//admin
Route::name('admin.')->middleware('auth', 'checkRole:admin')->group(function () {
    Route::get('/admin', 'DashboardController@index')->name('dashboard');
    //menu
    Route::name('menu.')->group(function () {
        Route::get('/admin/menu', 'admin\MenuController@index')->name('index');
        Route::get('/admin/menu/tambah', 'admin\MenuController@tambah')->name('tambah');
        Route::post('/admin/menu/store', 'admin\MenuController@store')->name('store');
        Route::get('/admin/menu/edit/{id}', 'admin\MenuController@edit')->name('edit');
        Route::get('/admin/menu/delete/{id}', 'admin\MenuController@delete')->name('delete');
        Route::post('/admin/menu/update/{id}', 'admin\MenuController@update')->name('update');
    });

    //transaksi
    Route::name('transaksi.')->group(function () {
        Route::get('/admin/transaksi', 'admin\TransaksiController@index')->name('index');
        Route::get('/admin/transaksi/perludibayar', 'admin\TransaksiController@perludibayar')->name('perludibayar');
        Route::get('/admin/transaksi/perludikirim', 'admin\TransaksiController@perludikirim')->name('perludikirim');
        Route::get('/admin/transaksi/detail/{id}', 'admin\TransaksiController@detail')->name('detail');
        Route::get('/admin/transaksi/selesai', 'admin\TransaksiController@selesai')->name('selesai');
        Route::get('/admin/transaksi/dibatalkan', 'admin\TransaksiController@dibatalkan')->name('dibatalkan');
        Route::get('/admin/transaksi/cek/{id}', 'admin\TransaksiController@ceked')->name('cek');
        Route::get('/admin/transaksi/konfirmasi/{id}', 'admin\TransaksiController@konfirmasi')->name('konfirmasi');
        Route::post('/admin/transaksi/inputpesanan/{id}', 'admin\TransaksiController@inputpesanan')->name('inputpesanan');
    });
    //pelanggan
    Route::get('/admin/pelanggan', 'admin\PelangganController@index')->name('pelanggan');
});


//costumer
Route::name('user.')->middleware('auth', 'checkRole:customer')->group(function () {
    //keranjang
    Route::name('keranjang.')->group(function () {
        Route::get('/keranjang', 'user\KeranjangController@index')->name('index');
        Route::post('/keranjang/pesan', 'user\KeranjangController@pesan')->name('pesan');
        Route::post('/keranjang/update', 'user\KeranjangController@update')->name('update');
        Route::get('/keranjang/delete/{id}', 'user\KeranjangController@delete')->name('delete');
    });
    //order
    Route::name('order.')->group(function () {
        Route::get('/order', 'user\OrderController@index')->name('index');
        Route::get('/order/detail/{id}', 'user\OrderController@detail')->name('detail');
        Route::get('/order/sukses', 'user\OrderController@sukses')->name('sukses');
        Route::post('/order/pesanan', 'user\OrderController@pesanan')->name('pesanan');
        Route::get('/order/pesanandibatalkan/{id}', 'user\OrderController@pesanandibatalkan')->name('pesanandibatalkan');
        Route::get('/order/pembayaran/{id}', 'user\OrderController@pembayaran')->name('pembayaran');
        Route::get('/order/pesanan/sudah/{id}', 'user\OrderController@sudah')->name('sudah');
    });
    //checkout
    Route::get('/checkout', 'user\CheckoutController@index')->name('checkout');
});
//test
