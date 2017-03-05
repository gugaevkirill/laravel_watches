<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Кирилл',
            'email' => 'gugaevkirill@gmail.com',
            'password' => 'admin',
            'uses_two_factor_auth' => false
        ]);
    }
}
