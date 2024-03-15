<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LoginCotronller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// route product admin
Route::prefix('admin')->name('admin.')->middleware('admin')->middleware('role')->group(function () {
    Route::get('dashboard', [ProductController::class, 'dashboard'])->name('dashboard');
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('list', [ProductController::class, 'index'])->name('index');
        Route::get('create', [ProductController::class, 'create'])->name('create');
        Route::post('store', [ProductController::class, 'store'])->name('store');
        Route::get('del/{id}', [ProductController::class, 'delete']);
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [ProductController::class, 'update'])->name('update');
    });
    // danh sách sản phẩm
    Route::prefix('category')->name('category.')->group(function () {
        Route::get('list', [CategoryController::class, 'index'])->name('index');
        Route::get('create', [CategoryController::class, 'create'])->name('create');
        Route::post('store', [CategoryController::class, 'store'])->name('store');
        Route::get('del/{id}', [CategoryController::class, 'delete'])->name('delete');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [CategoryController::class, 'update'])->name('update');
    });

    // danh sách người dùng
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('list', [UserController::class, 'index'])->name('index');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('store', [UserController::class, 'store'])->name('store');
        Route::get('del/{id}', [UserController::class, 'delete'])->name('delete');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [UserController::class, 'update'])->name('update');
    });
});

// route người dùng->middleware('role')
Route::prefix('page')->name('client.')->group(function () {
    Route::get('product/{id_category}',[ClientController::class,'product'])->name('product');
});
Route::get('/', [ClientController::class, 'home'])->name('home');

// Route::get('', [LoginCotronller::class, 'index'])->name('login.index');
Route::get('signup', [LoginCotronller::class, 'signup'])->name('signup')->middleware('login');
Route::post('register', [LoginCotronller::class, 'register'])->name('register')->middleware('login');
Route::post('login', [LoginCotronller::class, 'login'])->name('login');
Route::get('logout', [LoginCotronller::class, 'logout'])->name('logout');