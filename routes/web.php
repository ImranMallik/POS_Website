<?php

use App\Http\Controllers\AdminController;
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
    });
});
