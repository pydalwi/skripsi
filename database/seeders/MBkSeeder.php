<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MBkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_bahan_kajian')->insert([
            ['bk_id' => 1, 'prodi_id' => 2, 'bk_kategori' => 'A Penciri Utama Bidang Informatika/Ilmu Komputer', 'bk_deskripsi' => 'Konsep Tata Kelola Teknologi Informasi'],
            ['bk_id' => 2, 'prodi_id' => 2, 'bk_kategori' => 'A Penciri Utama Bidang Informatika/Ilmu Komputer', 'bk_deskripsi' => 'Konsep Tata Kelola Sistem Informasi Bisnis'],
            ['bk_id' => 3, 'prodi_id' => 2, 'bk_kategori' => 'A Penciri Utama Bidang Informatika/Ilmu Komputer', 'bk_deskripsi' => 'Elemen dan Tujuan Tata Kelola Teknologi Informasi'],
            ['bk_id' => 4, 'prodi_id' => 2, 'bk_kategori' => 'A Penciri Utama Bidang Informatika/Ilmu Komputer', 'bk_deskripsi' => 'Kerangka Kerja dan Standard Tata Kelola'],
            ['bk_id' => 5, 'prodi_id' => 2, 'bk_kategori' => 'A Penciri Utama Bidang Informatika/Ilmu Komputer', 'bk_deskripsi' => 'COBIT and the IT Governance Institute'],
            ['bk_id' => 6, 'prodi_id' => 2, 'bk_kategori' => 'A Penciri Utama Bidang Informatika/Ilmu Komputer', 'bk_deskripsi' => 'ITIL and IT Service Management Guidance'],
            ['bk_id' => 7, 'prodi_id' => 2, 'bk_kategori' => 'A Penciri Utama Bidang Informatika/Ilmu Komputer', 'bk_deskripsi' => 'IT Governance Standards : ISO 9001, 27002, and 38500 '],

        ]);
    }
}
