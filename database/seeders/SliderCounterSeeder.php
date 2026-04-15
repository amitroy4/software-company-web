<?php

namespace Database\Seeders;

use App\Models\SliderCounter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class SliderCounterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        SliderCounter::create([
            'counter_title' => $faker->sentence,
           'data_count' => $faker->numberBetween(1, 1000),
        ]);
    }
}
