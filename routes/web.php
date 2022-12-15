<?php

use App\Http\Controllers\itemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukMasukController;
use App\Http\Controllers\ProdukKeluarController;
use App\Http\Controllers\PenjualanController;
use Illuminate\Support\Facades\Route;
Use App\Models\item;

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
    return view('login.index', [
        "title" => "Home"
    ]);
})->middleware('guest');

Route::get('/home', function () {
    return view('home', [
        "title" => "Home"
    ]);
})->middleware('auth');


// Route::get('/', [LoginController::class, 'index'])->middleware('guest');
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::get('/tambah-pengguna', [RegisterController::class, 'tambah'])->middleware('admin');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');
Route::post('/tambah-pengguna', [RegisterController::class, 'store2'])->middleware('admin');

Route::get('/admin', [AdminController::class, 'index'])->middleware('auth');
Route::get('/items', [itemController::class, 'index']);
Route::get('/items/{item:slug}', [itemController::class, 'show']);
Route::post('/items/{item:slug}', [itemController::class, 'update']);
Route::get('/tambah-barang', [itemController::class, 'add']);
Route::post('/tambah-barang', [itemController::class, 'store']);
Route::get('/items/hapus/{item:id}', [itemController::class, 'delete']);

Route::get('/kategoris', [KategoriController::class, 'index']);
Route::get('/kategoris/{id}', [KategoriController::class, 'show']);
Route::get('/kategoris/hapus/{kategoris:id}', [KategoriController::class, 'delete']);
Route::get('/tambah-kategori', [KategoriController::class, 'add']);
Route::post('/tambah-kategori', [KategoriController::class, 'store']);
Route::post('/kategoris/{id}', [KategoriController::class, 'update']);

Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/customers/{customer:id}', [CustomerController::class, 'show']);
Route::get('/tambah-customer', [CustomerController::class, 'add']);
Route::post('/tambah-customer', [CustomerController::class, 'store']);
Route::get('/customers/hapus/{customer:id}', [CustomerController::class, 'delete']);
Route::post('/customers/{customer:id}', [CustomerController::class, 'update']);
// Route::get('/customers', [itemController::class, 'index'])->middleware('auth');

Route::get('/penggunas', [UserController::class, 'index']);
Route::get('/penggunas/{user:id}', [UserController::class, 'show']);
Route::post('/penggunas/{user:id}', [UserController::class, 'update']);
Route::get('/penggunas/hapus/{user:id}', [UserController::class, 'delete']);
// Route::post('/hapus-pengguna/{ $user[id] }', [UserController::class, 'destroy']);

Route::get('/suppliers', [SupplierController::class, 'index']);
Route::get('/tambah-supplier', [SupplierController::class, 'add']);
Route::post('/tambah-supplier', [SupplierController::class, 'store']);
Route::get('/suppliers/{supplier:id}', [SupplierController::class, 'show']);
Route::post('/suppliers/{supplier:id}', [SupplierController::class, 'update']);
Route::get('/suppliers/hapus/{supplier:id}', [SupplierController::class, 'delete']);

Route::get('/produk-masuk', [ProdukMasukController::class, 'index']);
Route::get('/tambah-produk-masuk', [ProdukMasukController::class, 'add']);
Route::post('/tambah-produk-masuk', [ProdukMasukController::class, 'store']);
Route::get('/produk-masuk/{produk_masuk:id}', [ProdukMasukController::class, 'show']);
Route::get('/produk-masuk/hapus/{produk_masuk:id}', [ProdukMasukController::class, 'delete']);

Route::get('/produk-keluar', [ProdukKeluarController::class, 'index']);
Route::get('/tambah-produk-keluar', [ProdukKeluarController::class, 'add']);
Route::post('/tambah-produk-keluar', [ProdukKeluarController::class, 'store']);


Route::get('/transaksi', [PenjualanController::class, 'index']);
Route::post('/transaksi', [PenjualanController::class, 'store']);


Route::get('/get_kasir', [PenjualanController::class, 'get_kasir']);

Route::get('/laporan', function () {
    return view('Laporan', [
        "title" => "laporan"
    ]);
});