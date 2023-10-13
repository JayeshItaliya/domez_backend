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
            $table->foreign('vendor_id', 'working_hours_foreign_vendor_id')->references('id')->on('users')->where('type', 2)->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('dome_id', 'working_hours_foreign_dome_id')->references('id')->on('domes')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('set_prices_days_slots', function (Blueprint $table) {
            $table->foreign('dome_id', 'set_prices_days_slots_foreign_dome_id')->references('id')->on('domes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sport_id', 'set_prices_days_slots_foreign_sport_id')->references('id')->on('sports')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('set_prices', function (Blueprint $table) {
            $table->foreign('vendor_id', 'set_prices_foreign_vendor_id')->references('id')->on('users')->where('type', 2)->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('dome_id', 'set_prices_foreign_dome_id')->references('id')->on('domes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sport_id', 'set_prices_foreign_sport_id')->references('id')->on('sports')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('enquiries', function (Blueprint $table) {
            $table->foreign('vendor_id', 'vendor_id')->references('id')->on('users')->where('type', 2)->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('leagues', function (Blueprint $table) {
            $table->foreign('vendor_id', 'leagues_foreign_vendor_id')->references('id')->on('users')->where('type', 2)->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('provider_id', 'leagues_foreign_provider_id')->references('id')->on('users')->where('type', 5)->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('dome_id', 'leagues_foreign_dome_id')->references('id')->on('domes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sport_id', 'leagues_foreign_sport_id')->references('id')->on('sports')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('vendor_id', 'transactions_foreign_vendor_id')->references('id')->on('users')->where('type', 2)->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('dome_id', 'transactions_foreign_dome_id')->references('id')->on('domes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('league_id', 'transactions_foreign_league_id')->references('id')->on('leagues')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'transactions_foreign_user_id')->references('id')->on('users')->where('type', 3)->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('vendor_id', 'reviews_foreign_vendor_id')->references('id')->on('users')->where('type', 2)->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('dome_id', 'reviews_foreign_dome_id')->references('id')->on('domes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'reviews_foreign_user_id')->references('id')->on('users')->where('type', 3)->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('payment_gateways', function (Blueprint $table) {
            $table->foreign('vendor_id', 'payment_gateways_foreign_vendor_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('fields', function (Blueprint $table) {
            $table->foreign('vendor_id', 'fields_foreign_vendor_id')->references('id')->on('users')->where('type', 2)->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('dome_id', 'fields_foreign_dome_id')->references('id')->on('domes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sport_id', 'fields_foreign_sport_id')->references('id')->on('sports')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('favourites', function (Blueprint $table) {
            $table->foreign('user_id', 'favourites_foreign_user_id')->references('id')->on('users')->where('type', 3)->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('dome_id', 'favourites_foreign_dome_id')->references('id')->on('domes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('league_id', 'favourites_foreign_league_id')->references('id')->on('leagues')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('dome_images', function (Blueprint $table) {
            $table->foreign('dome_id', 'dome_images_foreign_dome_id')->references('id')->on('domes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('league_id', 'dome_images_foreign_league_id')->references('id')->on('leagues')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreign('vendor_id', 'bookings_foreign_vendor_id')->references('id')->on('users')->where('type', 2)->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('provider_id', 'bookings_foreign_provider_id')->references('id')->on('users')->where('type', 5)->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('dome_id', 'bookings_foreign_dome_id')->references('id')->on('domes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('league_id', 'bookings_foreign_league_id')->references('id')->on('leagues')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'bookings_foreign_user_id')->references('id')->on('users')->where('type', 3)->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sport_id', 'bookings_foreign_sport_id')->references('id')->on('sports')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('domes', function (Blueprint $table) {
            $table->foreign('vendor_id', 'domes_foreign_vendor_id')->references('id')->on('users')->where('type', 2)->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('vendor_id', 'users_foreign_vendor_id')->references('id')->on('users')->where('type', 2)->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('dome_discounts', function (Blueprint $table) {
            $table->foreign('dome_id', 'dome_discounts_foreign_dome_id')->references('id')->on('domes')->onDelete('cascade')->onUpdate('cascade');
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
            $table->dropForeign(['working_hours_foreign_vendor_id']);
            $table->dropForeign(['working_hours_foreign_dome_id']);
        });
        Schema::table('set_prices_days_slots', function (Blueprint $table) {
            $table->dropForeign(['set_prices_days_slots_foreign_dome_id']);
            $table->dropForeign(['set_prices_days_slots_foreign_sport_id']);
        });
        Schema::table('set_prices', function (Blueprint $table) {
            $table->dropForeign(['set_prices_foreign_vendor_id']);
            $table->dropForeign(['set_prices_foreign_dome_id']);
            $table->dropForeign(['set_prices_foreign_sport_id']);
        });
        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);
        });
        Schema::table('leagues', function (Blueprint $table) {
            $table->dropForeign(['leagues_foreign_vendor_id']);
            $table->dropForeign(['leagues_foreign_provider_id']);
            $table->dropForeign(['leagues_foreign_dome_id']);
            $table->dropForeign(['leagues_foreign_sport_id']);
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['transactions_foreign_vendor_id']);
            $table->dropForeign(['transactions_foreign_dome_id']);
            $table->dropForeign(['transactions_foreign_league_id']);
            $table->dropForeign(['transactions_foreign_user_id']);
        });
        Schema::table('set_prices', function (Blueprint $table) {
            $table->dropForeign(['reviews_foreign_vendor_id']);
            $table->dropForeign(['reviews_foreign_dome_id']);
            $table->dropForeign(['reviews_foreign_user_id']);
        });
        Schema::table('payment_gateways', function (Blueprint $table) {
            $table->dropForeign(['payment_gateways_foreign_vendor_id']);
        });
        Schema::table('fields', function (Blueprint $table) {
            $table->dropForeign(['fields_foreign_vendor_id']);
            $table->dropForeign(['fields_foreign_dome_id']);
            $table->dropForeign(['fields_foreign_sport_id']);
        });
        Schema::table('favourites', function (Blueprint $table) {
            $table->dropForeign(['favourites_foreign_user_id']);
            $table->dropForeign(['favourites_foreign_dome_id']);
            $table->dropForeign(['favourites_foreign_league_id']);
        });
        Schema::table('dome_images', function (Blueprint $table) {
            $table->dropForeign(['dome_images_foreign_dome_id']);
            $table->dropForeign(['dome_images_foreign_league_id']);
        });
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['bookings_foreign_vendor_id']);
            $table->dropForeign(['bookings_foreign_provider_id']);
            $table->dropForeign(['bookings_foreign_dome_id']);
            $table->dropForeign(['bookings_foreign_league_id']);
            $table->dropForeign(['bookings_foreign_user_id']);
            $table->dropForeign(['bookings_foreign_sport_id']);
        });
        Schema::table('domes', function (Blueprint $table) {
            $table->dropForeign(['domes_foreign_vendor_id']);
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['users_foreign_vendor_id']);
        });
        Schema::table('dome_discounts', function (Blueprint $table) {
            $table->dropForeign(['dome_discounts_foreign_dome_id']);
        });
    }
};
