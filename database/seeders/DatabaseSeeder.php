<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(0)->create();
        \App\Models\Booking::factory(0)->create();
        \App\Models\Transaction::factory(0)->create();
        \App\Models\Review::factory(0)->create();
        \App\Models\Field::factory(0)->create();
        \App\Models\Domes::factory(5)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
