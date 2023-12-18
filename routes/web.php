<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;

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

Route::get('/home', [BlogController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// blog routes
// Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');


Route::get('blogs/user',[BlogController::class, 'indexUser'])->name('blogs.user');
Route::resource('blogs', BlogController::class);


//categories
Route::resource('blogs/categories', CategoryController::class);

//category ajax
Route::get('/blogs/filter-by-category/{categoryId}', [BlogController::class, 'filterByCategory']);


require __DIR__.'/auth.php';
