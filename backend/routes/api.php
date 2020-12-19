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

Route::get(
    '/translation-channels/{translationChannel}/change-suggestions',
    [ChangeSuggestionController::class, 'index']
);
Route::post(
    '/translation-channels/{translationChannel}/change-suggestions',
    [ChangeSuggestionController::class, 'store']
);

Route::get(
    '/{any}',
    function ()
    {
        abort(404, 'Route not found');
    }
);

