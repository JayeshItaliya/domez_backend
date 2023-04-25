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
        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->integer('dome_id');
            $table->string('sport_id');
            $table->string('name');
            $table->double('area', 8, 2)->default(0.00);
            $table->integer('min_person');
            $table->integer('max_person');
            $table->string('image');
            $table->date('maintenance_date')->nullable()->comment('1=Yes, 2=No');
            $table->tinyInteger('in_maintenance')->default(2)->comment('1=Yes, 2=No');
            $table->tinyInteger('is_available')->default(1)->comment('1=Yes, 2=No');
            $table->tinyInteger('is_deleted')->default(2)->comment('1=Yes, 2=No');
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
        Schema::dropIfExists('fields');
    }
};
