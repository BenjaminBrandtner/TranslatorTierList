<?php

use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\ChangeSuggestionController;
use App\Http\Controllers\Api\TranslationChannelController;
use App\Http\Controllers\Api\VTubersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/translation-channels', [TranslationChannelController::class, 'index']);
Route::post('/translation-channels/search', [TranslationChannelController::class, 'search']);

// Allow cache for 2 hours
\Route::middleware('cache.headers:public;max_age=7200')->group(
    function () {
        Route::get('/categories', [CategoriesController::class, 'index']);
        Route::get('/categories/tree', [CategoriesController::class, 'tree']);
        Route::get('/vtubers', [VTubersController::class, 'index']);
    }
);

Route::post('/change-suggestions', [ChangeSuggestionController::class, 'store']);
Route::post('/change-suggestions/search', [ChangeSuggestionController::class, 'search']);

Route::fallback(function () { abort(404, 'Route not found'); });
