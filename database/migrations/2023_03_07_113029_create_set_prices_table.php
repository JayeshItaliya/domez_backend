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
        Schema::create('set_prices', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->integer('dome_id');
            $table->integer('sport_id');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('price_type')->default(1)->comment('1=default,2=daywise');
            $table->double('price', 8, 2)->default(0);
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
        Schema::dropIfExists('set_prices');
    }
};
