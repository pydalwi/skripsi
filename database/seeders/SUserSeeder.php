<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('s_user')->insert([
            [
                'user_id'   => 1, // Super Admin
                'group_id'  => 1, // Super Admin
                'username'  => 'superadmin',
                'name'      => 'Super Administrator',
                'email'     => 'super@admin.com',
                'password'  => password_hash('12345', PASSWORD_DEFAULT),
            ],
            ['user_id' => 2, 'group_id'=> 2,'username'  => 'zawaruddin', 'name' => 'Moch Zawaruddin Abdullah, S.ST., M.Kom.', 'email'=> 'zawaruddin@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 3, 'group_id'=> 2,'username'  => 'yoppyyunhasnawa','name' => 'Yoppy Yunhasnawa, S.ST., M.Sc.','email'=> 'yoppyyunhasnawa@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 4, 'group_id'=> 2,'username'  => 'habibieeddien', 'name' => 'Habibie Ed Dien, S.Kom., M.T.', 'email'=> 'habibieeddien@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 5, 'group_id'=> 2,'username'  => 'noprianto', 'name' => 'Noprianto, S.Kom., M.Eng', 'email'=> 'noprianto@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 6, 'group_id'=> 2,'username'  => 'hasyimratsanjani', 'name' => 'M. Hasyim ratsanjani, S.Kom., M.Kom.', 'email'=> 'hasyimratsanjani@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 7, 'group_id'=> 2,'username'  => 'adeismail', 'name' => 'Ade Ismail S.Kom., M.TI', 'email'=> 'adeismail@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 8, 'group_id'=> 2,'username'  => 'adevianfairuz', 'name' => 'Adevian Fairuz Pratama, S.ST, M.Eng', 'email'=> 'adevianfairuz@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 9, 'group_id'=> 2,'username'  => 'agungnugroho', 'name' => 'Agung Nugroho Pramudhita, S.T., M.T.', 'email'=> 'agungnugroho@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 10, 'group_id'=> 2,'username'  => 'ahmadiyuli', 'name' => 'Ahmadi Yuli Ananta, ST., M.M.', 'email'=> 'ahmadiyuli@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 11, 'group_id'=> 2,'username'  => 'annisapuspa', 'name' => 'Annisa Puspa Kirana, S. Kom, M.Kom', 'email'=> 'annisapuspa@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 12, 'group_id'=> 2,'username'  => 'annisataufika', 'name' => 'Annisa Taufika Firdausi, ST., MT.', 'email'=> 'annisataufika@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 13, 'group_id'=> 2,'username'  => 'anugrahnur', 'name' => 'Anugrah Nur Rahmanto, S.Sn., M.Ds.', 'email'=> 'anugrahnur@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 14, 'group_id'=> 2,'username'  => 'ariadiretno', 'name' => 'Ariadi Retno Tri Hayati Ririd, S.Kom., M.Kom.', 'email'=> 'ariadiretno@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 15, 'group_id'=> 2,'username'  => 'arierachmad', 'name' => 'Arie Rachmad Syulistyo, S.Kom., M.Kom', 'email'=> 'arierachmad@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 16, 'group_id'=> 2,'username'  => 'ariefprasetyo', 'name' => 'Arief Prasetyo, S.Kom., M.Kom., M.Pd.', 'email'=> 'ariefprasetyo@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 17, 'group_id'=> 2,'username'  => 'astifidharahma', 'name' => 'Astrifidha Rahma Amalia,S.Pd., M.Pd.', 'email'=> 'astifidharahma@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 18, 'group_id'=> 2,'username'  => 'atiqahnurul', 'name' => 'Atiqah Nurul Asri, S.Pd., M.Pd.', 'email'=> 'atiqahnurul@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 19, 'group_id'=> 2,'username'  => 'bagassatya', 'name' => 'Bagas Satya Dian Nugraha, ST., MT.', 'email'=> 'bagassatya@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 20, 'group_id'=> 2,'username'  => 'bannisasatria', 'name' => 'Dr.Eng. Banni Satria Andoko, S. Kom., M.MSI.', 'email'=> 'bannisasatria@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 21, 'group_id'=> 2,'username'  => 'budiharijanto', 'name' => 'Budi Harijanto, ST., M.MKom.', 'email'=> 'budiharijanto@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 22, 'group_id'=> 2,'username'  => 'cahyarahmad', 'name' => 'Cahya Rahmad, ST., M.Kom., Dr. Eng., Prof.', 'email'=> 'cahyarahmad@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 23, 'group_id'=> 2,'username'  => 'candrabella', 'name' => 'Candra Bella Vista, S.Kom., MT.', 'email'=> 'candrabella@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 24, 'group_id'=> 2,'username'  => 'candrasena', 'name' => 'Candrasena Setiadi, ST., M.MT', 'email'=> 'candrasena@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 25, 'group_id'=> 2,'username'  => 'deddykusbianto', 'name' => 'Deddy Kusbianto PA, Ir., M.Mkom.', 'email'=> 'deddykusbianto@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 26, 'group_id'=> 2,'username'  => 'dhebyssuryani', 'name' => 'Dhebys Suryani, S.Kom., MT', 'email'=> 'dhebyssuryani@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 27, 'group_id'=> 2,'username'  => 'dianhanifudin', 'name' => 'Dian Hanifudin Subhi, S.Kom., M.Kom.', 'email'=> 'dianhanifudin@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 28, 'group_id'=> 2,'username'  => 'dikarizky', 'name' => 'Dika Rizky Yunianto, S.Kom, M.Kom', 'email'=> 'dikarizky@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 29, 'group_id'=> 2,'username'  => 'dimaswahyu', 'name' => 'Dimas Wahyu Wibowo, ST., MT.', 'email'=> 'dimaswahyu@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 30, 'group_id'=> 4,'username'  => 'elysetyo', 'name' => 'Dr. Ely Setyo Astuti, S.T., M.T.', 'email'=> 'elysetyo@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 31, 'group_id'=> 2,'username'  => 'rakhmatarianto', 'name' => 'Dr. Rakhmat Arianto, S.ST., M.Kom.', 'email'=> 'rakhmatarianto@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 32, 'group_id'=> 2,'username'  => 'ulladelfana', 'name' => 'Dr. Ulla Delfana Rosiani, ST., MT.', 'email'=> 'ulladelfana@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 33, 'group_id'=> 2,'username'  => 'dwipuspitasari', 'name' => 'Dwi Puspitasari, S.Kom., M.Kom.', 'email'=> 'dwipuspitasari@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 34, 'group_id'=> 2,'username'  => 'ekalarasati', 'name' => 'Eka Larasati Amalia, S.ST., MT.', 'email'=> 'ekalarasati@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 35, 'group_id'=> 2,'username'  => 'ekojono', 'name' => 'Ekojono, ST., M.Kom.', 'email'=> 'ekojono@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 36, 'group_id'=> 2,'username'  => 'eloknur', 'name' => 'Elok Nur Hamdana, S.T., M.T', 'email'=> 'eloknur@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 37, 'group_id'=> 2,'username'  => 'endahsepta', 'name' => 'Endah Septa Sintiya. SPd., MKom.', 'email'=> 'endahsepta@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 38, 'group_id'=> 2,'username'  => 'erfanrohadi', 'name' => 'Erfan Rohadi, ST., M.Eng., Ph.D.', 'email'=> 'erfanrohadi@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 39, 'group_id'=> 2,'username'  => 'faizushbah', 'name' => 'Faiz Ushbah Mubarok, S.Pd., M.Pd.', 'email'=> 'faizushbah@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 40, 'group_id'=> 2,'username'  => 'faridangga', 'name' => 'Farid Angga Pribadi, S.Kom.,M.Kom', 'email'=> 'faridangga@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 41, 'group_id'=> 2,'username'  => 'faridaulfa', 'name' => 'Farida Ulfa, S.Pd., M.Pd.', 'email'=> 'faridaulfa@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 42, 'group_id'=> 2,'username'  => 'gunawanbudi', 'name' => 'Gunawan Budi Prasetyo, ST., MMT., Ph.D.', 'email'=> 'gunawanbudi@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 43, 'group_id'=> 4,'username'  => 'hendrapradibta', 'name' => 'Hendra Pradibta, SE., M.Sc.', 'email'=> 'hendrapradibta@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 44, 'group_id'=> 2,'username'  => 'ikakusumaning', 'name' => 'Ika Kusumaning Putri, MT.', 'email'=> 'ikakusumaning@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 45, 'group_id'=> 2,'username'  => 'imamfahrur', 'name' => 'Imam Fahrur Rozi, ST., MT.', 'email'=> 'imamfahrur@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 46, 'group_id'=> 2,'username'  => 'indradarma', 'name' => 'Indra Dharma Wijaya, ST., M.MT.', 'email'=> 'indradarma@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 47, 'group_id'=> 2,'username'  => 'irsyadarif', 'name' => 'Irsyad Arif Mashudi, M.Kom', 'email'=> 'irsyadarif@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 48, 'group_id'=> 2,'username'  => 'kadeksuarjuna', 'name' => 'Kadek Suarjuna Batubulan, S.Kom, MT', 'email'=> 'kadeksuarjuna@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 49, 'group_id'=> 2,'username'  => 'luqmanaffandi', 'name' => 'Luqman Affandi, S.Kom., MMSI', 'email'=> 'luqmanaffandi@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 50, 'group_id'=> 3,'username'  => 'mamluatulhaniah', 'name' => "Mamluatul Hani'ah, S.Kom., M.Kom.", 'email'=> 'mamluatulhaniah@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 51, 'group_id'=> 2,'username'  => 'arwindatumaya', 'name' => 'Marsma TNI Dr. Ir. Arwin Datumaya Wahyudi Sumari, S.T., M.T., IPU, ASEAN Eng., ACPE', 'email'=> 'arwindatumaya@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 52, 'group_id'=> 3,'username'  => 'meytieka', 'name' => 'Meyti Eka Apriyani ST., MT.', 'email'=> 'meytieka@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 53, 'group_id'=> 2,'username'  => 'milyunnima', 'name' => 'Milyun Nima Shoumi, S.Kom., M.Kom', 'email'=> 'milyunnima@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 54, 'group_id'=> 2,'username'  => 'afifhendrawan', 'name' => 'Muhammad Afif Hendrawan., S.Kom., M.T.', 'email'=> 'afifhendrawan@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 55, 'group_id'=> 2,'username'  => 'shulhankhairy', 'name' => 'Muhammad Shulhan Khairy, S.Kom, M.Kom', 'email'=> 'shulhankhairy@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 56, 'group_id'=> 2,'username'  => 'unggulopamenang', 'name' => 'Muhammad Unggul Pamenang, S.St., M.T.','email'=> 'unggulopamenang@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 57, 'group_id'=> 2,'username'  => 'mungkiastiningrum', 'name' => 'Mungki Astiningrum, ST., M.Kom.', 'email'=> 'mungkiastiningrum@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 58, 'group_id'=> 2,'username'  => 'mustikamentari', 'name' => 'Mustika Mentari, S.Kom., M.Kom', 'email'=> 'mustikamentari@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 59, 'group_id'=> 2,'username'  => 'muthrofin', 'name' => 'Muthrofin', 'email'=> 'muthrofin@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 60, 'group_id'=> 2,'username'  => 'pramanayoga', 'name' => 'Pramana Yoga Saputra, S.Kom., MMT.', 'email'=> 'pramanayoga@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 61, 'group_id'=> 2,'username'  => 'putraprima', 'name' => 'Putra Prima A., ST., M.Kom.', 'email'=> 'putraprima@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 62, 'group_id'=> 2,'username'  => 'retnodamayanti', 'name' => 'Retno Damayanti, S.Pd., M.T.', 'email'=> 'retnodamayanti@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 63, 'group_id'=> 2,'username'  => 'ridwanrismanto', 'name' => 'Ridwan Rismanto, SST., M.Kom.', 'email'=> 'ridwanrismanto@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 64, 'group_id'=> 2,'username'  => 'robbyanggriawan', 'name' => 'Robby Anggriawan SE., ME.', 'email'=> 'robbyanggriawan@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 65, 'group_id'=> 2,'username'  => 'rokhimatul', 'name' => 'Rokhimatul Wakhidah, S.Pd., M.T.', 'email'=> 'rokhimatul@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 66, 'group_id'=> 2,'username'  => 'rosaandrie', 'name' => 'Dr. Eng. Rosa Andrie Asmara, ST., MT.', 'email'=> 'rosaandrie@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 67, 'group_id'=> 2,'username'  => 'rudyariyanto', 'name' => 'Rudy Ariyanto, ST., M.Cs.', 'email'=> 'rudyariyanto@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 68, 'group_id'=> 2,'username'  => 'satriobinusa', 'name' => 'Satrio Binusa S, SS, M.Pd', 'email'=> 'satriobinusa@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 69, 'group_id'=> 2,'username'  => 'septianenggar', 'name' => 'Septian Enggar Sukmana, S.Pd., M.T', 'email'=> 'septianenggar@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 70, 'group_id'=> 2,'username'  => 'sofyannoor', 'name' => 'Sofyan Noor Arief, S.ST., M.Kom.', 'email'=> 'sofyannoor@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 71, 'group_id'=> 2,'username'  => 'trianafatmawati', 'name' => 'Triana Fatmawati, S.T., M.T.', 'email'=> 'trianafatmawati@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 72, 'group_id'=> 2,'username'  => 'usmannurhasan', 'name' => 'Usman Nurhasan, S.Kom., MT.', 'email'=> 'usmannurhasan@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 73, 'group_id'=> 2,'username'  => 'verysugiarto', 'name' => 'Very Sugiarto, S.Pd','email'=> 'verysugiarto@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 74, 'group_id'=> 2,'username'  => 'vipkasalhadid', 'name' => 'Vipkas Al Hadid Firdaus, ST,. MT', 'email'=> 'vipkasalhadid@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 75, 'group_id'=> 2,'username'  => 'vitzuraida', 'name' => 'Vit Zuraida, S.Kom., M.Kom.', 'email'=> 'vitzuraida@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 76, 'group_id'=> 2,'username'  => 'vivinur', 'name' => 'Vivi Nur Wijayaningrum, S.Kom, M.Kom', 'email'=> 'vivinur@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 77, 'group_id'=> 2,'username'  => 'vivinayu', 'name' => 'Vivin Ayu Lestari, S.Pd., M.Kom', 'email'=> 'vivinayu@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 78, 'group_id'=> 2,'username'  => 'widaningsih', 'name' => 'Widaningsih Condrowardhani, SH, MH.', 'email'=> 'widaningsih@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 79, 'group_id'=> 2,'username'  => 'wildaimama', 'name' => 'Wilda Imama Sabilla, S.Kom., M.Kom.', 'email'=> 'wildaimama@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 80, 'group_id'=> 2,'username'  => 'yanwatequlis', 'name' => 'Yan Watequlis Syaifudin, ST., M.MT., Ph.D.', 'email'=> 'yanwatequlis@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 81, 'group_id'=> 2,'username'  => 'yuriariyanto', 'name' => 'Yuri Ariyanto, S.Kom., M.Kom.', 'email'=> 'yuriariyanto@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            ['user_id' => 82, 'group_id'=> 2,'username'  => 'doditsuprianto', 'name' => 'Dodit Suprianto', 'email'=> 'doditsuprianto@admin.com','password'  => password_hash('12345', PASSWORD_DEFAULT)],
            [
                'user_id'   => 83, //
                'group_id'  => 3, // Kurikulum
                'username'  => 'dosenkurikulumti',
                'name'      => 'Dosen Kurikulum TI',
                'email'     => 'dokurti@admin.com',
                'password'  => password_hash('12345', PASSWORD_DEFAULT),
            ],
            [
                'user_id'   => 84, //
                'group_id'  => 3, // Kurikulum
                'username'  => 'dosenkurikulumsib',
                'name'      => 'Dosen Kurikulum SIB',
                'email'     => 'dokursib@admin.com',
                'password'  => password_hash('12345', PASSWORD_DEFAULT),
            ],
            [
                'user_id'   => 85, //
                'group_id'  => 4, // Kurikulum
                'username'  => 'kaproditi',
                'name'      => 'Kaprodi TI',
                'email'     => 'kaproditi@admin.com',
                'password'  => password_hash('12345', PASSWORD_DEFAULT),
            ],
            [
                'user_id'   => 86, //
                'group_id'  => 4, // Kurikulum
                'username'  => 'kaprodisib',
                'name'      => 'Kaprodi SIB',
                'email'     => 'kaprodisib@admin.com',
                'password'  => password_hash('12345', PASSWORD_DEFAULT),
            ]
        ]);
    }
}
