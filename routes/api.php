<?php

use App\Http\Controllers\AjaxController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('ajax-detail-product',[AjaxController::class,'quanityForColorAndSize'])->name('ajaxDetailProduct');
Route::get('ajax-districts',[AjaxController::class,'findDistrictsForProvince'])->name('ajaxDistricts');
Route::get('ajax-wards',[AjaxController::class,'findWardsForDistrict'])->name('ajaxWards');
Route::get('ajax-product-limit',[AjaxController::class,'allProductOffset'])->name('ajaxProductOffset');
Route::get('ajax-product-filter',[AjaxController::class,'productFilter'])->name('ajaxProductFilter');

// Route::get('test',[AjaxController::class,'testController'])->name('test');