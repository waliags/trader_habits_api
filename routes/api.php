<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\HabitCompletionController;
use App\Http\Controllers\TradeReviewController;
use App\Http\Controllers\GoalTrackingController;
use App\Http\Controllers\EmotionalCheckInController;
use App\Http\Controllers\JournalEntryController;
use App\Http\Controllers\RiskMetricController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Password;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [UserController::class, 'forgotPassword']);
Route::post('/reset-password', [UserController::class, 'resetPassword']);

// 🔐 Protected Routes (Auth required)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    // Other protected routes here
});

Route::middleware('auth:sanctum')->put('/update-profile', [UserController::class, 'updateProfile']);
Route::middleware('auth:sanctum')->put('/change-password', [UserController::class, 'changePassword']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/trade-reviews', [TradeReviewController::class, 'index']);
    Route::post('/trade-reviews', [TradeReviewController::class, 'store']);
Route::apiResource('habits', HabitController::class);
Route::get('/habit-completions/today', [HabitCompletionController::class, 'today']);
Route::delete('/habit-completions', [HabitCompletionController::class, 'destroy']);
Route::get('/habit-streak', [HabitCompletionController::class, 'getStreak']);


Route::post('/habit-completions', [HabitCompletionController::class, 'store']);

Route::get('/emotional-checkins', [EmotionalCheckInController::class, 'index']);
Route::post('/emotional-checkins', [EmotionalCheckInController::class, 'store']);

Route::get('/journal-entries', [JournalEntryController::class, 'index']);
Route::post('/journal-entries', [JournalEntryController::class, 'store']);

Route::get('/goals', [GoalTrackingController::class, 'index']);
Route::post('/goals', [GoalTrackingController::class, 'store']);


});


Route::middleware(['auth:sanctum', 'throttle:60,1'])->get('/analytics', [AnalyticsController::class, 'index']);














Route::get('/risk-metrics', [RiskMetricController::class, 'index']);
Route::post('/risk-metrics', [RiskMetricController::class, 'store']);

