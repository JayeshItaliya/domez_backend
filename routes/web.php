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
use App\Http\Controllers\admin\DomesPriceController;
use App\Http\Controllers\admin\EnquiryController;
use App\Http\Controllers\admin\FieldController;
use App\Http\Controllers\admin\LeagueController;
use App\Http\Controllers\admin\ReviewController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\WorkersController;

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
Route::get('/', [AdminController::class, 'landing']);
Route::post('store-general-enquiries', [EnquiryController::class, 'store_general_enquiries']);
Route::post('dome-request', [EnquiryController::class, 'dome_request']);
Route::get('contact', [AdminController::class, 'contact']);
Route::get('privacy-policy', [AdminController::class, 'privacy_policy']);
Route::get('terms-conditions', [AdminController::class, 'terms_conditions']);

Route::get('payment/{token}', [BookingController::class, 'split_payment']);
Route::post('payment/process', [BookingController::class, 'split_payment_process']);


// Authentication
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

    // Development Purpose
    Route::get('login-dev', [AdminController::class, 'login_dev']);
    Route::get('login-emp', [AdminController::class, 'login_emp']);
    // Common
    Route::get('validate-time', [DomesPriceController::class, 'validate_start_end_time']);
    Route::get('dashboard', [AdminController::class, 'dashboard']);
    Route::get('calendar', [BookingController::class, 'calendar']);
    // Domes
    Route::get('domes', [DomesController::class, 'index']);
    Route::get('domes/details-{id}', [DomesController::class, 'dome_details']);
    // Leagues
    Route::get('leagues', [LeagueController::class, 'index']);
    Route::get('leagues/details-{id}', [LeagueController::class, 'leaguedetails']);
    //  Transaction
    Route::group(['prefix' => 'transactions'], function () {
        Route::get('/', [TransactionController::class, 'index']);
        Route::get('details-{id}', [TransactionController::class, 'details']);
    });
    //  Bookings
    Route::group(['prefix' => 'bookings'], function () {
        Route::get('/', [BookingController::class, 'index']);
        Route::get('/filter-data', [BookingController::class, 'index']);
        Route::get('details-{booking_id}', [BookingController::class, 'details']);
    });
    // Enquiry
    Route::group(['prefix' => 'enquiries'], function () {
        Route::get('dome-requests', [EnquiryController::class, 'dome_requests']);
        Route::get('dome-request-status', [EnquiryController::class, 'dome_request_status']);
        Route::get('dome-request-delete', [EnquiryController::class, 'dome_request_delete']);
        Route::post('dome-request-reply', [EnquiryController::class, 'dome_request_reply']);
        Route::get('general-enquiry', [EnquiryController::class, 'general_enquiry']);
        Route::post('general-enquiry-reply', [EnquiryController::class, 'general_enquiry_reply']);
        Route::get('help-support', [EnquiryController::class, 'help_support']);
        Route::post('help-support-reply', [EnquiryController::class, 'help_support_reply']);
    });
    // Settings
    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', [AdminController::class, 'settings']);
        Route::get('privacy-policy', [SettingsController::class, 'privacy_policy']);
        Route::get('terms-conditions', [SettingsController::class, 'terms_conditions']);
        Route::post('store-cms', [SettingsController::class, 'store_cms']);

        Route::get('edit-profile', [SettingsController::class, 'show_profile']);
        Route::post('check-email-exist', [SettingsController::class, 'checkemailexist']);
        Route::post('verify-email', [SettingsController::class, 'verifyemail']);
        Route::post('update-profile', [SettingsController::class, 'update_profile']);
        Route::post('change-password', [SettingsController::class, 'change_password']);

        Route::get('email-setting', [SettingsController::class, 'email_setting']);
        Route::post('email-setting', [SettingsController::class, 'store_email_setting']);
        Route::get('twilio-setting', [SettingsController::class, 'twilio_setting']);
        Route::post('twilio-setting', [SettingsController::class, 'store_twilio_setting']);
        Route::get('stripe-setting', [SettingsController::class, 'stripe_setting']);
    });

    // Supports
    Route::group(['prefix' => 'supports'], function () {
        Route::get('/', [EnquiryController::class, 'supports']);
        Route::post('store-ticket', [EnquiryController::class, 'store_ticket']);
        Route::post('ticket-reply', [EnquiryController::class, 'ticket_reply']);
    });

    // Vendors
    Route::group(['middleware' => 'AdminMiddleware'], function () {
        Route::group(['prefix' => 'vendors'], function () {
            Route::get('/', [VendorController::class, 'index']);
            Route::get('add', [VendorController::class, 'add']);
            Route::post('store', [VendorController::class, 'store']);
            Route::get('dome-owner-details-{id}', [VendorController::class, 'dome_owner_detail']);
            Route::get('edit-{id}', [VendorController::class, 'edit']);
            Route::post('update-{id}', [VendorController::class, 'update']);
            Route::get('delete', [VendorController::class, 'delete']);
            Route::get('change_status', [VendorController::class, 'change_status']);
        });
        // Users
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [UserController::class, 'index']);
            Route::get('edit-{id}', [UserController::class, 'edit']);
            Route::get('details-{id}', [UserController::class, 'user_details']);
            Route::get('delete', [UserController::class, 'delete']);
            Route::get('change_status', [UserController::class, 'change_status']);
        });
        //  Payment Gateway
        Route::group(['prefix' => 'payment-gateway'], function () {
            Route::get('stripe', [PaymentGatewayController::class, 'stripe']);
            Route::post('store-stripe', [PaymentGatewayController::class, 'store_stripe']);
        });
        //  Sports
        Route::group(['prefix' => 'sports'], function () {
            Route::get('/', [SportsController::class, 'index']);
            Route::get('add', [SportsController::class, 'add']);
            Route::post('store', [SportsController::class, 'store']);
            Route::get('edit-{id}', [SportsController::class, 'edit']);
            Route::post('update-{id}', [SportsController::class, 'update']);
            Route::get('change_status', [SportsController::class, 'change_status']);
            Route::get('delete', [SportsController::class, 'delete']);
        });
    });
    Route::group(['middleware' => 'VendorMiddleware'], function () {
        //  Workers
        Route::group(['prefix' => 'workers'], function () {
            Route::get('/', [WorkersController::class, 'index']);
            Route::post('store-worker', [WorkersController::class, 'store_worker']);
            Route::get('change_status', [WorkersController::class, 'change_status']);
            Route::get('delete', [WorkersController::class, 'delete']);
        });
        //  Leagues
        Route::group(['prefix' => 'leagues'], function () {
            Route::get('add', [LeagueController::class, 'add']);
            Route::post('store', [LeagueController::class, 'store']);
            Route::get('edit-{id}', [LeagueController::class, 'edit']);
            Route::post('update-{id}', [LeagueController::class, 'store']);
            Route::get('change_status', [LeagueController::class, 'change_status']);
            Route::get('delete', [LeagueController::class, 'delete']);
            Route::get('sports-fields', [LeagueController::class, 'getsportsandfields']);
        });
        //  Domes
        Route::group(['prefix' => 'domes'], function () {
            Route::get('add', [DomesController::class, 'add']);
            Route::post('store', [DomesController::class, 'store']);
            Route::get('edit-{id}', [DomesController::class, 'edit']);
            Route::get('image_delete', [DomesController::class, 'image_delete']);
            Route::post('update-{id}', [DomesController::class, 'update']);
            Route::get('delete', [DomesController::class, 'delete']);
            Route::get('new-request', [DomesController::class, 'new_request']);
        });
        // Set Prices
        Route::group(['prefix' => 'set-prices'], function () {
            Route::get('/', [DomesPriceController::class, 'index']);
            Route::get('add', [DomesPriceController::class, 'add']);
            Route::get('edit-{id}', [DomesPriceController::class, 'edit']);
            Route::post('store', [DomesPriceController::class, 'store']);
            Route::get('delete', [DomesPriceController::class, 'deletesetprice']);
            Route::get('delete-slot', [DomesPriceController::class, 'deleteslot']);
            Route::get('getsports', [DomesPriceController::class, 'getsportslist']);

            // Route::post('update-{id}', [DomesPriceController::class, 'update']);
            // Route::get('details-{id}', [DomesPriceController::class, 'dome_price_details']);
        });
        //  Field
        Route::group(['prefix' => 'fields'], function () {
            Route::get('/', [FieldController::class, 'index']);
            Route::get('add', [FieldController::class, 'add']);
            Route::post('store', [FieldController::class, 'store']);
            Route::get('edit-{id}', [FieldController::class, 'edit']);
            Route::get('image_delete', [FieldController::class, 'image_delete']);
            Route::post('update-{id}', [FieldController::class, 'update']);
            Route::get('delete', [FieldController::class, 'delete']);
        });
        //  Reviews
        Route::group(['prefix' => 'reviews'], function () {
            Route::get('/', [ReviewController::class, 'index']);
        });
    });
});

Route::group(['prefix' => 'new'], function () {
    Route::get('/', function () {
        return view('admin.dashboard.index');
    });
});
