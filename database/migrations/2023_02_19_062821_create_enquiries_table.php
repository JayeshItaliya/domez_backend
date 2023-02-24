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
            $table->string('venue_name')->nullable();
            $table->string('venue_address')->nullable();
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('subject')->nullable();
            $table->string('message')->nullable();
            $table->tinyInteger('type')->default(1)->comment('1=HelpCenter, 2=GeneralEnquiry, 3=DomesRequest [From Landing Page], 4=DomesRequest [From Mobile App]	');
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
