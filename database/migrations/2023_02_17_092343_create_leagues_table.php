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
        Schema::create('leagues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->unsignedBigInteger('dome_id');
            $table->string('field_id');
            $table->unsignedBigInteger('sport_id');
            $table->string('name');
            $table->date('booking_deadline')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('start_time');
            $table->string('end_time');
            $table->string('days');
            $table->integer('from_age');
            $table->integer('to_age');
            $table->tinyInteger('gender')->default(1)->comment('1=Men, 2=Women, 3=Other');
            $table->integer('min_player');
            $table->integer('max_player');
            $table->integer('team_limit');
            $table->integer('price');
            $table->tinyInteger('is_deleted')->default(2)->comment('1=Yes,2=No');
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
        Schema::dropIfExists('leagues');
    }
};
