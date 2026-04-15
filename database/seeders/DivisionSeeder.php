<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisions = [
            [1, 'Barishal', 'বরিশাল', '22.701002', '90.353451'],
            [2, 'Chattogram', 'চট্টগ্রাম', '22.356851', '91.783182'],
            [3, 'Dhaka', 'ঢাকা', '23.810332', '90.412518'],
            [4, 'Khulna', 'খুলনা', '22.845641', '89.540328'],
            [5, 'Rajshahi', 'রাজশাহী', '24.363589', '88.624135'],
            [6, 'Rangpur', 'রংপুর', '25.743892', '89.275227'],
            [7, 'Sylhet', 'সিলেট', '24.894929', '91.868706'],
            [8, 'Mymensingh', 'ময়মনসিংহ', '24.747149', '90.420273'],
        ];

        foreach ($divisions as $division) {
            Division::create([
                'id' => $division[0],
                'name' => $division[1],
                'bn_name' => $division[2],
                'lat' => $division[3],
                'long' => $division[4],
            ]);
        }
    }
}
