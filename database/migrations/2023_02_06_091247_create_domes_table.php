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
            $table->unsignedBigInteger('vendor_id');
            $table->string('sport_id');
            $table->string('name');
            $table->double('price', 8, 2)->nullable();
            $table->double('hst', 8, 2);
            $table->text('address');
            $table->string('pin_code')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->tinyInteger('slot_duration')->default(1)->comment('1=60 Minutes, 2=90 Minutes');
            $table->longText('description');
            $table->string('lat');
            $table->string('lng');
            $table->string('benefits');
            $table->longText('benefits_description')->nullable();
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
        Schema::dropIfExists('domes');
    }
};
