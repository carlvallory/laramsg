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

Route::redirect('/', 'admin/dashboard/wa');

Route::get('/msg/id/{id}/from/{from}/to/{to}/body/{body}/name/{name?}/profilepicture/{image?}/author/{author?}', [MainController::class, 'store']);
Route::get('/msg/id/{id}/from/{from}/to/{to}/body/{body}/name/{name?}/profilepicture/{image?}', [MainController::class, 'store']);
Route::get('/msg/id/{id}/from/{from}/to/{to}/body/{body}/name/{name?}/author/{author?}', [MainController::class, 'store']);
Route::get('/msg/id/{id}/from/{from}/to/{to}/body/{body}/author/{author?}', [MainController::class, 'store']);
Route::get('/msg/qr/{qr}', [MainController::class, 'qr']);
Route::get('/msg/login/{user}', [MainController::class, 'login']);
Route::get('/msg/logout/{user}', [MainController::class, 'logout']);
Route::get('/msg/schedules/{id}', [MainController::class, 'schedules']);



Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard',                [MainController::class, 'index'])->name('wa.app');
    Route::get('/dashboard/qr',             [MainController::class, 'create'])->name('wa.qr');
    Route::get('/dashboard/wa/{id?}',       [MainController::class, 'show'])->name('wa.frontend');

    Route::get('/dashboard/msgs',           [MsgController::class, 'index'])->name('msgs.index');
    Route::post('/dashboard/msgs',          [MsgController::class, 'store'])->name('msgs.store');
    Route::get('/dashboard/msgs/create',    [MsgController::class, 'create'])->name('msgs.create');
    Route::get('/dashboard/msgs/{id}',      [MsgController::class, 'show'])->name('msgs.show');
    Route::put('/dashboard/msgs/{id}',      [MsgController::class, 'update'])->name('msgs.update');
    Route::delete('/dashboard/msgs/{id}',   [MsgController::class, 'destroy'])->name('msgs.destroy');
    Route::get('/dashboard/msgs/{id}/edit', [MsgController::class, 'edit'])->name('msgs.edit');

    Route::get('/dashboard/chat/{id?}',         [MsgController::class, 'chat'])->name('msgs.chat');
    Route::get('/dashboard/load/chat/{id}',     [MsgController::class, 'loadChat'])->name('msgs.load.chat');
    Route::delete('/dashboard/restore/{id}',    [MsgController::class, 'restore'])->name('msgs.restore');
    Route::delete('/dashboard/delete/{id}',     [MsgController::class, 'delete'])->name('msgs.delete');
});