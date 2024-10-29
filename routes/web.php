<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductAttributeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierController;
use App\Models\ProductAttribute;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('Products',[ProductController::class, 'allProduct'])->name('Products')->middleware(['auth', 'verified']);
Route::post('addProduct', [ProductController::class, 'addProduct'])->name('addProduct')->middleware(['auth', 'verified']);
Route::post('Products/delete/{id}',[ProductController::class, 'deleteProduct'])->name('deleteProduct')->middleware(['auth', 'verified']);
Route::post('Products/update/{id}',[ProductController::class, 'updateProduct'])->name('updateProduct')->middleware(['auth', 'verified']);

Route::get('Products/Categories', [CategoryController::class, 'viewCategories'])->name('Categories')->middleware(['auth', 'verified']);
Route::post('Products/Categories/addCategory', [CategoryController::class, 'addCategory'])->name('addCategory')->middleware(['auth', 'verified']);
Route::post('Products/Categories/editCategory/{id}', [CategoryController::class, 'updateCategory'])->name('updateCategory')->middleware(['auth', 'verified']);
Route::post('Products/Categories/deleteCategory/{id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory')->middleware(['auth', 'verified']);

Route::get('Prodcuts/Attributes',[ProductAttributeController::class, 'viewAttribute'])->name('viewAttribute')->middleware(['auth', 'verified']);
Route::post('Products/Attributes/add', [ProductAttributeController::class, 'addAttribute'])->name('addAttribute')->middleware(['auth', 'verified']);
Route::post('Products/Attributes/update/{id}', [ProductAttributeController::class, 'updateAttribute'])->name('updateAttribute')->middleware(['auth', 'verified']);
Route::post('Products/Attributes/delete/{id}', [ProductAttributeController::class, 'deleteAttribute'])->name('deleteAttribute')->middleware(['auth', 'verified']);

Route::get('Suppliers',[SupplierController::class, 'viewSupplier'])->name('suppliers')->middleware(['auth', 'verified']);
Route::post('Suppliers/add', [SupplierController::class, 'addSupplier'])->name('addSupplier')->middleware(['auth', 'verified']);
Route::post('Suppliers/update/{id}',[SupplierController::class, 'updateSupplier'])->name('updateSupplier')->middleware(['auth', 'verified']);
Route::post('Suppliers/delete/{id}',[SupplierController::class, 'deleteSupplier'])->name('deleteSupplier')->middleware(['auth', 'verified']);
require __DIR__.'/auth.php';
