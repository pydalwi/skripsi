<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class MCplIndikatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_cpl_indikator')->insert([
            ['cpl_indikator_id' => 1, 'prodi_id' => 1, 'cpl_indikator_kode' => '1.1', 'cpl_prodi_id' => '1', 'cpl_indikator_kinerja' => 'Mahasiswa mampu menunjukkan perilaku yang sesuai dengan ajaran agama dalam kehidupan sehari-hari'],
            ['cpl_indikator_id' => 2, 'prodi_id' => 1, 'cpl_indikator_kode' => '2.1', 'cpl_prodi_id' => '2', 'cpl_indikator_kinerja' => 'Mahasiswa mampu menggunakan konsep dasar TI dan metode matematika terapan dalam menyelesaikan masalah'],
            ['cpl_indikator_id' => 3, 'prodi_id' => 1, 'cpl_indikator_kode' => '3.1', 'cpl_prodi_id' => '3', 'cpl_indikator_kinerja' => 'Mampu mengimplementasikan prinsip-prinsip manajemen'],
            ['cpl_indikator_id' => 4, 'prodi_id' => 1, 'cpl_indikator_kode' => '4.1', 'cpl_prodi_id' => '4', 'cpl_indikator_kinerja' => 'Mampu menyusun dokumen teknis yang menjelaskan proses dan hasil implementasi teknologi, lengkap dengan metodologi, analisis data, dan kesimpulan'],
            ['cpl_indikator_id' => 5, 'prodi_id' => 1, 'cpl_indikator_kode' => '5.1', 'cpl_prodi_id' => '5', 'cpl_indikator_kinerja' => 'Mahasiswa mampu menganalisis permasalahan komputasi yang kompleks dan mengidentifikasi algoritma yang paling sesuai untuk menyelesaikannya'],
            ['cpl_indikator_id' => 6, 'prodi_id' => 1, 'cpl_indikator_kode' => '6.1', 'cpl_prodi_id' => '6', 'cpl_indikator_kinerja' => 'Mahasiswa mampu memanfaatkan pengetahuan dasar TIK terkait sistem operasi serta konsep dan metode komunikasi jaringan komputer secara mendalam dalam merancang dan mengimplementasikan infrastruktur teknologi informasi'],
            ['cpl_indikator_id' => 7, 'prodi_id' => 1, 'cpl_indikator_kode' => '7.1', 'cpl_prodi_id' => '7', 'cpl_indikator_kinerja' => 'Mahasiswa mampu mengimplementasikan desain perangkat lunak yang telah dirancang, melakukan pengujian untuk memastikan kualitas, serta melakukan deployment dan pemeliharaan perangkat lunak sesuai dengan standar industri'],
           
        ]);
    }
}
