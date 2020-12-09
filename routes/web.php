<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\TaskController;

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

/**
 * Task management CRUD and Reordering Routes
 */
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
Route::post('/store', [TaskController::class, 'store'])->name('store');
Route::get('/edit/{id}', [TaskController::class, 'edit'])->name('edit');
Route::post('/update/{id}', [TaskController::class, 'update'])->name('update');
Route::get('/delete/{id}', [TaskController::class, 'destroy'])->name('delete');
Route::get('/reorder', [TaskController::class, 'reOrder'])->name('reorder');


Route::any('/', function () {
    return redirect('/tasks');
});