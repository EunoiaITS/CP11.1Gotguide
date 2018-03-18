<?php

use Illuminate\Database\Seeder;
use App\User;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach(range(1, 30) as $index){
            User::create([
                'name' => $faker->userName,
                'email' => $faker->email,
                'password' => bcrypt('5556S!ck6'),
                'language' => $faker->languageCode,
                'dob' => $faker->date('Y-m-d', 'now'),
                'country' => $faker->century,
                'city' => $faker->city,
                'contact' => $faker->phoneNumber,
                'role' => 'traveller'
            ]);
        }
    }
}
