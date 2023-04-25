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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->comment('1=incoming, 2=Outgoing(refund)');
            $table->integer('vendor_id');
            $table->integer('dome_id')->nullable();
            $table->integer('league_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('booking_id');
            $table->string('contributor_name')->nullable();
            $table->integer('payment_method')->default(1)->comment('1=Card, 2=Apple Pay, 3=Google Pay');
            $table->string('transaction_id');
            $table->double('amount', 8, 2);
            $table->tinyInteger('is_payment_released')->default(2)->comment('1=Yes, 2=No');
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
        Schema::dropIfExists('transactions');
    }
};
