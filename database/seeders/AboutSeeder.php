<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        About::create([
            'title' => $faker->sentence,
            'sub_title' => $faker->sentence,
            'description' => $faker->paragraph,
            'image' => 'uploads/about-image/' . $faker->image('storage/app/public/uploads/about-image', 640, 480, 'business', false),



        ]);
    }
}
