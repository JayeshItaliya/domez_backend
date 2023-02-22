<?php

use App\Http\Controllers\api\BookingController;
use App\Http\Controllers\api\LeagueController;
use App\Http\Controllers\api\AdminController;
use App\Http\Controllers\api\DomesController;
use App\Http\Controllers\api\AuthenticationController;
use App\Http\Controllers\api\FavouriteController;
use App\Http\Controllers\api\HomeController;
use App\Http\Controllers\api\PaymentController;
use App\Http\Controllers\api\ReviewController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('optimize', [AdminController::class, 'optimize']);

Route::post('sign-up', [AuthenticationController::class, 'sign_up']);
Route::post('sign-in', [AuthenticationController::class, 'sign_in']);
Route::post('verify', [AuthenticationController::class, 'verify']);
Route::post('resend-otp', [AuthenticationController::class, 'resend_otp']);
Route::post('forgot-password', [AuthenticationController::class, 'forgot_password']);
Route::post('change-password', [AuthenticationController::class, 'changepassword']);
Route::post('google-login', [AuthenticationController::class, 'google_login']);
Route::get('delete-account-{id}', [AuthenticationController::class, 'delete_account']);
Route::post('editprofile', [AuthenticationController::class, 'editprofile']);

Route::get('sportslist', [HomeController::class, 'sportslist']);
Route::get('privacy-policy', [HomeController::class, 'privacy_policy']);
Route::get('terms-conditions', [HomeController::class, 'terms_conditions']);
Route::post('helpcenter', [HomeController::class, 'helpcenter']);
Route::get('pushnotification', [HomeController::class, 'pushnotification']);


Route::post('payment', [PaymentController::class, 'payment']);

Route::post('domes-list', [DomesController::class, 'domes_list']);
Route::get('dome-details-{id}', [DomesController::class, 'domes_details']);

Route::post('leagues-list', [LeagueController::class, 'leagues_list']);
Route::get('league-details-{id}', [LeagueController::class, 'league_details']);

Route::post('filter', [HomeController::class, 'filter']);

Route::post('favourite', [FavouriteController::class, 'favourite']);
Route::post('favourite-list', [FavouriteController::class, 'favourite_list']);

Route::post('booking', [BookingController::class, 'booking']);
Route::post('check-booking', [BookingController::class, 'check_booking']);

Route::post('review', [ReviewController::class, 'review']);
Route::get('avg-ratting-{id}', [ReviewController::class, 'avg_rating']);
Route::get('rattinglist-{dome_id}', [ReviewController::class, 'rattinglist']);

Route::post('timeslots', [BookingController::class, 'timeslots']);
Route::post('available-fields', [BookingController::class, 'avl_fields']);


// Route::post('requestdomes', [AuthenticationController::class, 'requestdomes']);
