<?php

use Quill\User;
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
        User::truncate();

        User::create([
            'username' => 'terry',
            'email' => 'contact@terryharvey.co.uk',
            'password' => bcrypt('password')
        ]);

        factory(User::class, 10)->create();
    }
}
