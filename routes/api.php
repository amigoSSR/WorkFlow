<?php

use App\Http\Controllers\HouseRuleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes (Admin & User can access)
Route::get('/house-rules', [HouseRuleController::class, 'index']);
Route::get('/house-rules/categories', [HouseRuleController::class, 'categories']);
Route::get('/house-rules/{houseRule}', [HouseRuleController::class, 'show']);

// Admin only routes
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::post('/house-rules', [HouseRuleController::class, 'store']);
    Route::put('/house-rules/{houseRule}', [HouseRuleController::class, 'update']);
    Route::delete('/house-rules/{houseRule}', [HouseRuleController::class, 'destroy']);
});