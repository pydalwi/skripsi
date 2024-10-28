<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class MCplSndiktiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_cpl_sndikti')->insert([
            ['cpl_sndikti_id' => 1, 'prodi_id' => 1, 'cpl_sndikti_kode' => 'CPLS01', 'cpl_sndikti_kategori' => 'Sikap(S)', 'cpl_sndikti_deskripsi' => 'Bertakwa kepada Tuhan Yang Maha Esa dan mampu menunjukkan sikap religious.'],
            ['cpl_sndikti_id' => 2, 'prodi_id' => 1, 'cpl_sndikti_kode' => 'CPLS02', 'cpl_sndikti_kategori' => 'Sikap(S)', 'cpl_sndikti_deskripsi' => 'Menjunjung tinggi nilai kemanusiaan dalam menjalankan tugas berdasarkan agama, moral dan etika.'],
            ['cpl_sndikti_id' => 3, 'prodi_id' => 1, 'cpl_sndikti_kode' => 'CPLS03', 'cpl_sndikti_kategori' => 'Sikap(S)', 'cpl_sndikti_deskripsi' => 'Menguasai metode pengembangan produk TIK untuk memberikan solusi yang tepat melalui satu atau lebih domain aplikasi.'],
            ['cpl_sndikti_id' => 4, 'prodi_id' => 1, 'cpl_sndikti_kode' => 'CPLS04', 'cpl_sndikti_kategori' => 'Sikap(S)', 'cpl_sndikti_deskripsi' => 'Berkontribusi dalam peningkatan mutu kehidupan bermasyarakat, berbangsa,dan bernegara berdasarkan Pancasila.'],
            ['cpl_sndikti_id' => 5, 'prodi_id' => 1, 'cpl_sndikti_kode' => 'CPLS05', 'cpl_sndikti_kategori' => 'Sikap(S)', 'cpl_sndikti_deskripsi' => 'Mampu mengembaangkan teori dan konsep terhadap Tata Kelola TI dan '],
            ['cpl_sndikti_id' => 6, 'prodi_id' => 1, 'cpl_sndikti_kode' => 'CPLS06', 'cpl_sndikti_kategori' => 'Sikap(S)', 'cpl_sndikti_deskripsi' => 'Mampu menerapkan pemikian logis, kritis, inovatif, bermutu, dan terukur dalam melakukan pekerjaan yang spesifik di bidang keahliannya serta sesuai dengan standar kompetensi kerja bidang yang bersangkutan.'],
            ['cpl_sndikti_id' => 7, 'prodi_id' => 1, 'cpl_sndikti_kode' => 'CPLS07', 'cpl_sndikti_kategori' => 'Sikap(S)', 'cpl_sndikti_deskripsi' => 'Mampu menunjukkan kinerja mandiri, bermutu dan terukur. '],
           
        ]);

    }
}
