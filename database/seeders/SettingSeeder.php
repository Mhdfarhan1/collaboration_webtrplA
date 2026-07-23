<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // === Siapa Kami ===
            [
                'key'   => 'about_class_name',
                'value' => 'TRPL A Pagi',
                'label' => 'Nama Kelas',
                'group' => 'siapa_kami',
                'type'  => 'text',
            ],
            [
                'key'   => 'about_description',
                'value' => 'adalah kelas unggulan (howak) Rekayasa Perangkat Lunak di',
                'label' => 'Deskripsi Kelas',
                'group' => 'siapa_kami',
                'type'  => 'textarea',
            ],
            [
                'key'   => 'about_university',
                'value' => 'Politeknik Negeri Batam',
                'label' => 'Nama Universitas',
                'group' => 'siapa_kami',
                'type'  => 'text',
            ],
            [
                'key'   => 'about_focus_keyword',
                'value' => 'Software Development',
                'label' => 'Kata Kunci Fokus (bold kuning)',
                'group' => 'siapa_kami',
                'type'  => 'text',
            ],
            [
                'key'   => 'about_tagline',
                'value' => 'kolaborasi tim, dan manajemen proyek modern.',
                'label' => 'Tagline Tambahan',
                'group' => 'siapa_kami',
                'type'  => 'text',
            ],

            // === Hero Section ===
            [
                'key'   => 'hero_subtitle',
                'value' => 'Software Engineering Class',
                'label' => 'Subtitle Hero',
                'group' => 'hero',
                'type'  => 'text',
            ],
            [
                'key'   => 'hero_description',
                'value' => 'Part of Prodi TRPL • Politeknik Negeri Batam',
                'label' => 'Deskripsi Hero',
                'group' => 'hero',
                'type'  => 'text',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
