<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\ItemEditController;
use App\Http\Controllers\ItemAddController;
use App\Http\Controllers\CategoryController;

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
Route::get('/getSecondCategories', [CategoryController::class, 'getSecondCategories']);
Route::get('/getThirdCategories', [CategoryController::class, 'getThirdCategories']);
Route::get('/detail/{id}', [ItemsController::class, 'detail'])->name('item.detail');
Route::get('/edit/{id}', [ItemEditController::class, 'edit'])->name('item.edit');
Route::post('update/{id}', [ItemEditController::class, 'update'])->name('item.update');
Route::delete('/items/{id}', [ItemEditController::class, 'destroy'])->name('item.delete');

Route::get('/add', [ItemAddController::class, 'add'])->name('item.add');
Route::post('/create', [ItemAddController::class, 'create'])->name('item.create');

Route::get('/phpinfo', function () {
    phpinfo();
});