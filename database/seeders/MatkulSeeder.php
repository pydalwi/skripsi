<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class MatkulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_mk')->insert([
        ['mk_id' => 1, 'mk_nama' => 'Etika dan Profesi','sks'=> '2', 'Semester' => '2','mk_jenis' => 'T', 'mk_kategori' => 'MK Pilihan 1'],
        ['mk_id' => 2, 'mk_nama' => 'Hukum dan Kebijakan Teknologi Informasi','sks'=> '4', 'Semester' => '2','mk_jenis' => 'T', 'mk_kategori' => 'MK Pilihan 2'],
        ['mk_id' => 3, 'mk_nama' => 'Manajemen Proyek Teknologi Informasi ','sks'=> '6', 'Semester' => '3','mk_jenis' => 'T', 'mk_kategori' => 'MK Wajib'],
        ['mk_id' => 4, 'mk_nama' => 'Struktur Data','sks'=> '4', 'Semester' => '3','mk_jenis' => 'P', 'mk_kategori' => 'MK Wajib'],
        ['mk_id' => 5, 'mk_nama' => 'Algoritma Pemrograman','sks'=> '4', 'Semester' => '4','mk_jenis' => 'P', 'mk_kategori' => 'MK Wajib'],
        ['mk_id' => 6, 'mk_nama' => 'Keamanan Data dan Informasi','sks'=> '4', 'Semester' => '6','mk_jenis' => 'P', 'mk_kategori' => 'MK Wajib'],
        ['mk_id' => 7, 'mk_nama' => 'Rekayasa Perangkat Lunak','sks'=> '6', 'Semester' => '6','mk_jenis' => 'P', 'mk_kategori' => 'MK Wajib'],
    ]);
    }
}
