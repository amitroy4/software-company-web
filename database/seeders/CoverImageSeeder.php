<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CoverImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CoverImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        CoverImage::create([
            'page_name' => 'explore_qBit_tech',
            'cover_image' => null,
            'status' => true,
        ]);


        CoverImage::create([
            'page_name' => 'solutions',
            'cover_image' => null,
            'status' => true,
        ]);

        CoverImage::create([
            'page_name' => 'products',
            'cover_image' => null,
            'status' => true,
        ]);

        CoverImage::create([
            'page_name' => 'gallery',
            'cover_image' => null,
            'status' => true,
        ]);

        CoverImage::create([
            'page_name' => 'news',
            'cover_image' => null,
            'status' => true,
        ]);

        CoverImage::create([
            'page_name' => "let's_connect",
            'cover_image' => null,
            'status' => true,
        ]);

        CoverImage::create([
            'page_name' => "contact_us",
            'cover_image' => null,
            'status' => true,
        ]);
        CoverImage::create([
            'page_name' => "career",
            'cover_image' => null,
            'status' => true,
        ]);
    }
}
