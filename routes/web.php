<?php

use App\Http\Controllers\API\AttendanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MagazineController;
use App\Http\Controllers\AttendanceExportController;
use App\Http\Controllers\AttendanceLogController;
use App\Http\Controllers\CashAdvanceController;
use App\Http\Controllers\CashDisbursementController;
use App\Http\Controllers\CashReceiptController;
use App\Http\Controllers\QRScannerController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberTrackerController;
use App\Http\Controllers\PettyCashController;
use App\Http\Controllers\ProjectDisbursementController;
use App\Models\Magazine;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('role:admin,staff')->group(function () {
    Route::resource('schedules', ScheduleController::class);
    Route::resource('links', LinkController::class);
    Route::get('/attendance-sheet', [ScheduleController::class, 'attendanceSheet'])->name('attendance.sheet');
    Route::get('/attendance-export', [AttendanceExportController::class, 'export'])->name('attendance.export');

    // Attendance Log routes
    Route::prefix('attendance-logs')->group(function () {
        Route::get('/', [AttendanceLogController::class, 'index'])->name('attendance-logs.index');
        Route::get('/create', [AttendanceLogController::class, 'create'])->name('attendance-logs.create');
        Route::post('/', [AttendanceLogController::class, 'store'])->name('attendance-logs.store');
        Route::get('/{attendance}/edit', [AttendanceLogController::class, 'edit'])->name('attendance-logs.edit');
        Route::put('/{attendance}', [AttendanceLogController::class, 'update'])->name('attendance-logs.update');
        Route::delete('/{attendanceLog}', [AttendanceLogController::class, 'destroy'])->name('attendance-logs.destroy');
    });

    Route::get('/magazines', [MagazineController::class, 'index'])->name('magazines.index');
    Route::get('/magazines/create', [MagazineController::class, 'create'])->name('magazines.create');
    Route::post('/magazines', [MagazineController::class, 'store'])->name('magazines.store');
    Route::get('/magazines/{magazine}', [MagazineController::class, 'show'])->name('magazines.show');
    Route::get('/magazines/{magazine}/edit', [MagazineController::class, 'edit'])->name('magazines.edit');
    Route::put('/magazines/{magazine}', [MagazineController::class, 'update'])->name('magazines.update');
    Route::delete('/magazines/{magazine}', [MagazineController::class, 'destroy'])->name('magazines.destroy');

    Route::get('/phone-scanner', [QRScannerController::class, 'index'])->name('phone-scanner');
    Route::post('/attendance/log', [AttendanceController::class, 'logAttendance'])->name('log-attendance');
    Route::get('/attendance', [AttendanceLogController::class, 'attendance'])->name('attendance');
    Route::get('/get-recent-attendances', [AttendanceLogController::class, 'getRecentAttendances'])->name('recent-attendance');
    
    Route::get('/settings', [HomeController::class, 'settings'])->name('settings');
    Route::post('/settings/{user}', [HomeController::class, 'changePassword'])->name('admin.changePassword');

    //LINKS PAGES GO HERE

    Route::get('cashreceipt', [CashReceiptController::class, 'index'])->name('cash.index');
    Route::post('cashreceipt/store', [CashReceiptController::class, 'cashstore'])->name('cash.store');
    Route::get('cashreceipt/create', [CashReceiptController::class, 'cashcreate'])->name('cash.create');
    Route::get('cashreceipt/edit/{id}', [CashReceiptController::class, 'cashedit'])->name('cash.edit');
    Route::post('cashreceipt/save/{id}', [CashReceiptController::class, 'cashsaveedit'])->name('cash.saveedit');
    Route::delete('cashreceipt/delete/{id}', [CashReceiptController::class, 'destroy'])->name('cash.delete');
    

    Route::get('cashdisbursement',[CashDisbursementController::class,'index'])->name('cashdis.index');
    Route::get('cashdisbursement/create',[CashDisbursementController::class,'create'])->name('cashdis.create');
    Route::delete('cashdisbursement/destoy/{id}',[CashDisbursementController::class,'destroy'])->name('cashdis.destroy');
    Route::get('cashdisbursement/edit/{id}',[CashDisbursementController::class,'edit'])->name('cashdis.edit');
    Route::post('cashdisbursement/saveedit/{id}',[CashDisbursementController::class,'update'])->name('cashdis.update');
    Route::post('cashdisbursement/store',[CashDisbursementController::class,'store'])->name('cashdis.store');
    
    Route::get('pettycash',[PettyCashController::class,'index'])->name('petty.index');
    
    
    Route::get('projectdisbursement',[ProjectDisbursementController::class,'index'])->name('projectdis.index');
    
    Route::get('cashadvances',[CashAdvanceController::class,'index'])->name('cashadvance.index');

    Route::get('memberTracker',[MemberTrackerController::class,'index'])->name('member.index');
    
});

Route::middleware('role:admin')->group(function () {
    // Admin-only routes go here
    Route::get('members', [MemberController::class, 'index'])->name('members.index');
    Route::get('members/create', [MemberController::class, 'create'])->name('members.create');
    Route::post('members', [MemberController::class, 'store'])->name('members.store');
    Route::get('members/{member}/edit', [MemberController::class, 'edit'])->name('members.edit');
    Route::put('members/{member}', [MemberController::class, 'update'])->name('members.update');
    Route::delete('members/{member}', [MemberController::class, 'destroy'])->name('members.destroy');
    Route::get('members/deleted', [MemberController::class, 'deletedMembers'])->name('members.deleted');
    Route::patch('/members/restore/{id}', [MemberController::class, 'restoreMember'])->name('members.restore');
    Route::delete('/members/delete-permanently/{id}', [MemberController::class, 'deletePermanently'])->name('members.delete-permanently');
});

Route::middleware('role:member')->group(function () {
    // Member-only routes go here
    Route::get('/profile', [MemberController::class, 'profile'])->name('profile');
    Route::put('/profile/{member}', [MemberController::class, 'updateProfile'])->name('profile.update');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('users/export/', [UserController::class, 'export']);

Route::post('/upload-profile-picture', [MemberController::class, 'uploadProfilePicture'])->name('upload-profile-picture');
Route::post('/upload-thumbnail-picture', [MagazineController::class, 'uploadThumbnailPicture'])->name('upload-thumbnail-picture');