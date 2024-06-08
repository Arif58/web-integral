<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $universities = [
            ['id' => 1, 'name' => 'UNIVERSITAS SYIAH KUALA'],
            ['id' => 2, 'name' => 'UNIVERSITAS MALIKUSSALEH'],
            ['id' => 3, 'name' => 'UNIVERSITAS TEUKU UMAR'],
            ['id' => 4, 'name' => 'UNIVERSITAS SAMUDRA'],
            ['id' => 5, 'name' => 'ISBI ACEH'],
            ['id' => 6, 'name' => 'UNIVERSITAS SUMATERA UTARA'],
            ['id' => 7, 'name' => 'UNIVERSITAS NEGERI MEDAN'],
            ['id' => 8, 'name' => 'UNIVERSITAS RIAU'],
            ['id' => 9, 'name' => 'UNIVERSITAS MARITIM RAJA ALI HAJI'],
            ['id' => 10, 'name' => 'UNIVERSITAS ANDALAS'],
            ['id' => 11, 'name' => 'UNIVERSITAS NEGERI PADANG'],
            ['id' => 12, 'name' => 'ISI PADANG PANJANG'],
            ['id' => 13, 'name' => 'UNIVERSITAS JAMBI'],
            ['id' => 14, 'name' => 'UNIVERSITAS BENGKULU'],
            ['id' => 15, 'name' => 'UNIVERSITAS SRIWIJAYA'],
            ['id' => 16, 'name' => 'UNIVERSITAS BANGKA BELITUNG'],
            ['id' => 17, 'name' => 'UNIVERSITAS LAMPUNG'],
            ['id' => 18, 'name' => 'INSTITUT TEKNOLOGI SUMATERA'],
            ['id' => 19, 'name' => 'UNIVERSITAS SULTAN AGENG TIRTAYASA'],
            ['id' => 20, 'name' => 'UNIVERSITAS INDONESIA'],
            ['id' => 21, 'name' => 'UNIVERSITAS NEGERI JAKARTA'],
            ['id' => 22, 'name' => 'UPN "VETERAN" JAKARTA'],
            ['id' => 23, 'name' => 'UNIVERSITAS SINGAPERBANGSA KARAWANG'],
            ['id' => 24, 'name' => 'INSTITUT TEKNOLOGI BANDUNG'],
            ['id' => 25, 'name' => 'UNIVERSITAS PADJADJARAN'],
            ['id' => 26, 'name' => 'UNIVERSITAS PENDIDIKAN INDONESIA'],
            ['id' => 27, 'name' => 'ISBI BANDUNG'],
            ['id' => 28, 'name' => 'INSTITUT PERTANIAN BOGOR'],
            ['id' => 29, 'name' => 'UNIVERSITAS SILIWANGI'],
            ['id' => 30, 'name' => 'UNIVERSITAS JENDERAL SOEDIRMAN'],
            ['id' => 31, 'name' => 'UNIVERSITAS TIDAR'],
            ['id' => 32, 'name' => 'UNIVERSITAS SEBELAS MARET'],
            ['id' => 33, 'name' => 'ISI SURAKARTA'],
            ['id' => 34, 'name' => 'UNIVERSITAS DIPONEGORO'],
            ['id' => 35, 'name' => 'UNIVERSITAS NEGERI SEMARANG'],
            ['id' => 36, 'name' => 'UNIVERSITAS GADJAH MADA'],
            ['id' => 37, 'name' => 'UNIVERSITAS NEGERI YOGYAKARTA'],
            ['id' => 38, 'name' => 'UPN "VETERAN" YOGYAKARTA'],
            ['id' => 39, 'name' => 'ISI YOGYAKARTA'],
            ['id' => 40, 'name' => 'UNIVERSITAS JEMBER'],
            ['id' => 41, 'name' => 'UNIVERSITAS BRAWIJAYA'],
            ['id' => 42, 'name' => 'UNIVERSITAS NEGERI MALANG'],
            ['id' => 43, 'name' => 'UNIVERSITAS AIRLANGGA'],
            ['id' => 44, 'name' => 'INSTITUT TEKNOLOGI SEPULUH NOPEMBER'],
            ['id' => 45, 'name' => 'UNIVERSITAS NEGERI SURABAYA'],
            ['id' => 46, 'name' => 'UNIVERSITAS TRUNOJOYO MADURA'],
            ['id' => 47, 'name' => 'UPN "VETERAN" JAWA TIMUR'],
            ['id' => 48, 'name' => 'UNIVERSITAS TANJUNGPURA'],
            ['id' => 49, 'name' => 'UNIVERSITAS PALANGKARAYA'],
            ['id' => 50, 'name' => 'UNIVERSITAS LAMBUNG MANGKURAT'],
            ['id' => 51, 'name' => 'UNIVERSITAS MULAWARMAN'],
            ['id' => 52, 'name' => 'INSTITUT TEKNOLOGI KALIMANTAN'],
            ['id' => 53, 'name' => 'UNIVERSITAS BORNEO TARAKAN'],
            ['id' => 54, 'name' => 'UNIVERSITAS UDAYANA'],
            ['id' => 55, 'name' => 'UNIVERSITAS PENDIDIKAN GANESHA'],
            ['id' => 56, 'name' => 'ISI DENPASAR'],
            ['id' => 57, 'name' => 'UNIVERSITAS MATARAM'],
            ['id' => 58, 'name' => 'UNIVERSITAS NUSA CENDANA'],
            ['id' => 59, 'name' => 'UNIVERSITAS TIMOR'],
            ['id' => 60, 'name' => 'UNIVERSITAS HASANUDDIN'],
            ['id' => 61, 'name' => 'UNIVERSITAS NEGERI MAKASSAR'],
            ['id' => 62, 'name' => 'INSTITUT TEKNOLOGI BJ. HABIBIE SULAWESI SELATAN'],
            ['id' => 63, 'name' => 'UNIVERSITAS SAM RATULANGI'],
            ['id' => 64, 'name' => 'UNIVERSITAS NEGERI MANADO'],
            ['id' => 65, 'name' => 'UNIVERSITAS TADULAKO'],
            ['id' => 66, 'name' => 'UNIVERSITAS SULAWESI BARAT'],
            ['id' => 67, 'name' => 'UNIVERSITAS HALUOLEO'],
            ['id' => 68, 'name' => 'UNIVERSITAS NEGERI GORONTALO'],
            ['id' => 69, 'name' => 'UNIVERSITAS SEMBILAN BELAS NOVEMBER KOLAKA'],
            ['id' => 70, 'name' => 'UNIVERSITAS PATTIMURA'],
            ['id' => 71, 'name' => 'UNIVERSITAS KHAIRUN'],
            ['id' => 72, 'name' => 'UNIVERSITAS CENDERAWASIH'],
            ['id' => 73, 'name' => 'UNIVERSITAS MUSAMUS MERAUKE'],
            ['id' => 74, 'name' => 'ISBI TANAH PAPUA'],
            ['id' => 75, 'name' => 'UNIVERSITAS PAPUA'],
        ];

        // Insert data universitas ke dalam tabel 'universities'
        DB::table('universities')->insert($universities);
    }
}
