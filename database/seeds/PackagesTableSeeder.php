<?php

use Illuminate\Database\Seeder;
use App\packages;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class PackagesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach(range(1, 30) as $index){
            packages::create([
                'agent_id' => $faker->numberBetween($min = 1, $max = 5),
                'package_name' => $faker->paragraph($nbSentences = 1),
                'package_details' => $faker->paragraph($nbSentences = 3),
                'available_date' => $faker->date('Y-m-d', 'now')
            ]);
        }
    }
}
