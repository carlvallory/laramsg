<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\MsgController;
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

Route::get('/msg/id/{id}/from/{from}/to/{to}/body/{body}/author/{author?}', [MainController::class, 'store']);
Route::get('/msg/qr/{qr}', [MainController::class, 'qr']);

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard',    [MainController::class, 'index']);
    Route::get('/dashboard/qr', [MainController::class, 'create']);
    Route::get('/dashboard/wa', [MainController::class, 'show']);

    Route::get('/dashboard/msgs',          [MsgController::class, 'index'])->name('msgs.index');
    Route::post('/dashboard/msgs',         [MsgController::class, 'store'])->name('msgs.store');
    Route::get('/dashboard/msgs/create',   [MsgController::class, 'create'])->name('msgs.create');
    Route::get('/dashboard/msgs/{id}',     [MsgController::class, 'show'])->name('msgs.show');
    Route::put('/dashboard/msgs/{id}',     [MsgController::class, 'update'])->name('msgs.update');
    Route::delete('/dashboard/msgs/{id}',  [MsgController::class, 'destroy'])->name('msgs.destroy');
    Route::get('/dashboard/msgs/{id}/edit',[MsgController::class, 'edit'])->name('msgs.edit');
});