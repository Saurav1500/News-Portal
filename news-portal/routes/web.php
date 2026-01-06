<?php

use App\Http\Controllers\Admin\{ArticleController as AdminArticel, CategoryController as AdminCategory, TagController as AdminTag , SourceController as AdminSource};
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','role:admin,editor,author'])->prefix('admin')->name('admin.')->group(function(){
    Route::resource('articles',AdminArticel::class);
    Route::resource('categories',AdminCategory::class)->middleware('role:admin,editor');
    Route::resource('tags',AdminTag::class)->middleware('role:admin,editor');
    Route::resource('sources',AdminSource::class)->middleware('role:admin');
});



require __DIR__.'/auth.php';

