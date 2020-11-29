<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Fuad Muhammad N',
            'username' => 'fuadmhnr',
            'password' => bcrypt('melodyjkt48'),
            'email' => 'fuadmhnr@gmail.com'
        ]);
    }
}
