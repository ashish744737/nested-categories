<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::any('category/create', [CategoryController::class, 'createCategory'])->name('createCategory');
Route::get('/', [CategoryController::class, 'allCategories'])->name('allCategories');
Route::get('category/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
Route::any('category/edit/{id}', [CategoryController::class, 'editCategory'])->name('editCategory');