<?php

use App\Http\Controllers\RequestController;
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

Route::redirect('/', 'requests', 301);

Route::resource('requests', RequestController::class)->only('index' ,'create', 'store');
Route::prefix('requests')->name('requests.')->group(function () {
    Route::get('pay', [RequestController::class, 'pay'])->name('pay');
    Route::post('bulk-approve', [RequestController::class, 'bulkApprove'])->name('bulk_approve');
    Route::post('bulk-reject', [RequestController::class, 'bulkReject'])->name('bulk_reject');
    Route::prefix('{request}')->group(function () {
        Route::get('rejection', [RequestController::class, 'rejection'])->name('rejection');
        Route::post('reject', [RequestController::class, 'reject'])->name('reject');
        Route::get('approve', [RequestController::class, 'approve'])->name('approve');
    });
});

Route::get('media/{media}/download', [RequestController::class, 'download'])->name('media.download');
