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
        Schema::create('domes', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->string('sport_id');
            $table->string('name');
            $table->double('price', 8, 2)->nullable();
            $table->double('price', 8, 2)->comment('tax(GST)');
            $table->text('address');
            $table->string('pin_code')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('start_time');
            $table->string('end_time');
            $table->text('description');
            $table->string('lat');
            $table->string('lng');
            $table->string('benefits');
            $table->text('benefits_description');
            $table->tinyInteger('is_deleted')->default(2)->comment('1=yes,2=no');
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
        Schema::dropIfExists('domes');
    }
};
