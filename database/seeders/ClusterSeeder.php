<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClusterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clusters = [
            ['name' => 'MIPA'],
            ['name' => 'Ilmu Tanaman'],
            ['name' => 'Ilmu Hewani'],
            ['name' => 'Ilmu Kedokteran'],
            ['name' => 'Ilmu Kesehatan'],
            ['name' => 'Ilmu Teknik'],
            ['name' => 'Ilmu Bahasa'],
            ['name' => 'Ilmu Ekonomi'],
            ['name' => 'Ilmu Sosial Humaniora'],
            ['name' => 'Agama dan Filsafat'],
            ['name' => 'Seni, Desain, dan Media'],
            ['name' => 'Ilmu Pendidikan'],
        ];

        // Masukkan data ke dalam tabel
        DB::table('clusters')->insert($clusters);
    }
}
