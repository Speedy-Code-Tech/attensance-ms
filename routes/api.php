<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AttendanceController;
use App\Http\Controllers\API\MagazineController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\LinkController;
use App\Http\Controllers\API\ScheduleController;
use App\Http\Controllers\API\BirthdayController;
use App\Http\Controllers\API\MemberController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('attendance/today', [AttendanceController::class, 'getAttendanceToday']);
    Route::post('attendance/log', [AttendanceController::class, 'logAttendance']);
    Route::get('magazines', [MagazineController::class, 'index']);
    Route::get('magazines/{magazine}', [MagazineController::class, 'show']);
    Route::get('/notifications', [NotificationController::class, 'getAllNotifications']);
    Route::put('/notifications/mark-as-seen', [NotificationController::class, 'markAllNotificationsAsSeen']);
    Route::delete('/notifications/clear-seen', [NotificationController::class, 'clearSeenNotifications']);
    Route::get('/links', [LinkController::class, 'index']);
    Route::get('attendance-sheet', [ScheduleController::class, 'attendanceSheet']);
    Route::get('birthdays', [BirthdayController::class, 'index']);
    Route::get('members/rule-of-85', [MemberController::class, 'getRuleOf85Members']);
});