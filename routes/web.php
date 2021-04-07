<?php

use App\Http\Controllers\PackageController;
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


Route::get('/',[PackageController::class,'index'])->middleware(['auth.shopify'])->name('home');
Route::get('/getPackages',[PackageController::class,'create'])->middleware(['auth.shopify'])->name('home');
Route::get('/edit-packages/{id}',[PackageController::class,'index'])->middleware(['auth.shopify'])->name('editpackage');
Route::post('/add_package',[PackageController::class,'store'])->middleware(['auth.shopify'])->name('AddPackage');
Route::post('/update/{id}',[PackageController::class,'update'])->middleware(['auth.shopify'])->name('update.package');
Route::get('/delete/{id}',[PackageController::class,'destroy'])->name('delete');
