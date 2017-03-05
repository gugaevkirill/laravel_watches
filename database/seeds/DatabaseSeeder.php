<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\App\User::all()->isEmpty()) {
            $this->call(UserSeeder::class);
        }
    }
}
