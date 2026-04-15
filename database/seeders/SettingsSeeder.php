<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        Setting::truncate();

        Setting::create([
            'company_name'         => 'InfyraSoft',
            'copyright_text'            => '© 2025 InfyraSoft. All rights reserved.',
            'description'    => 'Leading technology solutions provider in Bangladesh.',
            'registration_number'  => '123456',
            'trade_license'        => '7891011',
            'vat_number'           => '456789123',
            'contact_number'     => '+880123456789',
            'whatsapp_number'    => '+880987654321',
            'hotline_number'              => '16247',
            'email'               => 'info@qbittech.com',
            'alt_email'               => 'support@qbittech.com',
            'linkedin'             => 'https://linkedin.com/company/qbit-tech',
            'facebook'             => 'https://facebook.com/qbittech',
            'landing_page'         => 'https://qbittech.com/landing',
            'google_map'             => '<iframe src="..."></iframe>',
            'address'               => 'Dhaka, Bangladesh',
             'website'              => 'https://qbittech.com',
            'logo_dark'            => 'Qbit_Logo_Main.png',
            'logo_light'           => 'Qbit_Logo_Main.png',
            'favicon'              => 'Qbit_Logo_icon.png',
        ]);
    }
}
