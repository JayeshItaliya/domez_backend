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
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->tinyInteger('type')->default(1)->comment('1=HelpCenter[Mobile App], 2=HelpCenter[Web], 3=DomesRequest[Web], 4=DomesRequest[Mobile App], 5=Supports[DomeOwner-AdminPanel]');
            $table->string('dome_name')->nullable();
            $table->string('dome_zipcode')->nullable();
            $table->string('dome_city')->nullable();
            $table->string('dome_state')->nullable();
            $table->string('dome_country')->nullable();
            $table->string('venue_name')->nullable();
            $table->string('venue_address')->nullable();
            $table->string('name')->nullable();
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('subject')->nullable();
            $table->string('message')->nullable();
            $table->tinyInteger('is_replied')->default(2)->comment('1=Yes, 2=No');
            $table->tinyInteger('is_exist')->default(2)->comment('Dome Owner (1=Yes, 2=No )');
            $table->tinyInteger('is_accepted')->default(2)->comment('1=Yes, 2=Pending, 3=No');
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
        Schema::dropIfExists('enquiries');
    }
};
