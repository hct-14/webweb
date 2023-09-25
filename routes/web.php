<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;






Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/trang chu', [HomeController::class, 'index'])->name('trang-chu');


Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/dashboard', [AdminController::class, 'show_dashboard'])->name('admin');
Route::match(['get', 'post'], '/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin');

// Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin');
