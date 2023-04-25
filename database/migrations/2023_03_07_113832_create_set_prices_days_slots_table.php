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
        Schema::create('set_prices_days_slots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('set_prices_id');
            $table->foreign('set_prices_id')->references('id')->on('set_prices');
            $table->integer('dome_id')->nullable();
            $table->integer('sport_id')->nullable();
            $table->date('date')->nullable();
            $table->time('start_time');
            $table->time('end_time');
            $table->string('day');
            $table->double('price', 8, 2)->default(0);
            $table->integer('status');
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
        Schema::dropIfExists('set_prices_days_slots');
    }
};
