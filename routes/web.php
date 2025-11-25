<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AirplaneController;
use App\Http\Controllers\ScheduleAirplaneController;

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

// dd(md5("okri122222"));

Route::get('/', [UserController::class, 'index'])->name('home.php');
Route::get('/admin.php', [UserController::class, 'admin']);
Route::post('/admin.php', [UserController::class, 'adminLogin'])->name('admin.php');
Route::get('/login.php', [UserController::class, 'admin']);
Route::get('/register.php', [UserController::class, 'register']);
Route::get('/logout.php', [UserController::class, 'logout']);
Route::post('/customer/register.php', [UserController::class, 'store']);
Route::middleware(['auth'])->group(function () {
    Route::get('/changePassword.php', [UserController::class, 'changePassword']);
    Route::post('/changePassword.php', [UserController::class, 'UpdatePassword']);
});

Route::middleware(['auth', 'auth.type:admin'])->group(function () {
    Route::get('/booking.php', [BookingController::class, 'index'])->name('BookingList');
    Route::post('/process/booking/cancel.php', [BookingController::class, 'processCancel']);
    Route::post('/process/booking/accept.php', [BookingController::class, 'processAccept']);
    Route::post('/process/booking/reject.php', [BookingController::class, 'processReject']);
    Route::get('/airplane.php', [AirplaneController::class, 'index'])->name('AirplaneList');
    Route::get('/airplane_form.php', [AirplaneController::class, 'form']);
    Route::post('/airplane_submit.php', [AirplaneController::class, 'storeUpdate']);
    Route::delete('/airplane/delete.php', [AirplaneController::class, 'delete']);

    Route::get('/schedule.php', [ScheduleAirplaneController::class, 'index'])->name('SchplaneList');
    Route::get('/ schedule_form.php', [ScheduleAirplaneController::class, 'form']);
    Route::post('/schedule_submit.php', [ScheduleAirplaneController::class, 'storeUpdate']);
    Route::delete('/schedule/delete.php', [ScheduleAirplaneController::class, 'delete']);

    Route::get('/user.php', [UserController::class, 'userView'])->name('UserList');
    Route::get('/user_form.php', [UserController::class, 'form']);
    Route::post('/user_submit.php', [UserController::class, 'storeUpdate']);
    Route::delete('/user/delete.php', [UserController::class, 'delete']);
});

Route::middleware(['auth', 'auth.type:customer'])->group(function () {
    Route::get('/booking_customer_form.php', [BookingController::class, 'booking_customer_form'])->name('booking_customer_form');
    Route::post('/process/booking.php', [BookingController::class, 'processBooking']);
    Route::get('/history.php', [BookingController::class, 'historyCustomer']);
    Route::post('/process/booking/cancel.php', [BookingController::class, 'processCancel']);
});

Route::get('upload/{filename}', function ($filename) {
    if (!Storage::exists('public/' . $filename)) {
        abort(404);
    }

    $fileContents = Storage::get('public/' . $filename);

    return Response::make($fileContents, 200, [
        'Content-Type' => 'image/jpeg',
        'Content-Disposition' => 'inline; filename="' . $filename . '"',
    ]);
});
