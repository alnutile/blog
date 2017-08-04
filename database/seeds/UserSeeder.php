<?php

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
        if (env('YO') && env('YOP')) {
            factory(\App\User::class)->create(
                [
                    'email' => env("YO"),
                    'password' => bcrypt(env("YOP"))
                ]
            );
        }
    }
}
