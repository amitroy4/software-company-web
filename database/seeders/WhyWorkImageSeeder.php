<?php

namespace Database\Seeders;

use App\Models\WhyWork;
use App\Models\WhyWorkImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class WhyWorkImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        WhyWorkImage::create([

            'image' => 'uploads/why-work/' . $faker->image('storage/app/public/uploads/why-work', 640, 480, 'business', false),



        ]);
    }
}
