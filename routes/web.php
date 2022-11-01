<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;

// Product routes
Route::get('/', [ProductController::class, 'index']);
Route::get('/products/create', [ProductController::class, 'create']);
Route::post('/products',[ProductController::class,'store']);
Route::get('/products/delete/{id}',[ProductController::class,'destroy']);
Route::put('/products/update/{id}', [ProductController::class, 'update']);
Route::get('/products/edit/{id}', [ProductController::class, 'edit']);
Route::get('/products/details/{id}',[ProductController::class,'detail']);


// Category routes
Route::get('/category/create',[CategoryController::class,'createcategory']);
Route::post('/category/store', [CategoryController::class, 'storecategory']);
Route::get('/category',[CategoryController::class,'categoryindex']);

// Sub Category routes
// Route::get('/subcategory',[CategoryController::class,'subcategoryindex']);
Route::get('/subcategory/create',[CategoryController::class,'createsubcategory']);
Route::post('/subcategory/store',[CategoryController::class,'storesubcategory']);


// Child Category routes
Route::get('/childcategory/create',[CategoryController::class,'createchildcategory']);
Route::post('/childcategory/store',[CategoryController::class,'storechildcategory']);

// Fetch categories
Route::post('/getsubcat',[CategoryController::class,'getsubcat']);
Route::post('/getchildcat',[CategoryController::class,'getchildcat']);

// Edit gallery image
Route::get('/products/editgallery/{id}',[ImageController::class,'editgalleryimage']);
Route::put('/products/updategallery/{id}',[ImageController::class,'updategalleryimage']);
Route::get('/products/deletegallery/{id}',[ImageController::class,'deletegalleryimage']);