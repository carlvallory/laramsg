<?php

use App\Http\Controllers\MainController;
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

Route::get('/msg/id/{id}/body/{body}', [MainController::class, 'store']);
Route::get('/msg/qr/{qr}', [MainController::class, 'qr']);

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard',    [MainController::class, 'index']);
    Route::get('/dashboard/qr', [MainController::class, 'create']);
});