<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MProfillulusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_prodi')->insert([
            ['pl_id' => 1,'kode_pl'=> 'PL01(S)', 'deskripsi_pl'=> 'Lulusan berkomitmen untuk selalu bertakwa kepada Tuhan Yang Maha Esa senantiasa mengembangkan diri melalui pembelajaran seumur hidup dan mematuhi aspek hukum sosial budaya serta etika profesi','prodi_id' => 1 ],
            ['pl_id' => 2,'kode_pl'=> 'PL02(P)', 'deskripsi_pl'=> 'Lulusan memiliki kemampuan menganalisis, mendesain, mengimplementasi dan mengevaluasi solusi berbasis komputasi untuk menyelesaikan permasalahan dan memenuhi kebutuhan pengguna dengan pendekatan yang sesuai','prodi_id' => 1 ],
            ['pl_id' => 3,'kode_pl'=> 'PL03(KU)', 'deskripsi_pl'=> 'Lulusan memiliki kemampuan komunikasi efektif, kepemimpinan, kerjasama tim, pemecahan masalah, serta pengambilan keputusan, yang mendukung dalam menyelesaikan, mengawasi, dan mengevaluasi kinerja tim','prodi_id' => 1 ],
            ['pl_id' => 4,'kode_pl'=> 'PL04(KK)', 'deskripsi_pl'=> 'Lulusan mampu menerapkan pengetahuan dalam pelaksanaan proyek informatika/ilmu komputer, termasuk keterampilan pemrograman, pengembangan perangkat lunak, analisis data, manajemen proyek, dan manajemen jaringan','prodi_id' => 1 ],
           
        ]);
    }
}
