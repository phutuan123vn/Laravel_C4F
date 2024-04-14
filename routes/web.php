<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('dashboard')->name('dashboard.')->group(function(){
    Route::get('/',[DashboardController::class,'index'])->name('home');
    Route::get('/trash',[DashboardController::class,'trash'])->name('trash');

    Route::patch('/restore/{id?}',[DashboardController::class,'restore'])->name('restore');
    Route::delete('/delete',[DashboardController::class,'delete'])->name('delete');
});

Route::prefix('blog')->name('blog.')->middleware('auth')->group(function () {
    // Route GET
    Route::get('/', [BlogController::class,'index'])->name('home');
    Route::get('/create', [BlogController::class,'create'])->name('create');
    Route::get('/me',[BlogController::class,'me'])->name('me');
    Route::get('/{slug}', [BlogController::class,'show'])->name('show');

    // Route POST
    Route::post('/store/{slug?}', [BlogController::class,'store'])->name('store');

    // Route PUT
    Route::put('/store/{slug}', [BlogController::class,'update'])->name('update');

    // Route DELETE
    Route::delete('/{id}/delete', [BlogController::class,'delete'])->name('delete');

    // Route PATCH
});

