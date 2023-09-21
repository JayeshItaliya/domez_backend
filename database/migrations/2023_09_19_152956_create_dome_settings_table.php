<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dome_settings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('dome_id')->unsigned();
            $table->tinyInteger('accept_decline_bookings')->default(2)->comment('1=Yes, 2=No');
            $table->integer('age')->default(0);
            $table->double('age_below_discount', 15, 2);
            $table->double('age_above_discount', 15, 2);
            $table->integer('max_fields')->default(0);
            $table->double('fields_discount', 15, 2)->default(0);
            $table->longText('policy')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dome_settings');
    }
};
