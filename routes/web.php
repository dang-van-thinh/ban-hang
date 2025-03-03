<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\LoginCotronller;
use App\Http\Controllers\PayController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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
// route product admin
Route::prefix('admin')->name('admin.')->middleware('authen')->group(function () {
    Route::get('/', [AnalyticsController::class, 'dashboard'])->name('dashboard')->middleware('role.admin');
    //product 
    Route::prefix('product')->name('product.')->middleware('role.admin')->group(function () {
        Route::get('list', [ProductController::class, 'index'])->name('index');
        Route::get('create', [ProductController::class, 'create'])->name('create');
        Route::post('store', [ProductController::class, 'store'])->name('store');
        Route::get('del/{id}', [ProductController::class, 'delete'])->name('delete');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [ProductController::class, 'update'])->name('update');
    });
    // danh sách danh mucj sản phẩm
    Route::prefix('category')->name('category.')->middleware('role.admin')->group(function () {
        Route::get('list', [CategoryController::class, 'index'])->name('index');
        Route::get('create', [CategoryController::class, 'create'])->name('create');
        Route::post('store', [CategoryController::class, 'store'])->name('store');
        Route::get('del/{id}', [CategoryController::class, 'delete'])->name('delete');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [CategoryController::class, 'update'])->name('update');
    });

    // danh sách người dùng
    Route::prefix('user')->name('user.')->middleware('role.admin')->group(function () {
        Route::get('list', [UserController::class, 'index'])->name('index');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('store', [UserController::class, 'store'])->name('store');
        Route::get('del/{id}', [UserController::class, 'delete'])->name('delete');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [UserController::class, 'update'])->name('update');
    });
    /// danh sách thuộc tính 
    Route::prefix('attribute')->name('att.')->middleware('role.admin')->group(function () {
        Route::get('list/{page?}', [AttributeController::class, 'index'])->name('index');
        Route::get('create', [AttributeController::class, 'create'])->name('create');
        Route::post('store', [AttributeController::class, 'store'])->name('store');
        Route::get('edit-color/{id}', [AttributeController::class, 'editColor'])->name('editColor');
        Route::post('update/{id}', [AttributeController::class, 'update'])->name('update');
        Route::get('edit-size/{id}', [AttributeController::class, 'editSize'])->name('editSize');
        Route::get('del/{id}', [AttributeController::class, 'delColor'])->name('delColor');
        Route::get('del/{id}', [AttributeController::class, 'delSize'])->name('delSize');
    });
    //bill
    Route::prefix('bill')->name('bill.')->group(function () {
        Route::get('list', [BillController::class, 'index'])->name('index');
    });
    // comment
    Route::prefix('comments')->name('comments.')->group(function () {
        Route::get('comment/list', [CommentsController::class, 'index'])->name('index');
        Route::get('/create' , [CommentsController::class, 'store'])->name('store');
    });
});

// route người dùng->middleware('role')
Route::prefix('page')->name('client.')->group(function () {
    Route::get('product/{id_category}', [ClientController::class, 'product'])->name('product');
});
Route::get('/', [ClientController::class, 'home'])->name('home');
Route::get('search/{key?}', [ClientController::class, 'search'])->name('search');
Route::get('category/{id_category?}', [ClientController::class, 'category'])->name('category');
Route::get('category-view', [ClientController::class, 'view'])->name('view');
Route::get('detail-product/{id_product?}', [ClientController::class, 'detailProduct'])->name('detailProduct');
Route::get('cart', [ClientController::class, 'cartProduct'])->name('cart');
Route::get('order', [ClientController::class, 'orderProduct'])->name('order');
Route::post('store-order', [ClientController::class, 'storeOrder'])->name('storeOrder');
Route::get('ordered/{id?}', [ClientController::class, 'orderedProduct'])->name('ordered');
Route::get('bill/{id}', [ClientController::class, 'bill'])->name('bill');


// mail
Route::get('forgot/{token}', [ClientController::class, 'forgotPassword'])->name('forgotPassword');
Route::post('forgot-pw', [ClientController::class, 'forgot'])->name('forgot');
// Route::get('test-email', [ClientController::class, 'testEmail'])->name('testEmail');
//profile user
Route::prefix('profiles')->name('profiles.')->middleware('authen')->group(function () {
    Route::get('profile-infor', [ProfileController::class, 'profile'])->name('profile');
    Route::get('profile-bill', [ProfileController::class, 'profileBill'])->name('profile-bill');
    Route::get('profile-setting', [ProfileController::class, 'profileSetting'])->name('profile-setting');
    Route::post('profile-delete-account/{id}', [ProfileController::class, 'deleteAccount'])->name('profileDeleteAccount');
    Route::get('change-password', [ProfileController::class, 'changePassword'])->name('changePassword');
    Route::post('update-password', [ProfileController::class, 'updatePassword'])->name('updatePassword');
});

// comment


// pay 
Route::get('pay/momo', [PayController::class, 'momo'])->name('paymomo');


// Route::get('testApi', [ClientController::class,'testApi'])->name('api');

// Route::get('', [LoginCotronller::class, 'index'])->name('login.index');
Route::get('signup', [LoginCotronller::class, 'signup'])->name('signup')->middleware('login');
Route::post('register', [LoginCotronller::class, 'register'])->name('register')->middleware('login');
Route::post('login', [LoginCotronller::class, 'login'])->name('login');
Route::get('logout', [LoginCotronller::class, 'logout'])->name('logout');
