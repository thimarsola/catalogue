<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AutomakerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\GeneratorController;
use Illuminate\Support\Facades\Route;

Route::name('admin.')->group(function (){
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('/montadoras', AutomakerController::class)->names([
        'index' => 'automakers.index',
        'create' => 'automakers.create',
        'store' => 'automakers.store',
        'edit' => 'automakers.edit',
        'update' => 'automakers.update',
        'destroy' => 'automakers.destroy',
    ]);
    Route::resource('/categorias', CategoryController::class)->names([
        'index' => 'categories.index',
        'create' => 'categories.create',
        'store' => 'categories.store',
        'edit' => 'categories.edit',
        'update' => 'categories.update',
        'destroy' => 'categories.destroy',
    ]);
    Route::resource('/produtos', ProductController::class)->names([
        'index' => 'products.index',
        'create' => 'products.create',
        'store' => 'products.store',
        'edit' => 'products.edit',
        'update' => 'products.update',
        'destroy' => 'products.destroy',
    ]);
    Route::resource('/carros', CarController::class)->names([
        'index' => 'cars.index',
        'create' => 'cars.create',
        'store' => 'cars.store',
        'edit' => 'cars.edit',
        'update' => 'cars.update',
        'destroy' => 'cars.destroy',
    ]);
});

Route::get('/catalogo', [GeneratorController::class, 'show'])->name('catalogo');
