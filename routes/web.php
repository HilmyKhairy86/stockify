<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImportControlller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductAttributeController;
use App\Http\Controllers\StockTransactionController;

Route::get('/testing', [TestingController::class, 'index']);
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('auth.login');
});

Route::middleware('auth', 'verified', 'role:admin')->group(function () {
    Route::get('/', function () {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.login');
    });
    Route::get('Admin/Dashboard',[DashboardController::class, 'admindash'])->name('admin.dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/Admin/Products',[ProductController::class, 'allProduct'])->name('Products');
    Route::post('/Admin/Products/addproduct', [ProductController::class, 'addProduct'])->name('admin.addProduct');
    Route::post('/Admin/Products/delete/{id}',[ProductController::class, 'deleteProduct'])->name('admin.deleteProduct');
    Route::post('/Admin/Products/update/{id}',[ProductController::class, 'updateProduct'])->name('admin.updateProduct');
    Route::get('/Admin/Products/search', [ProductController::class, 'searchProduct'])->name('searchProduct');
    Route::post('/Admin/Products/import',[ImportControlller::class, 'import'])->name('import');
    Route::post('/Admin/Products/export',[ImportControlller::class, 'export'])->name('export');
    Route::post('/Admin/Products/exportxls',[ImportControlller::class, 'exportxls'])->name('exportxls');
    
    
    Route::get('/Admin/Products/Categories', [CategoryController::class, 'viewCategories'])->name('Categories');
    Route::post('/Admin/Products/Categories/addCategory', [CategoryController::class, 'addCategory'])->name('addCategory');
    Route::post('/Admin/Products/Categories/editCategory/{id}', [CategoryController::class, 'updateCategory'])->name('updateCategory');
    Route::post('/Admin/Products/Categories/deleteCategory/{id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
    
    Route::get('/Admin/Products/Attributes',[ProductAttributeController::class, 'viewAttribute'])->name('viewAttribute');
    Route::post('/Admin/Products/Attributes/add', [ProductAttributeController::class, 'addAttribute'])->name('addAttribute');
    Route::post('Products/Attributes/update/{id}', [ProductAttributeController::class, 'updateAttribute'])->name('updateAttribute');
    Route::post('/Admin/Products/Attributes/delete/{id}', [ProductAttributeController::class, 'deleteAttribute']);
    
    Route::get('/Admin/Suppliers',[SupplierController::class, 'viewSupplier'])->name('suppliers');
    Route::post('/Admin/Suppliers/add', [SupplierController::class, 'addSupplier'])->name('addSupplier');
    Route::post('/Admin/Suppliers/update/{id}',[SupplierController::class, 'updateSupplier'])->name('updateSupplier');
    Route::post('/Admin/Suppliers/delete/{id}',[SupplierController::class, 'deleteSupplier'])->name('deleteSupplier');
    
    Route::get('/Admin/Users/Management', [UserController::class, 'viewUsers'])->name('viewUsers');
    Route::post('/Admin/Users/Management/update/{id}',[UserController::class, 'updateUser'])->name('updateUser');
    Route::post('/Admin/Users/Management/delete/{id}',[UserController::class, 'deleteUser'])->name('deleteUser');
    
    
    Route::get('/Admin/Stock/History',function(){
        return view('Stock.History');
    })->name('admin.sHistory');
    
    Route::post('/Admin/Stock/History/create',[StockTransactionController::class, 'addTransaction'])->name('addTransaction');
    Route::post('/Admin/Stock/History/delete/{id}',[StockTransactionController::class, 'deleteTransaction'])->name('deleteTransaction');

});

// Route::middleware('auth', 'role:admin,manajer_gudang')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
//     Route::get('/Admin/Products',[ProductController::class, 'allProduct'])->name('Products')->middleware(['auth', 'verified']);
//     Route::post('/Admin/Products/addproduct', [ProductController::class, 'addProduct'])->name('addProduct')->middleware(['auth', 'verified']);
//     Route::post('/Admin/Products/delete/{id}',[ProductController::class, 'deleteProduct'])->name('deleteProduct')->middleware(['auth', 'verified']);
//     Route::post('/Admin/Products/update/{id}',[ProductController::class, 'updateProduct'])->name('updateProduct')->middleware(['auth', 'verified']);
//     Route::get('/Admin/Products/search', [ProductController::class, 'searchProduct'])->name('searchProduct')->middleware(['auth', 'verified']);
//     Route::post('/Admin/Products/import',[ImportControlller::class, 'import'])->name('import')->middleware(['auth', 'verified']);
//     Route::post('/Admin/Products/export',[ImportControlller::class, 'export'])->name('export')->middleware(['auth', 'verified']);
//     Route::post('/Admin/Products/exportxls',[ImportControlller::class, 'exportxls'])->name('exportxls')->middleware(['auth', 'verified']);
    
    
//     Route::get('/Admin/Products/Categories', [CategoryController::class, 'viewCategories'])->name('Categories')->middleware(['auth', 'verified']);
//     Route::post('/Admin/Products/Categories/addCategory', [CategoryController::class, 'addCategory'])->name('addCategory')->middleware(['auth', 'verified']);
//     Route::post('Products/Categories/editCategory/{id}', [CategoryController::class, 'updateCategory'])->name('updateCategory')->middleware(['auth', 'verified']);
//     Route::post('Products/Categories/deleteCategory/{id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory')->middleware(['auth', 'verified']);
    
//     Route::get('Products/Attributes',[ProductAttributeController::class, 'viewAttribute'])->name('viewAttribute')->middleware(['auth', 'verified']);
//     Route::post('Products/Attributes/add', [ProductAttributeController::class, 'addAttribute'])->name('addAttribute')->middleware(['auth', 'verified']);
//     Route::post('Products/Attributes/update/{id}', [ProductAttributeController::class, 'updateAttribute'])->name('updateAttribute')->middleware(['auth', 'verified']);
//     Route::post('Products/Attributes/delete/{id}', [ProductAttributeController::class, 'deleteAttribute'])->name('deleteAttribute')->middleware(['auth', 'verified']);
    
//     Route::get('Suppliers',[SupplierController::class, 'viewSupplier'])->name('suppliers')->middleware(['auth', 'verified']);
//     Route::post('Suppliers/add', [SupplierController::class, 'addSupplier'])->name('addSupplier')->middleware(['auth', 'verified']);
//     Route::post('Suppliers/update/{id}',[SupplierController::class, 'updateSupplier'])->name('updateSupplier')->middleware(['auth', 'verified']);
//     Route::post('Suppliers/delete/{id}',[SupplierController::class, 'deleteSupplier'])->name('deleteSupplier')->middleware(['auth', 'verified']);
    
//     Route::get('Users/Management', [UserController::class, 'viewUsers'])->name('viewUsers')->middleware(['auth', 'verified']);
//     Route::post('Users/Management/update/{id}',[UserController::class, 'updateUser'])->name('updateUser')->middleware(['auth', 'verified']);
//     Route::post('Users/Management/delete/{id}',[UserController::class, 'deleteUser'])->name('deleteUser')->middleware(['auth', 'verified']);
    
    
//     Route::get('Stock/History',function(){
//         return view('Stock.History');
//     })->name('sHistory')->middleware(['auth', 'role:admin,staff_gudang']);
    
//     Route::post('Stock/History/create',[StockTransactionController::class, 'addTransaction'])->name('addTransaction')->middleware(['auth', 'verified']);
//     Route::post('Stock/History/delete/{id}',[StockTransactionController::class, 'deleteTransaction'])->name('deleteTransaction')->middleware(['auth', 'verified']);

// });
Route::middleware('auth', 'verified', 'role:manajer_gudang')->group(function (){
    Route::get('Manager/Dashboard',[DashboardController::class, 'managerdash'])->name('manager.dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/Manager/Products',[ProductController::class, 'allProduct'])->name('manager.Products');
    Route::post('/Manager/Products/addproduct', [ProductController::class, 'addProduct'])->name('manager.addProduct');
    Route::post('/Manager/Products/delete/{id}',[ProductController::class, 'deleteProduct'])->name('manager.deleteProduct');
    Route::post('/Manager/Products/update/{id}',[ProductController::class, 'updateProduct'])->name('manager.updateProduct');
    Route::get('/Manager/Products/search', [ProductController::class, 'searchProduct'])->name('manager.searchProduct');
    Route::post('/Manager/Products/import',[ImportControlller::class, 'import'])->name('manager.import');
    Route::post('/Manager/Products/export',[ImportControlller::class, 'export'])->name('manager.export');
    Route::post('/Manager/Products/exportxls',[ImportControlller::class, 'exportxls'])->name('manager.exportxls');
    
    
    Route::get('/Manager/Products/Categories', [CategoryController::class, 'viewCategories'])->name('manager.Categories');
    Route::post('/Manager/Products/Categories/addCategory', [CategoryController::class, 'addCategory'])->name('manager.addCategory');
    Route::post('/Manager/Products/Categories/editCategory/{id}', [CategoryController::class, 'updateCategory'])->name('manager.updateCategory');
    Route::post('/Manager/Products/Categories/deleteCategory/{id}', [CategoryController::class, 'deleteCategory'])->name('manager.deleteCategory');
    
    Route::get('/Manager/Products/Attributes',[ProductAttributeController::class, 'viewAttribute'])->name('manager.viewAttribute');
    Route::post('/Manager/Products/Attributes/add', [ProductAttributeController::class, 'addAttribute'])->name('manager.addAttribute');
    Route::post('Products/Attributes/update/{id}', [ProductAttributeController::class, 'updateAttribute'])->name('manager.updateAttribute');
    Route::post('/Manager/Products/Attributes/delete/{id}', [ProductAttributeController::class, 'deleteAttribute'])->name('manager.deleteAttribute');
    
    Route::get('/Manager/Suppliers',[SupplierController::class, 'viewSupplier'])->name('manager.suppliers');

    Route::get('/Manager/Stock/Transaction',function(){
        return view('Stock.History');
    })->name('manager.transaction');
    
    Route::post('/Manager/Stock/History/create',[StockTransactionController::class, 'addTransaction'])->name('manager.addTransaction');
    Route::post('/Manager/Stock/History/delete/{id}',[StockTransactionController::class, 'deleteTransaction'])->name('manager.deleteTransaction');
});


Route::middleware('auth', 'verified', 'role:staff_gudang')->group(function (){
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/Manager/Stock/History',function(){
        return view('Stock.History');
    })->name('staff.sHistory');
});


require __DIR__.'/auth.php';
