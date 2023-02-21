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
            $table->integer('vendor_id');
            $table->integer('dome_id')->nullable();
            $table->integer('league_id')->nullable();
            $table->integer('user_id');
            $table->integer('field_id');
            $table->integer('booking_id');
            $table->date('booking_date');
            $table->string('customer_name')->nullable();
            $table->string('customer_email');
            $table->string('customer_mobile')->nullable();
            $table->string('team_name')->nullable()->comment('For Leagues Booking Only');
            $table->integer('players');
            $table->text('slots')->nullable()->comment('For Domes Booking Only');
            $table->date('start_date')->nullable()->comment('For Leagues Booking Only');
            $table->date('end_date')->nullable()->comment('For Leagues Booking Only');
            $table->text('start_time');
            $table->text('end_time');
            $table->double('total_amount', 8, 2);
            $table->double('paid_amount', 8, 2)->default(0);
            $table->double('due_amount', 8, 2)->default(0);
            $table->integer('payment_mode')->default(1)->comment('1=online,2=offline');
            $table->integer('payment_type')->default(1)->comment('1=Full Amount, 2=Split Amount');
            $table->integer('payment_status')->default(1)->comment('1=Complete,2=Partial');
            $table->integer('booking_status')->default(1)->comment('1=Confirmed, 2=Pending, 3=Cancelled	');
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
