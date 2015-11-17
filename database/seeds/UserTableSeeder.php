<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \Fb\User();
        $user->name="admin";
        $user->email="john.doe@gmail.com";
        $user->password=bcrypt("password");
        $user->save();
    }
}
