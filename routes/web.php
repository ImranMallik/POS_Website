<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AddToCartController;
use App\Http\Controllers\Backend\AdvanceSalaryController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CoustomerController;
use App\Http\Controllers\Backend\EmployeeAttendanceController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\ExpenseController;
use App\Http\Controllers\Backend\LastMonthSalaryController;
use App\Http\Controllers\Backend\MonthExpenseController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PaySalaryController;
use App\Http\Controllers\Backend\PosController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\YearExpenseController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

require __DIR__ . '/auth.php';

Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');
// After Logout show a Logout Page  with notifications;
Route::get('logout/page', [AdminController::class, 'logoutPage'])->name('admin.logout-page');
Route::middleware('auth')->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::controller(ProfileController::class)->group(function () {
            Route::get('/profile', 'edit')->name('profile.edit');
            Route::patch('/profile', 'update')->name('profile.update');
            Route::delete('/profile', 'destroy')->name('profile.destroy');
        });

        // Admin Profile Routes
        Route::controller(AdminController::class)->group(function () {
            Route::get('logout', 'logout')->name('logout');
            Route::get('profile', 'adminProfile')->name('profile');
            Route::post('profile/store', 'storeAdminProfile')->name('profile-store');
            Route::get('password-change', 'passwordChange')->name('password-change');
            Route::post('password-update', 'passwordUpdate')->name('update.profile');
        });

        // Employee Routes
        Route::controller(EmployeeController::class)->group(function () {
            Route::get('employee-list', 'index')->name('employees.index');
            Route::get('employee-list/create', 'create')->name('employees.create');
            Route::post('employee-list/store', 'store')->name('employees.store');
            Route::get('employee-list/{id}/edit', 'edit')->name('employees.edit');
            Route::put('employee-list/{id}', 'update')->name('employees.update');
            Route::delete('employee-list/{id}', 'destroy')->name('employees.destroy');
        });

        // Coustomer Route
        Route::resource('coustomer', CoustomerController::class);
        // Supplier Route
        Route::get('supplier-details/{id}', [SupplierController::class, 'get_supplier_details'])->name('supplier-details');
        Route::resource('supplier', SupplierController::class);
        // Advance Salary
        Route::resource('advance-salary', AdvanceSalaryController::class);
        // Pay Salary
        Route::post('pay-now', [PaySalaryController::class, 'payNow'])->name('advance-salary.pay');
        Route::resource('pay-salary', PaySalaryController::class);
        Route::get('last-month-pay', [LastMonthSalaryController::class, 'get_last_month_pay'])->name('last-month-pay');

        // Employee Attendance
        Route::post('/attendance/submit', [EmployeeAttendanceController::class, 'attendancesubmit'])->name('attendance.submit');
        Route::get('employee-attendance-list', [EmployeeAttendanceController::class, 'listAllAttendance'])->name('employee-attendance-list');
        Route::resource('employee-attendance', EmployeeAttendanceController::class);

        // Category-------
        Route::resource('category', CategoryController::class);

        // Product-----
        Route::get('product-bar-code/{id}', [ProductController::class, 'productBarCode'])->name('product-bar-code');
        Route::get('product-imported', [ProductController::class, 'productimported'])->name('product-imported');
        // Product Export--------
        Route::get('product-export', [ProductController::class, 'productExport'])->name('product-export');
        // Product import Data--------
        Route::post('product-import-data', [ProductController::class, 'productImportData'])->name('product-import-data');
        Route::resource('product', ProductController::class);
        // Month Expense Data--------
        Route::get('month-expense', [MonthExpenseController::class, 'monthExpense'])->name('month-expense');
        Route::get('year-expense', [YearExpenseController::class, 'yearExpense'])->name('year-expense');
        // Expense Data--------
        Route::resource('expense', ExpenseController::class);
        // Pos Route
        Route::resource('pos', PosController::class);
        // Add to cart
        Route::post('cart', [AddToCartController::class, 'addToCart'])->name('addToCart');
        Route::get('show-cart-items', [AddToCartController::class, 'showCart'])->name('showCart');
        Route::post('/update-cart', [AddToCartController::class, 'updateCart'])->name('update.cart');
        Route::post('/delete-cart', [AddToCartController::class, 'deleteCart'])->name('delete.cart');
        Route::post('/invoice-cart', [AddToCartController::class, 'invoice'])->name('invoice.cart');
        Route::post('/final-invoice', [AddToCartController::class, 'finalInvoice'])->name('final.invoice');
        // Order Route
        Route::get('order-pending', [OrderController::class, 'orderPending'])->name('orderPending');
        Route::get('order-details/{id}', [OrderController::class, 'orderDetails'])->name('orderDetails');
        Route::post('order-customer-stored', [OrderController::class, 'order'])->name('orderCustomerStored');
        Route::put('order-change-status', [OrderController::class, 'changeStatus'])->name('order-change-status');
    });
});
