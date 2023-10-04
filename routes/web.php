<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\ItemEditController;
use App\Http\Controllers\ItemAddController;

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


Route::get('/list', [ItemsController::class, 'list'])->name('item.list');
Route::get('/getSecondCategories', [ItemsController::class, 'getSecondCategories']);
Route::get('/getThirdCategories', [ItemsController::class, 'getThirdCategories']);
Route::get('/list/{id}', [ItemsController::class, 'detail'])->name('item.detail');
Route::get('/edit/{itemId}', [ItemEditController::class, 'edit'])->name('item.edit');

Route::get('/add', [ItemAddController::class, 'add'])->name('item.add');

Route::get('/phpinfo', function () {
    phpinfo();
});