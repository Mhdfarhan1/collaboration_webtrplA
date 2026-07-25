<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectTech;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Sistem Informasi Manajemen Perpustakaan',
                'project_type' => 'Web Application',
                'description' => 'Aplikasi berbasis web untuk mengelola peminjaman dan pengembalian buku di perpustakaan secara digital, dilengkapi fitur denda otomatis dan notifikasi.',
                'image_url' => 'https://ui-avatars.com/api/?name=SiPus&background=4f46e5&color=fff&size=500',
                'demo_url' => 'https://demo.sipustaka.com',
                'techs' => ['Laravel', 'Tailwind CSS', 'MySQL', 'JavaScript'],
            ],
            [
                'title' => 'Aplikasi Kasir Coffee Shop',
                'project_type' => 'Mobile Application',
                'description' => 'Point of Sales (POS) khusus untuk kedai kopi, mendukung pencetakan struk thermal bluetooth dan laporan harian.',
                'image_url' => 'https://ui-avatars.com/api/?name=Kasir+Kopi&background=0284c7&color=fff&size=500',
                'demo_url' => null,
                'techs' => ['Vue.js', 'Express', 'PostgreSQL', 'Tailwind CSS'],
            ],
            [
                'title' => 'Company Profile PT Karya Abadi',
                'project_type' => 'Web Application',
                'description' => 'Website profil perusahaan modern dilengkapi dengan animasi framer motion, form kontak dinamis, dan sistem lokalisasi dua bahasa.',
                'image_url' => 'https://ui-avatars.com/api/?name=Company+Profile&background=059669&color=fff&size=500',
                'demo_url' => 'https://karyaabadi.com',
                'techs' => ['Next.js', 'React', 'Framer Motion', 'Vercel'],
            ],
            [
                'title' => 'REST API E-Commerce Mobile',
                'project_type' => 'Mobile Application',
                'description' => 'Backend microservices untuk melayani aplikasi e-commerce mobile. Dilengkapi integrasi payment gateway dan JWT authentication terpusat.',
                'image_url' => 'https://ui-avatars.com/api/?name=API+Rest&background=e11d48&color=fff&size=500',
                'demo_url' => 'https://api.docs.example.com',
                'techs' => ['Node.js', 'Go', 'Redis', 'Docker', 'MongoDB'],
            ],
            [
                'title' => 'Dashboard Logistik Tracking System',
                'project_type' => 'IoT & Hardware',
                'description' => 'Dashboard analitik interaktif untuk melacak dan memvisualisasikan rute armada logistik dengan integrasi Mapbox secara real-time.',
                'image_url' => 'https://ui-avatars.com/api/?name=Logis+Track&background=d97706&color=fff&size=500',
                'demo_url' => 'https://track.logistics.io',
                'techs' => ['React', 'TypeScript', 'Mapbox GL', 'Firebase'],
            ],
        ];

        foreach ($projects as $proj) {
            $createdProject = Project::create([
                'title' => $proj['title'],
                'project_type' => $proj['project_type'] ?? 'Web Application',
                'description' => $proj['description'],
                'image_url' => $proj['image_url'],
                'demo_url' => $proj['demo_url'],
            ]);

            foreach ($proj['techs'] as $tech) {
                ProjectTech::create([
                    'project_id' => $createdProject->project_id,
                    'tech_name' => $tech,
                ]);
            }
        }
    }
}
