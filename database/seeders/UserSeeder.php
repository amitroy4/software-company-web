<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $faker = Faker::create();
        User::create([
            'name' => 'Masud Ahmed',
            'username' => 'superadmin',
            'is_superadmin' => '1',
            'status' => '1',
            'password' => Hash::make('12345678'),
        ]);
    }
}
