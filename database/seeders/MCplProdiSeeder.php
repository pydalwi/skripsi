<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class MCplProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_cpl_prodi')->insert([
            ['cpl_prodi_id' => 1, 'prodi_id' => 1, 'cpl_prodi_kode' => 'CPL03', 'cpl_prodi_kategori' => 'Sikap(S)', 'cpl_prodi_deskripsi' => 'Memiliki pengetahuan essai dengan capaian pembelajaran program studi D4 Sistem Inormasi Bisnis.'],
            ['cpl_prodi_id' => 2, 'prodi_id' => 1, 'cpl_prodi_kode' => 'CPL04', 'cpl_prodi_kategori' => 'Sikap(S)', 'cpl_prodi_deskripsi' => 'Menunjukkan sikap bertanggungjawab atas pekerjaan di bidang keahliannya secara mandiri.'],
            ['cpl_prodi_id' => 3, 'prodi_id' => 1, 'cpl_prodi_kode' => 'CPL05', 'cpl_prodi_kategori' => 'Sikap(S)', 'cpl_prodi_deskripsi' => 'Menguasai metode pengembangan produk TIK untuk memberikan solusi yang tepat melalui satu atau lebih domain aplikasi.'],
            ['cpl_prodi_id' => 4, 'prodi_id' => 1, 'cpl_prodi_kode' => 'CPL08', 'cpl_prodi_kategori' => 'Sikap(S)', 'cpl_prodi_deskripsi' => 'Mampu mengembaangkan teori dan konsep terhadap Tata Kelola TI dan '],
            ['cpl_prodi_id' => 5, 'prodi_id' => 1, 'cpl_prodi_kode' => 'CPL09', 'cpl_prodi_kategori' => 'Sikap(S)', 'cpl_prodi_deskripsi' => 'Mampu menerapkan pemikian logis, kritis, inovatif, bermutu, dan terukur dalam melakukan pekerjaan yang spesifik di bidang keahliannya serta sesuai dengan standar kompetensi kerja bidang yang bersangkutan.'],
            ['cpl_prodi_id' => 6, 'prodi_id' => 1, 'cpl_prodi_kode' => 'CPL10', 'cpl_prodi_kategori' => 'Sikap(S)', 'cpl_prodi_deskripsi' => 'Mampu menunjukkan kinerja mandiri, bermutu dan terukur. '],
            ['cpl_prodi_id' => 7, 'prodi_id' => 1, 'cpl_prodi_kode' => 'CPL11', 'cpl_prodi_kategori' => 'Sikap(S)', 'cpl_prodi_deskripsi' => 'Mampu memahami penerapan konsep Multimedia'],
            
        ]);
    }
}
