<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\SolutionController;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\SiteSettingController;

/*
|--------------------------------------------------------------------------
| API Routes — Innovation Project
| Source: docs/03_API_CONTRACT.md
|--------------------------------------------------------------------------
|
| MVP Public Endpoints:
|   GET  /api/pages/{slug}
|   GET  /api/solutions
|   GET  /api/solutions/{slug}
|   POST /api/leads
|   GET  /api/site-settings
|
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
});
