<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\VendorController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AuthenticationController;
use App\Http\Controllers\admin\BookingController;
use App\Http\Controllers\admin\PaymentGatewayController;
use App\Http\Controllers\admin\TransactionController;
use App\Http\Controllers\admin\SportsController;
use App\Http\Controllers\admin\DomesController;
use App\Http\Controllers\admin\EnquiryController;
use App\Http\Controllers\admin\FieldController;
use App\Http\Controllers\admin\LeagueController;
use App\Http\Controllers\admin\ReviewController;
use App\Http\Controllers\admin\SettingsController;

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

// Landing Page Route
Route::get('/', [AdminController::class,'landing']);
Route::get('/contact', [AdminController::class,'contact']);
Route::get('privacy-policy', [AdminController::class,'privacy_policy']);
Route::get('terms-condition', [AdminController::class,'terms_condition']);


// Authentication Routes
Route::get('login', [AuthenticationController::class, 'index']);
Route::post('checklogin', [AuthenticationController::class, 'checklogin']);
Route::get('logout', [AuthenticationController::class, 'logout']);
Route::get('forgot-password', [AuthenticationController::class, 'forgot_password']);
Route::post('send-pass', [AuthenticationController::class, 'send_pass']);
Route::get('check-mail', [AuthenticationController::class, 'check_mail']);
Route::get('verification', [AuthenticationController::class, 'verification']);
Route::post('verify', [AuthenticationController::class, 'verify']);
Route::get('resend-otp', [AuthenticationController::class, 'resend']);

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {

    Route::get('dashboard', [AdminController::class, 'dashboard']);

    // Vendors Routes
    Route::group(['middleware' => 'admin', 'prefix' => 'vendors'], function () {
        Route::get('/', [VendorController::class, 'index']);
        Route::get('add', [VendorController::class, 'add']);
        Route::post('store', [VendorController::class, 'store']);
        Route::get('dome-owner-details-{id}', [VendorController::class, 'dome_owner_detail']);
        Route::get('edit-{id}', [VendorController::class, 'edit']);
        Route::post('update-{id}', [VendorController::class, 'update']);
        Route::get('delete', [VendorController::class, 'delete']);
        Route::get('change_status', [VendorController::class, 'change_status']);
    });
    // Users Routes
    Route::group(['middleware' => 'admin', 'prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('delete', [UserController::class, 'delete']);
        Route::get('change_status', [UserController::class, 'change_status']);
    });
    // CMS Pages Routes
    Route::group(['middleware' => 'admin', 'prefix' => 'cms'], function () {
        Route::get('privacy-policy', [AdminController::class, 'privacy_policy']);
        Route::post('store-privacy-policy', [AdminController::class, 'store_privacy_policy']);
        Route::get('terms-condition', [AdminController::class, 'terms_condition']);
        Route::post('store-terms-condition', [AdminController::class, 'store_terms_condition']);
        Route::get('refund-policy', [AdminController::class, 'refund_policy']);
        Route::post('store-refund-policy', [AdminController::class, 'store_refund_policy']);
    });
    //  Payment Gateway
    Route::group(['middleware' => 'admin', 'prefix' => 'payment-gateway'], function () {
        Route::get('stripe', [PaymentGatewayController::class, 'stripe']);
        Route::post('store-stripe', [PaymentGatewayController::class, 'store_stripe']);
    });

    //  Transaction
    Route::get('transactions', [TransactionController::class, 'index']);
    Route::get('transactions/details-{id}', [TransactionController::class, 'details']);

    //  Sports
    Route::group(['middleware' => 'admin', 'prefix' => 'sports'], function () {
        Route::get('/', [SportsController::class, 'index']);
        Route::get('add', [SportsController::class, 'add']);
        Route::post('store', [SportsController::class, 'store']);
        Route::get('edit-{id}', [SportsController::class, 'edit']);
        Route::post('update-{id}', [SportsController::class, 'update']);
        Route::get('change_status', [SportsController::class, 'change_status']);
        Route::get('delete', [SportsController::class, 'delete']);
    });
    //  Leagues
    Route::group(['middleware' => 'admin', 'prefix' => 'leagues'], function () {
        Route::get('/', [LeagueController::class, 'index']);
        Route::get('add', [LeagueController::class, 'add']);
        Route::post('store', [LeagueController::class, 'store']);
        Route::get('edit-{id}', [LeagueController::class, 'edit']);
        Route::post('update-{id}', [LeagueController::class, 'update']);
        Route::get('change_status', [LeagueController::class, 'change_status']);
        Route::get('delete', [LeagueController::class, 'delete']);
        Route::get('details-{id}', [LeagueController::class, 'leaguedetails']);
    });

    //  Domes
    Route::group(['prefix' => 'domes'], function () {
        Route::get('/', [DomesController::class, 'index']);
        Route::get('add', [DomesController::class, 'add']);
        Route::post('store', [DomesController::class, 'store']);
        Route::get('details-{id}', [DomesController::class, 'dome_details']);
        Route::get('edit-{id}', [DomesController::class, 'edit']);
        Route::get('image_delete', [DomesController::class, 'image_delete']);
        Route::post('update-{id}', [DomesController::class, 'update']);
        Route::get('delete', [DomesController::class, 'delete']);
    });

    //  Field
    Route::group(['prefix' => 'field'], function () {
        Route::get('/', [FieldController::class, 'index']);
        Route::get('add', [FieldController::class, 'add']);
        Route::post('store', [FieldController::class, 'store']);
        Route::get('edit-{id}', [FieldController::class, 'edit']);
        Route::get('image_delete', [FieldController::class, 'image_delete']);
        Route::post('update-{id}', [FieldController::class, 'update']);
        Route::get('delete', [FieldController::class, 'delete']);
    });

    //  Bookings
    Route::group(['prefix' => 'bookings'], function () {
        Route::get('/', [BookingController::class, 'index']);
        Route::get('details-{booking_id}', [BookingController::class, 'details']);
    });

    //  Reviews
    Route::group(['prefix' => 'reviews'], function () {
        Route::get('/', [ReviewController::class, 'index']);
    });

    // Settings
    Route::group(['prefix' => 'settings'], function (){
        Route::get('/', [AdminController::class, 'settings']);
    });

    // Supports
    Route::group(['prefix' => 'supports'], function (){
        Route::get('/', [AdminController::class, 'supports']);
        Route::get('edit-profile-{id}', [SettingsController::class, 'edit_profile']);
        Route::get('email-setting', [SettingsController::class, 'email_setting']);
        Route::get('twilio-setting', [SettingsController::class, 'twilio_setting']);
        Route::get('stripe-setting', [SettingsController::class, 'stripe_setting']);
    });

    // Enquiry
    Route::group(['prefix' => 'enquiries'], function (){
        Route::get('dome-requests', [EnquiryController::class, 'dome_requests']);
        Route::get('general-enquiry', [EnquiryController::class, 'general_enquiry']);
        Route::get('help-support', [EnquiryController::class, 'help_support']);
    });
});

Route::group(['prefix' => 'new'],function(){
    Route::get('/', function(){ return view('admin.dashboard.index'); });
});
