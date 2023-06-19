<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MaintenanceController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Resources\Admin\Maintenance\MaintenanceResource;
use Illuminate\Support\Facades\Route;

Route::get('category/get-active-category',[CategoryController::class,'getActiveCategory']);
Route::get('category/change-status/{category}',[CategoryController::class , 'changeStatus']);
Route::resource('category', CategoryController::class);

Route::resource('product',ProductController::class);
Route::get('product/change-status/{product}',[ProductController::class , 'changeStatus']);


Route::get('order',[OrderController::class , 'index']);
Route::get('order/{order}',[OrderController::class , 'show']);

Route::post('maintenance/add-price/{maintenanace}',[MaintenanceResource::class ,'addPrice']);
Route::resource('maintenance',MaintenanceController::class)->only('index','update','show','destroy');
// Route::post('maintenance/addPrice/{Maintenance}',[MaintenanceC])
