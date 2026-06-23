<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\SolutionController;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\SiteSettingController;
use App\Http\Controllers\Api\PartnerController;
use App\Http\Controllers\Api\NewsletterController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PageViewController;

/*
|--------------------------------------------------------------------------
| API Routes — Innovation Project
| Source: docs/03_API_CONTRACT.md
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {
    // Pages
    Route::get('/pages/{slug}', [PageController::class, 'show']);

    // Solutions
    Route::get('/solutions', [SolutionController::class, 'index']);
    Route::get('/solutions/{slug}', [SolutionController::class, 'show']);

    // Leads (contact form)
    Route::post('/leads', [LeadController::class, 'store'])
        ->middleware('throttle:10,1'); // 10 requests per minute (rate limit)

    // Site Settings
    Route::get('/site-settings', [SiteSettingController::class, 'index']);

    // Partners
    Route::get('/partners', [PartnerController::class, 'index']);

    // Newsletter Subscription
    Route::post('/newsletter/subscribe', [NewsletterController::class, 'store'])
        ->middleware('throttle:5,1'); // 5 requests per minute (rate limit)

    // Blog Categories
    Route::get('/categories', [CategoryController::class, 'index']);

    // Blog Posts
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/{slug}', [PostController::class, 'show']);

    // Analytics Tracking
    Route::post('/track', [PageViewController::class, 'store'])
        ->middleware('throttle:120,1'); // 120 tracking requests per minute
});
