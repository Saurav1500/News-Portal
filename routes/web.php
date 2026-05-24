<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CrawlSourceController;
use App\Http\Controllers\CrawlController;

Route::get('/language/{locale}', function (string $locale) {
    if (! in_array($locale, ['en', 'ne'], true)) {
        abort(404);
    }
    session(['locale' => $locale]);
    return back();
})->name('language.switch');

Route::match(['get', 'post'], '/login', [UserAuthController::class, 'login'])->name('login');
Route::get('/forgot-password', [UserAuthController::class, 'forgot_password'])->name('forgot-password');
Route::match(['get', 'post'], '/register', [UserAuthController::class, 'register'])->name('register');
Route::get('logout', [UserAuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [NewsController::class, 'index'])->name('dashboard');
    Route::redirect('/dashboard/upload-news', '/dashboard/news/create');

    Route::get('/dashboard/news', [NewsController::class, 'list'])->name('dashboard.news.list');
    Route::get('/dashboard/news/create', [NewsController::class, 'create'])->name('dashboard.news.create');
    Route::post('/dashboard/news', [NewsController::class, 'store'])->name('dashboard.news.store');
    Route::get('/dashboard/news/{id}/edit', [NewsController::class, 'edit'])->name('dashboard.news.edit');
    Route::put('/dashboard/news/{id}', [NewsController::class, 'update'])->name('dashboard.news.update');
    Route::delete('/dashboard/news/{id}', [NewsController::class, 'destroy'])->name('dashboard.news.destroy');
    Route::patch('/dashboard/news/{id}/toggle-draft', [NewsController::class, 'toggleDraft'])->name('dashboard.news.toggle-draft');
    Route::patch('/dashboard/news/{id}/publish', [NewsController::class, 'publish'])->name('dashboard.news.publish');

    Route::resource('/dashboard/categories', CategoryController::class)
        ->names('dashboard.categories')
        ->except(['show']);
    Route::resource('/dashboard/tags', TagController::class)
        ->names('dashboard.tags')
        ->except(['create', 'show', 'edit']);

    Route::middleware('permission:sources.manage')->group(function () {
        Route::resource('/dashboard/crawl-sources', CrawlSourceController::class)
            ->names('dashboard.crawl-sources')
            ->except(['show']);
        Route::post('/dashboard/crawl/run', [CrawlController::class, 'run'])->name('dashboard.crawl.run');
    });

    Route::middleware('permission:users.manage')->group(function () {
        Route::resource('/dashboard/users', UserController::class)
            ->names('dashboard.users')
            ->except(['show']);
    });

    Route::middleware('permission:roles.manage')->group(function () {
        Route::resource('/dashboard/roles', RoleController::class)
            ->names('dashboard.roles')
            ->except(['show']);
    });
});

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/news', [PageController::class, 'index'])->name('news');
Route::get('/category/{slug}', [PageController::class, 'category'])->name('category.show');
Route::get('/news/{slug}', [PageController::class, 'show'])->name('news.show');
Route::get('/business', [PageController::class, 'business'])->name('business');
Route::get('/life-style', [PageController::class, 'life_style'])->name('life-style');
Route::get('/entertainment', [PageController::class, 'entertainment'])->name('entertainment');
Route::get('/opinion', [PageController::class, 'opinion'])->name('opinion');
Route::get('/technology', [PageController::class, 'technology'])->name('technology');
Route::get('/sports', [PageController::class, 'sports'])->name('sports');
Route::get("/upload", [PageController::class, 'upload'])->name('upload');
