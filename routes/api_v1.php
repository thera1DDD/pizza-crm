<?php

use App\Http\Controllers\API\V1\OrderController;
use Illuminate\Http\Request;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('orders')->group(function () {
    Route::post('/store', [OrderController::class, 'store']);
    Route::post('/{order_id}/items', [OrderController::class, 'addItems']);
    Route::get('/{order_id}', [OrderController::class, 'show']);
    Route::post('/{order_id}/done', [OrderController::class, 'markAsDone']);
    Route::get('/', [OrderController::class, 'index']);
});

