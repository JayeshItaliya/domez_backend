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
            $table->integer('vendor_id');
            $table->integer('provider_id')->nullable();
            $table->integer('dome_id')->nullable();
            $table->integer('league_id')->nullable();
            $table->integer('user_id');
            $table->integer('sport_id');
            $table->string('field_id');
            $table->string('booking_id');
            $table->text('slots')->comment('For Domes Booking Only');
            $table->date('start_date')->nullable()->comment('For Leagues Booking Only');
            $table->date('end_date')->nullable()->comment('For Leagues Booking Only');
            $table->time('start_time');
            $table->time('end_time');
            $table->double('sub_total', 8, 2)->default(0.00);
            $table->double('service_fee', 8, 2)->default(0.00);
            $table->double('hst', 8, 2)->default(0.00);
            $table->double('total_amount', 8, 2)->default(0.00);
            $table->double('paid_amount', 8, 2)->default(0.00);
            $table->double('due_amount', 8, 2)->default(0.00);
            $table->double('min_split_amount')->nullable()->default(0)->comment('Minimum Split Payment amount');
            $table->double('refunded_amount')->nullable()->default(0);
            $table->integer('payment_mode')->default(1)->comment('1=Online, 2=Offline');
            $table->integer('payment_type')->default(1)->comment('1=Complete, 2=Partial');
            $table->integer('booking_status')->default(1)->comment('1=Confirmed, 2=Pending, 3=Cancelled');
            $table->text('token')->nullable();
            $table->integer('players');
            $table->string('customer_name')->nullable();
            $table->string('customer_email');
            $table->string('customer_mobile')->nullable();
            $table->string('team_name')->nullable()->comment('For Leagues Booking Only');
            $table->tinyInteger('cancelled_by')->nullable()->comment('1=ByAuto, 2=ByDomeOwner, 3=ByCustomer');
            $table->text('cancellation_reason')->nullable();
            $table->tinyInteger('is_payment_released')->default(2)->comment('1=Yes, 2=No');
            $table->tinyInteger('is_review_noti_send')->default(2)->comment('1=Yes, 2=No');
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
