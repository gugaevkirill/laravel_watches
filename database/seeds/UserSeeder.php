<?php

use App\User;
use Illuminate\Database\Seeder;

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
            'password' => 'pass@word56',
            'uses_two_factor_auth' => false
        ]);
    }
}
