<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HeroMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function up(): void
    {
        // Add sample hero data
        DB::table('hero_media')->insert([
            [
                'hero_title' => 'Selamat Datang di TRPL',
                'image_url' => 'assets/img/hero1.jpg', // dummy path for now
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'hero_title' => 'Teknologi Rekayasa Perangkat Lunak',
                'image_url' => 'assets/img/hero2.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
