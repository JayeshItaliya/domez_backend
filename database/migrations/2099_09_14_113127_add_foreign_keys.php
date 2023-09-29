<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
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
        Schema::table('working_hours', function (Blueprint $table) {
            $table->foreign('vendor_id')->references('id')->on('users')->where('type', 2)->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('dome_id')->references('id')->on('domes')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('set_prices_days_slots', function (Blueprint $table) {
            $table->foreign('set_prices_id')->references('id')->on('set_prices')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('dome_id')->references('id')->on('domes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sport_id')->references('id')->on('sports')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('set_prices', function (Blueprint $table) {
            $table->foreign('vendor_id')->references('id')->on('users')->where('type', 2)->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('dome_id')->references('id')->on('domes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sport_id')->references('id')->on('sports')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('enquiries', function (Blueprint $table) {
            $table->foreign('vendor_id')->references('id')->on('users')->where('type', 2)->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('leagues', function (Blueprint $table) {
            $table->foreign('vendor_id')->references('id')->on('users')->where('type', 2)->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('provider_id')->references('id')->on('users')->where('type', 5)->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('dome_id')->references('id')->on('domes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sport_id')->references('id')->on('sports')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('vendor_id')->references('id')->on('users')->where('type', 2)->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('dome_id')->references('id')->on('domes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('league_id')->references('id')->on('leagues')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->where('type', 3)->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('booking_id')->references('booking_id')->on('bookings')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('vendor_id')->references('id')->on('users')->where('type', 2)->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('dome_id')->references('id')->on('domes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('vendor_id')->references('id')->on('users')->where('type', 3)->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('payment_gateways', function (Blueprint $table) {
            $table->foreign('vendor_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('fields', function (Blueprint $table) {
            $table->foreign('vendor_id')->references('id')->on('users')->where('type', 2)->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('dome_id')->references('id')->on('domes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sport_id')->references('id')->on('sports')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('favourites', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->where('type', 3)->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('dome_id')->references('id')->on('domes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('league_id')->references('id')->on('leagues')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('dome_images', function (Blueprint $table) {
            $table->foreign('dome_id')->references('id')->on('domes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('league_id')->references('id')->on('leagues')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreign('vendor_id')->references('id')->on('users')->where('type', 2)->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('provider_id')->references('id')->on('users')->where('type', 5)->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('dome_id')->references('id')->on('domes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('league_id')->references('id')->on('leagues')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->where('type', 3)->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sport_id')->references('id')->on('sports')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('domes', function (Blueprint $table) {
            $table->foreign('vendor_id')->references('id')->on('users')->where('type', 2)->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('vendor_id')->references('id')->on('users')->where('type', 2)->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('dome_discounts', function (Blueprint $table) {
            $table->foreign('dome_id')->references('id')->on('domes')->onDelete('cascade')->onUpdate('cascade');
        });
        if (count(User::get()) == 0) {
            $user = new User;
            $user->type = 1;
            $user->login_type = 1;
            $user->name = 'Admin';
            $user->email = 'admin@gmail.com';
            $user->password = Hash::make(12345678);
            $user->is_verified = 1;
            $user->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('working_hours', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);
            $table->dropForeign(['dome_id']);
        });
        Schema::table('set_prices_days_slots', function (Blueprint $table) {
            $table->dropForeign(['set_prices_id']);
            $table->dropForeign(['dome_id']);
            $table->dropForeign(['sport_id']);
        });
        Schema::table('set_prices', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);
            $table->dropForeign(['dome_id']);
            $table->dropForeign(['sport_id']);
        });
        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);
        });
        Schema::table('leagues', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);
            $table->dropForeign(['provider_id']);
            $table->dropForeign(['dome_id']);
            $table->dropForeign(['sport_id']);
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);
            $table->dropForeign(['dome_id']);
            $table->dropForeign(['league_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['booking_id']);
        });
        Schema::table('set_prices', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);
            $table->dropForeign(['dome_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::table('payment_gateways', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);
        });
        Schema::table('fields', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);
            $table->dropForeign(['dome_id']);
            $table->dropForeign(['sport_id']);
        });
        Schema::table('favourites', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['dome_id']);
            $table->dropForeign(['league_id']);
        });
        Schema::table('dome_images', function (Blueprint $table) {
            $table->dropForeign(['dome_id']);
            $table->dropForeign(['league_id']);
        });
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);
            $table->dropForeign(['provider_id']);
            $table->dropForeign(['dome_id']);
            $table->dropForeign(['league_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['sport_id']);
        });
        Schema::table('domes', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);
        });
        Schema::table('dome_discounts', function (Blueprint $table) {
            $table->dropForeign(['dome_id']);
        });
    }
};
