<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class MPeriode extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_periode')->insert([
            ['periode_id' => 1, 'periode_name' => '2022/2023','periode_semester' => 'Ganjil', 'is_active' => 0],
            ['periode_id' => 2, 'periode_name' => '2022/2023','periode_semester' => 'Genap', 'is_active' => 0]
        ]);
    }
}
