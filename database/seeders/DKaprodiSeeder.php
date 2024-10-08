<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DKaprodiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('d_kaprodi')->insert([
            ['kaprodi_id' => 1, 'prodi_id' => 1,'dosen_id'=>29,'tahun'=>'2024'],
            ['kaprodi_id' => 2, 'prodi_id' => 2,'dosen_id'=>42,'tahun'=>'2024'],
            ['kaprodi_id' => 3, 'prodi_id' => 1,'dosen_id'=>83,'tahun'=>'2025'],
            ['kaprodi_id' => 4, 'prodi_id' => 2,'dosen_id'=>84,'tahun'=>'2025'],
        ]);
    }
}
