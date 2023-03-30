<?php
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\RestaurantController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:api'])->group(function () {
    Route::apiResource('admins', AdminController::class);
});

Route::apiResource('restaurants', RestaurantController::class);

Route::post('/admin', [AdminController::class, 'store']);


Route::middleware(['auth:api'])->group(function () {
    Route::apiResource('students', StudentController::class);
});
// appro student
Route::middleware(['auth:api'])->group(function () {
    Route::put('students/{student}/approve', [StudentController::class, 'approve'])->name('students.approve');
});



Route::middleware(['auth:api'])->group(function () {
    Route::put('students/{student}/approve', [StudentController::class, 'approve'])
        ->middleware('admin')
        ->name('students.approve');
});


Route::middleware(['auth:api'])->group(function () {
    Route::apiResource('orders', OrderController::class);
});

