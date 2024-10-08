<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            MProdiSeeder::class,
            SDateSeeder::class,
            SGroupSeeder::class,
            SUserSeeder::class,
            SMenuSeeder::class,
            SGroupMenuSeeder::class,

            MProdiSeeder::class,
            MCplProdiSeeder::class,
            MCplSndiktiSeeder::class,
            MPeriode::class,
            DDosenSeeder::class,
            DKurikulumSeeder::class,
            DRumpunMKSeeder::class,
            DKaprodiSeeder::class,
            DKurikulumMKSeeder::class,           
            MBkSeeder::class,
        ]);
    }
}
