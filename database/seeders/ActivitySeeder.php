<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\ActivityMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activities = [
            [
                'activity_name' => 'Malam Keakraban Kelas (MAKRAB) 2026',
                'activity_description' => 'Kegiatan rutin untuk menyambut mahasiswa baru dan mempererat tali silaturahmi antar anggota kelas. Berlokasi di Villa Puncak.',
                'activity_image' => 'https://ui-avatars.com/api/?name=Makrab&color=fff&background=4f46e5&size=512',
                'media' => [
                    'https://ui-avatars.com/api/?name=Foto+1&color=fff&background=6366f1&size=512',
                    'https://ui-avatars.com/api/?name=Foto+2&color=fff&background=8b5cf6&size=512',
                    'https://ui-avatars.com/api/?name=Foto+3&color=fff&background=d946ef&size=512',
                ]
            ],
            [
                'activity_name' => 'Kunjungan Industri TechCorp',
                'activity_description' => 'Melihat langsung proses pengembangan perangkat lunak berskala besar di kantor pusat TechCorp Jakarta.',
                'activity_image' => 'https://ui-avatars.com/api/?name=Kunjungan&color=fff&background=0284c7&size=512',
                'media' => [
                    'https://ui-avatars.com/api/?name=Tech+1&color=fff&background=0ea5e9&size=512',
                    'https://ui-avatars.com/api/?name=Tech+2&color=fff&background=38bdf8&size=512',
                ]
            ],
            [
                'activity_name' => 'Workshop UI/UX Design',
                'activity_description' => 'Pelatihan internal kelas mengenai dasar-dasar UI/UX Design menggunakan Figma yang diisi oleh praktisi desain.',
                'activity_image' => 'https://ui-avatars.com/api/?name=UI+UX&color=fff&background=ea580c&size=512',
                'media' => [
                    'https://ui-avatars.com/api/?name=Workshop+1&color=fff&background=f97316&size=512',
                    'https://ui-avatars.com/api/?name=Workshop+2&color=fff&background=fb923c&size=512',
                    'https://ui-avatars.com/api/?name=Workshop+3&color=fff&background=fdba74&size=512',
                    'https://ui-avatars.com/api/?name=Workshop+4&color=fff&background=fed7aa&size=512',
                ]
            ]
        ];

        foreach ($activities as $data) {
            $activity = Activity::create([
                'activity_name' => $data['activity_name'],
                'activity_description' => $data['activity_description'],
                'activity_image' => $data['activity_image'],
            ]);

            foreach ($data['media'] as $mediaUrl) {
                ActivityMedia::create([
                    'activity_id' => $activity->activity_id,
                    'activity_media_url' => $mediaUrl,
                    'activity_media_is_thumbnail' => false,
                ]);
            }
        }
    }
}
