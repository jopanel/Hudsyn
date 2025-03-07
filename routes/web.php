<?php

use Illuminate\Support\Facades\Route;
use Jopanel\Hudsyn\Controllers\AuthController;
use Jopanel\Hudsyn\Controllers\DashboardController;
use Jopanel\Hudsyn\Controllers\UserController;
use Jopanel\Hudsyn\Controllers\PageController;
use Jopanel\Hudsyn\Controllers\BlogController;
use Jopanel\Hudsyn\Controllers\PressReleaseController;
use Jopanel\Hudsyn\Controllers\CustomRouteController;
use Jopanel\Hudsyn\Controllers\LayoutController;
use Jopanel\Hudsyn\Controllers\SettingController;
use Jopanel\Hudsyn\Controllers\StaticPublishingController;
use Jopanel\Hudsyn\Controllers\PublicPageController;
use Jopanel\Hudsyn\Controllers\FileUploadController;
use Jopanel\Hudsyn\Middleware\HudsynMiddleware;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;


// -----------------------
// Hudsyn Admin Routes
// -----------------------

Route::group(['prefix' => 'hudsyn', 'middleware' => ['web']], function () {
    // Show login form
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('hudsyn.login');
    
    // Process login form
    Route::post('/', [AuthController::class, 'login'])->name('hudsyn.login.submit');
});


// Fallback for the default "login" route.
Route::get('/login', function(){
    return redirect()->route('hudsyn.login');
})->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected admin routes (all prefixed with /hudsyn)
Route::group(['prefix' => 'hudsyn', 'middleware' => ['web', HudsynMiddleware::class]], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('hudsyn.dashboard');
    Route::resource('users', UserController::class, ['as' => 'hudsyn']);
    Route::resource('pages', PageController::class, ['as' => 'hudsyn']);
    Route::resource('blog', BlogController::class, ['as' => 'hudsyn']);
    Route::resource('press-releases', PressReleaseController::class, ['as' => 'hudsyn']);
    Route::resource('custom-routes', CustomRouteController::class, ['as' => 'hudsyn']);
    Route::resource('layouts', LayoutController::class, ['as' => 'hudsyn']); 
    Route::resource('settings', SettingController::class, ['as' => 'hudsyn']);
    Route::get('files/gallery', [FileUploadController::class, 'gallery'])->name('hudsyn.files.gallery');
    Route::post('files/upload-image', [FileUploadController::class, 'uploadImage'])->name('hudsyn.files.upload-image');
    Route::resource('files', FileUploadController::class, ['as' => 'hudsyn'])->except(['show']);
    Route::get('static-publishing', [StaticPublishingController::class, 'index'])->name('hudsyn.static-publishing');
});

// -----------------------
// Public Page Routes
// -----------------------
Route::get('/', [PublicPageController::class, 'showPage'])->name('hudsyn.public.home');

// Public Blog Post Route: /blog/{slug}
Route::get('/blog/{slug}', [PublicPageController::class, 'showBlogPost'])->name('hudsyn.public.blog');

// Catch-all for normal pages: e.g. /jeeves
Route::get('/{slug}', [PublicPageController::class, 'showPage'])->name('hudsyn.public.page');

// Public Press Release: http://hudsyn/press/{slug}
Route::get('/press/{slug}', [PublicPageController::class, 'showPressRelease'])->name('hudsyn.public.press');


