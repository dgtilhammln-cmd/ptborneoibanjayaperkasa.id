<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\HomeContentController;
use App\Http\Controllers\Admin\PageContentController;
use App\Http\Controllers\Admin\FaqController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('blog', BlogController::class);
    Route::resource('products', ProductController::class);
    Route::resource('product-categories', ProductCategoryController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('users', UserController::class);
    Route::resource('pages', PageController::class);
    Route::resource('faqs', FaqController::class);
    
    // Leads Tracking
    Route::get('leads', [\App\Http\Controllers\Admin\LeadController::class, 'index'])->name('leads.index');
    Route::patch('leads/{lead}/status', [\App\Http\Controllers\Admin\LeadController::class, 'updateStatus'])->name('leads.update_status');
    Route::delete('leads/{lead}', [\App\Http\Controllers\Admin\LeadController::class, 'destroy'])->name('leads.destroy');

    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    Route::post('settings/slider/delete', [SettingController::class, 'deleteSliderImage'])->name('settings.slider.delete');

    // Home Content
    Route::get('home-content', [HomeContentController::class, 'index'])->name('home-content.index');
    Route::get('home-content/{key}/edit', [HomeContentController::class, 'edit'])->name('home-content.edit');
    Route::put('home-content/{key}', [HomeContentController::class, 'update'])->name('home-content.update');
    Route::post('home-content/{key}/items', [HomeContentController::class, 'storeItem'])->name('home-content.item.store');
    Route::put('home-content/{key}/items/{itemId}', [HomeContentController::class, 'updateItem'])->name('home-content.item.update');
    Route::delete('home-content/{key}/items/{itemId}', [HomeContentController::class, 'destroyItem'])->name('home-content.item.destroy');

    // Page Content
    Route::get('page-content', [PageContentController::class, 'index'])->name('page-content.index');
    Route::get('page-content/{pageKey}/edit', [PageContentController::class, 'edit'])->name('page-content.edit');
    Route::put('page-content/{pageKey}', [PageContentController::class, 'update'])->name('page-content.update');

    // Analytics
    Route::get('analytics', [AnalyticsController::class, 'index'])->name('analytics.index');

    // Image upload for Summernote
    Route::post('upload/image', [UploadController::class, 'image'])->name('upload.image');
});
