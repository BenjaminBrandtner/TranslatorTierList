<?php

use App\Http\Controllers\Api\ChangeSuggestionController;
use App\Http\Controllers\Api\TranslationChannelController;
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

Route::post('/change-suggestions', [ChangeSuggestionController::class, 'store']);

Route::fallback(function () { abort(404, 'Route not found'); });
