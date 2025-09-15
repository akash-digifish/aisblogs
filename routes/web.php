<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactMessageController;

// Login Routes




Route::get('/', function () {
    return 'Hello from the /blogs homepage!';
});
Route::get('/admin/login', [AuthController::class, 'loginIndex'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');

// Logout


Route::get('/akash/{id}', [BlogsController::class, 'showdata'])->name('blog.show');




// Admin Routes (protected by auth and is_admin middleware)
Route::prefix('admin')->middleware(['auth', 'is_admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::put('/blogs/{blog}', [BlogsController::class, 'update'])->name('admin.blogs.update');
   Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
   Route::post('/blogs/{id}/toggle-featured', [BlogsController::class, 'toggleFeatured'])->name('blogs.toggleFeatured');




    Route::resource('/blogs', BlogsController::class); 
    
    Route::get('/users', [BlogsController::class, 'index'])->name('users');
      Route::get('/contacts', [BlogsController::class, 'contacts'])->name('blogs.contacts');
Route::get('/podcasts', [BlogsController::class, 'podcasts'])->name('blogs.podcasts');
    
});
