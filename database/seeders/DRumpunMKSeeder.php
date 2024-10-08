<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DRumpunMKSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_rumpun_mk')->insert([
            ['rumpun_mk_id' => 1, 'dosen_id' => null,'kurikulum_id'=> 2, 'rumpun_mk'=>'Sistem Informasi'],
            ['rumpun_mk_id' => 2, 'dosen_id' => null,'kurikulum_id'=> 1, 'rumpun_mk'=> 'Multimedia dan Game'],
            ['rumpun_mk_id' => 3, 'dosen_id' => null,'kurikulum_id'=> 2, 'rumpun_mk'=> 'MK Informatika Inti '],
        ]);
    }
}
