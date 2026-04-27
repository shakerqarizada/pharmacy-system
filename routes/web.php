<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');


Route::controller(UserController::class)->group(function () {

    // User Controller
    Route::get('/dashboard', 'UserIndex')->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/add-user', 'AddUser')->middleware(['auth', 'verified'])->name('add-user');
    Route::get('/view-users', 'ViewUser')->name('view-users');
    Route::post('/store-users', 'storeUser')->name('users.store');
    Route::get('/update-user/{id}', 'editUser')->name('user.edit');
    Route::post('/edit-user/{id}',  'updateUser')->name('user.update');
    Route::get('/delete-user/{id}', 'deleteUser')->name('user.delete');


    // Categories
    Route::get('/add-category', 'AddCategory')->middleware(['auth', 'verified'])->name('add-category');
    Route::get('/view-categories', 'ViewCategory')->name('view-categories');
    Route::post('/store-categories',  'storeCategory')->name('categories.store');
    Route::get('/update-categories/{id}', 'editCategory')->name('categories.edit');
    Route::post('/edit-categories/{id}',  'updateCategory')->name('categories.update');
    Route::get('/delete-categories/{id}', 'deleteCategory')->name('categories.delete');

    // Suppliers
    Route::get('/add-supplier', 'AddSupplier')->middleware(['auth', 'verified'])->name('add-supplier');
    Route::get('/view-suppliers', 'ViewSupplier')->name('view-suppliers');
    Route::post('/store-suppliers',  'storeSupplier')->name('suppliers.store');
    Route::get('/update-suppliers/{id}', 'editSupplier')->name('suppliers.edit');
    Route::post('/edit-suppliers/{id}',  'updateSupplier')->name('suppliers.update');
    Route::get('/delete-suppliers/{id}', 'deleteSupplier')->name('suppliers.delete');
});

// Medicines
Route::controller(MedicineController::class)->group(function () {


    Route::get('/add-medicine', 'AddMedicine')->middleware(['auth', 'verified'])->name('add-medicine');
    Route::post('/store-medicines',  'storeMedicine')->name('medicines.store');
    Route::get('/view-medicines', 'ViewMedicine')->name('view-medicines');
    Route::get('/update-medicines/{id}', 'editMedicine')->name('medicines.edit');
    Route::post('/edit-medicines/{id}',  'updateMedicine')->name('medicines.update');
    Route::get('/delete-medicines/{id}', 'deleteMedicine')->name('medicines.delete');
});

// Customers
Route::controller(CustomerController::class)->group(function () {

    Route::get('/add-customer', 'AddCustomer')->middleware(['auth', 'verified'])->name('add-customer');
    Route::post('/store-customers',  'storeCustomer')->name('customers.store');
    Route::get('/view-customers', 'ViewCustomer')->name('view-customers');
    Route::get('/update-customers/{id}', 'editCustomer')->name('customer.edit');
    Route::post('/edit-customers/{id}',  'updateCustomer')->name('customer.update');
    Route::get('/delete-customers/{id}', 'deleteCustomer')->name('customer.delete');
});

// Sales
Route::controller(SalesController::class)->group(function () {

    Route::get('/add-sales', 'AddSales')->middleware(['auth', 'verified'])->name('add-sales');
    Route::post('/store-sales',  'storeSales')->name('sales.store');
    Route::get('/view-sales', 'ViewSales')->name('view-sales');
    Route::get('/update-sales/{id}', 'editSales')->name('sales.edit');
    Route::post('/edit-sales/{id}',  'updateSales')->name('sales.update');
    Route::get('/delete-sales/{id}', 'deleteSales')->name('sales.delete');
});

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
