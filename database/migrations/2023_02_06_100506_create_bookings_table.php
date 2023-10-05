<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->default(1)->comment('1=Dome Bookings, 2=League Bookings');
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->unsignedBigInteger('dome_id')->nullable();
            $table->unsignedBigInteger('league_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('sport_id');
            $table->string('field_id');
            $table->string('booking_id');
            $table->text('slots')->nullable()->comment('For Domes Booking Only');
            $table->date('start_date')->nullable()->comment('For Leagues Booking Only');
            $table->date('end_date')->nullable()->comment('For Leagues Booking Only');
            $table->time('start_time');
            $table->time('end_time');

            $table->tinyInteger('booking_mode')->default(1)->comment('1=Automatic, 2=Manual');
            $table->double('age_discount_amount')->default(0)->comment('Total amount of Age Discount Amount');
            $table->double('fields_discount_amount')->default(0)->comment('Total amount of Fields Discount Amount');

            $table->double('sub_total')->default(0);
            $table->double('service_fee')->default(0);
            $table->double('hst')->default(0);
            $table->double('total_amount');
            $table->double('paid_amount')->default(0);
            $table->double('due_amount')->default(0);
            $table->double('min_split_amount')->default(0)->comment('Minimum Split Payment amount');
            $table->double('refunded_amount')->default(0);
            $table->integer('payment_mode')->default(1)->comment('1=Online, 2=Offline');
            $table->integer('payment_type')->default(1)->comment('0=WhenBookingIsRequested(BookingModeManual),1=Full Amount, 2=Split Amount');
            $table->integer('payment_status')->default(1)->comment('0=WhenBookingIsRequested(BookingModeManual),1=Complete, 2=Partial');
            $table->integer('booking_status')->default(1)->comment('1=Confirmed, 2=Pending, 3=Cancelled, 4=WaitingApproval');

            $table->dateTime('booking_accepted_at')->nullable()->comment('When Booking Mode is 2 and Dome Owner Accepts the request');

            $table->text('token')->nullable();
            $table->integer('players');
            $table->string('customer_name')->nullable();
            $table->string('customer_email');
            $table->string('customer_mobile')->nullable();
            $table->string('team_name')->nullable()->comment('For Leagues Booking Only');
            $table->tinyInteger('cancelled_by')->nullable()->comment('1=ByAuto, 2=ByDomeOwner, 3=ByCustomer');
            $table->text('cancellation_reason')->nullable();
            $table->tinyInteger('is_payment_released')->default(2)->comment('1=Yes, 2=No');
            $table->tinyInteger('is_review_noti_send')->default(2);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
