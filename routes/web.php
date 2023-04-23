<?php

use App\Http\Controllers\PublicNewsController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('news', PublicNewsController::class)->only(['index', 'show'])->names([
    'index' => 'public.news.index',
    'show' => 'public.news.show',
]);

Auth::routes();

Route::middleware('auth')->prefix('admin')->group(function (){
    Route::resource('news', App\Http\Controllers\NewsController::class)->except([
       'show'
    ])->names([
        'index' => 'admin.news.index',
        'create' => 'admin.news.create',
        'store' => 'admin.news.store',
        'edit' => 'admin.news.edit',
        'update' => 'admin.news.update',
        'destroy' => 'admin.news.destroy',
    ]);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
