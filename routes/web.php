<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// Home
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin'])->name('login.process');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'processRegister'])->name('register.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Email verification routes
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('dashboard')->with('success', 'Email verified!');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('success', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Password reset routes
Route::get('/auth/forgot-password', [PasswordResetController::class, 'showForgotForm'])->name('password.request');
Route::post('/auth/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
Route::get('/auth/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/auth/reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Product routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Checkout routes (auth required)
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.place');
    Route::get('/checkout/confirmation/{id}', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');
});

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/products/create', [AdminController::class, 'productsCreate'])->name('products.create');
    Route::post('/products', [AdminController::class, 'productsStore'])->name('products.store');
    Route::get('/products/{id}/edit', [AdminController::class, 'productsEdit'])->name('products.edit');
    Route::put('/products/{id}', [AdminController::class, 'productsUpdate'])->name('products.update');
    Route::delete('/products/{id}', [AdminController::class, 'productsDestroy'])->name('products.destroy');
    Route::delete('/products/image/{imageId}', [AdminController::class, 'productsDeleteImage'])->name('products.delete-image');

    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::post('/categories', [AdminController::class, 'categoriesStore'])->name('categories.store');
    Route::put('/categories/{id}', [AdminController::class, 'categoriesUpdate'])->name('categories.update');
    Route::delete('/categories/{id}', [AdminController::class, 'categoriesDestroy'])->name('categories.destroy');

    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::put('/users/{id}/toggle-admin', [AdminController::class, 'usersToggleAdmin'])->name('users.toggle-admin');
    Route::delete('/users/{id}', [AdminController::class, 'usersDestroy'])->name('users.destroy');

    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::get('/orders/{id}', [AdminController::class, 'ordersShow'])->name('orders.show');
    Route::put('/orders/{id}/status', [AdminController::class, 'ordersUpdateStatus'])->name('orders.update-status');
    Route::delete('/orders/{id}', [AdminController::class, 'ordersDestroy'])->name('orders.destroy');
});
