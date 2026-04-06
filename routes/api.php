<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Admin only example route
    Route::get('/admin/dashboard', function (Request $request) {
        if (!$request->user()->is_admin) {
            return response()->json(['message' => 'Unauthorized. Admin access required.'], 403);
        }
        return response()->json(['message' => 'Welcome to the admin dashboard']);
    });

    Route::post('/admin/register-security-guard', [AuthController::class, 'registerSecurityGuard']);
});
