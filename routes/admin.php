<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin-login',[App\Http\Controllers\Auth\LoginController::class,'adminlogin'])->name('admin.login');
// Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin.home')->middleware('is_admin');

Route::Group(['namespace'=>'App\Http\Controllers\Admin','middleware' => 'is_admin'],function(){
    Route::get('/admin/home', [AdminController::class,'admin'])->name('admin.home');
    Route::get('/admin/logout', [AdminController::class,'logout'])->name('admin.logout');
    /*
    |--------------------------------------------------------------------------
    |Category routes
    |--------------------------------------------------------------------------
    */
    Route::Group(['prefix'=>'category'],function(){
        
        Route::get('/', [CategoryController::class,'index'])->name('category.index');
        Route::post('/store', [CategoryController::class,'store'])->name('category.store');
        Route::get('/delete/{id}', [CategoryController::class,'destroy'])->name('category.delete');
        Route::get('/edit/{id}', [CategoryController::class,'edit']);
        Route::post('/update', [CategoryController::class,'update'])->name('category.update');
    });
    /*
    |--------------------------------------------------------------------------
    |Sub Category routes
    |--------------------------------------------------------------------------
    */
    Route::Group(['prefix'=>'subcategory'],function(){
        
        Route::get('/', [SubCategoryController::class,'index'])->name('subcategory.index');
        Route::post('/store', [SubCategoryController::class,'store'])->name('subcategory.store');
        Route::get('/delete/{id}', [SubCategoryController::class,'destroy'])->name('subcategory.delete');
        Route::get('/edit/{id}', [SubCategoryController::class,'edit']);
        // Route::post('/update', [CategoryController::class,'update'])->name('category.update');
    });

     /*
    |--------------------------------------------------------------------------
    |Child Category routes
    |--------------------------------------------------------------------------
    */
    Route::Group(['prefix'=>'childcategory'],function(){
        
        Route::get('/', [ChildCategoryController::class,'index'])->name('childcategory.index');
        // Route::post('/store', [SubCategoryController::class,'store'])->name('subcategory.store');
        // Route::get('/delete/{id}', [SubCategoryController::class,'destroy'])->name('subcategory.delete');
        // Route::get('/edit/{id}', [SubCategoryController::class,'edit']);
        // Route::post('/update', [CategoryController::class,'update'])->name('category.update');
    });
});