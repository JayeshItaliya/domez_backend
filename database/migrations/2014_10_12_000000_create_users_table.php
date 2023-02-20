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
            $table->increments('id');
            $table->integer('type')->comment('1=Admin, 2=Dome Owner, 3=User');
            $table->integer('login_type')->default(1)->comment('1=Email, 2=Google, 3=Apple, 4=Facebook');
            $table->string('name')->nullable();
            $table->string('email');
            $table->string('countrycode')->nullable();
            $table->string('phone')->nullable();
            $table->string('password')->nullable();
            $table->string('google_id')->nullable();
            $table->string('apple_id')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('otp')->nullable();
            $table->string('image')->default('default.png');
            $table->integer('is_verified')->comment('1=Yes, 2=No')->default('2');
            $table->integer('is_available')->comment('1=Yes, 2=No')->default('1');
            $table->integer('is_deleted')->comment('1=Yes, 2=No')->default('2');
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
