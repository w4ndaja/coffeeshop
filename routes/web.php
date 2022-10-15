<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuCategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ShowcaseController;
use App\Http\Controllers\User\AuthController as UserAuthController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\WelcomeController;
use App\Http\Controllers\UserController;
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

Route::get('', function () {
    return redirect()->route('user.welcome');
})->name('welcome');

Route::middleware('guest')->name('auth.')->group(function () {
    Route::get('login', [AuthController::class, 'index'])->name('index');
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('menus', function () {
        return view('admin.pages.login');
    })->name('menus.index');
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('menu-categories', MenuCategoryController::class);
    Route::resource('menus', MenuController::class);
    Route::resource('users', UserController::class);
    Route::resource('settings', SettingController::class);
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest:user')->group(function () {
    Route::get('user/login', [UserAuthController::class, 'index'])->name('user.login');
    Route::post('user/login', [UserAuthController::class, 'store'])->name('user.authenticate');
    Route::get('user/register', [UserAuthController::class, 'register'])->name('user.register');
    Route::post('user/register', [UserAuthController::class, 'registerStore'])->name('user.register.store');
});

Route::middleware('auth:user')->name('user.')->group(function () {
    Route::get('my-orders', function () {
        return 'asd';
    })->name('myOrders.index');
    Route::post('user/logout', [UserAuthController::class, 'logout'])->name('logout');
    Route::post('checkout', function () {
    })->name('checkout');
    Route::prefix('my-profile')->name('myProfile.')->group(function () {
        Route::get('', [ProfileController::class, 'index'])->name('index');
    });
});

Route::name('user.')->group(function () {
    Route::get('', [WelcomeController::class, '__invoke'])->name('welcome');
    Route::prefix('showcase')->name('showcase.')->group(function () {
        Route::get('', [ShowcaseController::class, 'index'])->name('index');
    });
});
