<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// Category routes
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

// Subcategory routes
Route::post('/subcategories', [CategoryController::class, 'storeSubcategory']);
Route::put('/subcategories/{id}', [CategoryController::class, 'updateSubcategory']);
Route::delete('/subcategories/{id}', [CategoryController::class, 'destroySubcategory']);

// Child category routes
Route::post('/child-categories', [CategoryController::class, 'storeChildCategory']);
Route::put('/child-categories/{id}', [CategoryController::class, 'updateChildCategory']);
Route::delete('/child-categories/{id}', [CategoryController::class, 'destroyChildCategory']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
