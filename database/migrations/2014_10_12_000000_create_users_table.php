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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->comment('1=Admin, 2=Dome Owner, 3=User, 4=Employee, 5=Provider');
            $table->integer('login_type')->default(1)->comment('1=Email, 2=Google, 3=Apple, 4=Facebook');
            $table->unsignedBigInteger('vendor_id')->nullable()->comment('For Workers use only');
            $table->tinyInteger('dome_limit')->nullable()->comment('Only For Dome Owner');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('countrycode')->nullable();
            $table->string('phone')->nullable();
            $table->string('password')->nullable();
            $table->string('google_id')->nullable();
            $table->string('apple_id')->nullable();
            $table->string('facebook_id')->nullable();
            $table->text('fcm_token')->nullable();
            $table->string('otp')->nullable();
            $table->string('image')->default('default.png');
            $table->integer('is_verified')->default(2)->comment('1=Yes, 2=No');
            $table->integer('is_available')->default(1)->comment('1=Yes, 2=No');
            $table->integer('is_deleted')->default(2)->comment('1=Yes, 2=No');
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
        Schema::dropIfExists('users');
    }
};
