<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CallToAction;
use App\Models\CoaAccountType;
use App\Models\District;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            DivisionSeeder::class,
            DistrictSeeder::class,
            UpazilaSeeder::class,
            RolePermissionSeeder::class,
            AboutSeeder::class,
            SettingsSeeder::class,
            SliderCounterSeeder::class,
            CallToActionSeeder::class,
            WhyWorkImageSeeder::class,


        ]);
    }
}
