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
        Schema::create('dome_discounts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('dome_id');
            $table->foreign('dome_id')->references('id')->on('domes')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('sport_id');
            $table->foreign('sport_id')->references('id')->on('sports')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('from_age')->default(0);
            $table->integer('to_age')->default(0);
            $table->double('age_discounts')->default(0);
            $table->tinyInteger('discount_type')->default(1)->comment('1=In Percentage, 2=Fixed');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dome_discounts');
    }
};
