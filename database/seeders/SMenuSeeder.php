<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */ 
    public function run()
    {
      DB::table('s_menu')->upsert([
            
        ['menu_id' => '1', 'menu_scope' => 'ALL', 'menu_code' => 'DASHBOARD', 'menu_name' => 'Dashboard', 'menu_url' => '/', 'menu_level' => '1', 'order_no' => '1', 'parent_id' => NULL, 'class_tag' => 'dashboard', 'icon' => 'fas fa-tachometer-alt', 'is_active' => '1'],
        ['menu_id' => '2','menu_scope' => 'SUPER','menu_code' => 'DOSEN','menu_name' => 'Data Dosen','menu_url' => NULL,'menu_level' => '1','order_no' => '2','parent_id' => NULL,'class_tag' => 'dosen','icon' => 'fas fa-solid fa-user-tie','is_active' => '1'],
        ['menu_id' => '3', 'menu_scope' => 'ALL', 'menu_code' => 'MASTER', 'menu_name' => 'Data Master', 'menu_url' => NULL, 'menu_level' => '1', 'order_no' => '3', 'parent_id' => NULL, 'class_tag' => 'master', 'icon' => 'fas fa-th', 'is_active' => '1'],
        ['menu_id' => '4', 'menu_scope' => 'ALL', 'menu_code' => 'DATA', 'menu_name' => 'Data', 'menu_url' => NULL, 'menu_level' => '1', 'order_no' => '4', 'parent_id' => NULL, 'class_tag' => 'data', 'icon' => 'fas fa-database', 'is_active' => '1'],
        ['menu_id' => '5', 'menu_scope' => 'ALL', 'menu_code' => 'TRANSACTION', 'menu_name' => 'Transaksi', 'menu_url' => NULL, 'menu_level' => '1', 'order_no' => '5', 'parent_id' => NULL, 'class_tag' => 'transaction', 'icon' => 'fas fa-edit', 'is_active' => '1'],
        ['menu_id' => '6', 'menu_scope' => 'KAPRODI', 'menu_code' => 'REPORT', 'menu_name' => 'Pengesahan', 'menu_url' => NULL, 'menu_level' => '1', 'order_no' => '6', 'parent_id' => NULL, 'class_tag' => 'report', 'icon' => 'fas fa-file-invoice', 'is_active' => '1'],
        ['menu_id' => '7', 'menu_scope' => 'SUPER', 'menu_code' => 'SETTING', 'menu_name' => 'Setting', 'menu_url' => NULL, 'menu_level' => '1', 'order_no' => '7', 'parent_id' => NULL, 'class_tag' => 'setting', 'icon' => 'fas fa-cogs', 'is_active' => '1'],
     
        //LEVEL 2
        ['menu_id' => '8','menu_scope' => 'SUPER','menu_code' => 'SETTING.PERIODE','menu_name' => 'Periode','menu_url' => 'setting/periode','menu_level' => '2','order_no' => '14','parent_id' => '7','class_tag' => 'setting-periode','icon' => 'fas fa-minus text-xs','is_active' => '1'],
        ['menu_id' => '9', 'menu_scope' => 'ALL', 'menu_code' => 'SETTING.ACCOUNT', 'menu_name' => 'Account', 'menu_url' => 'setting/account', 'menu_level' => '2', 'order_no' => '72', 'parent_id' => '7', 'class_tag' => 'setting-account', 'icon' => 'fas fa-minus text-xs', 'is_active' => '1'],
        ['menu_id' => '10', 'menu_scope' => 'SUPER', 'menu_code' => 'SETTING.GROUP', 'menu_name' => 'Group Pengguna', 'menu_url' => 'setting/group', 'menu_level' => '2', 'order_no' => '74', 'parent_id' => '7', 'class_tag' => 'setting-group', 'icon' => 'fas fa-minus text-xs', 'is_active' => '1'],
        ['menu_id' => '11', 'menu_scope' => 'SUPER', 'menu_code' => 'SETTING.USER', 'menu_name' => 'Users', 'menu_url' => 'setting/user', 'menu_level' => '2', 'order_no' => '75', 'parent_id' => '7', 'class_tag' => 'setting-user', 'icon' => 'fas fa-minus text-xs', 'is_active' => '1'],
        ['menu_id' => '12', 'menu_scope' => 'SUPER', 'menu_code' => 'SETTING.MENU', 'menu_name' => 'Menu', 'menu_url' => 'setting/menu', 'menu_level' => '2', 'order_no' => '76', 'parent_id' => '7', 'class_tag' => 'setting-menu', 'icon' => 'fas fa-minus text-xs', 'is_active' => '1'],
        ['menu_id' => '13','menu_scope' => 'SUPER','menu_code' => 'DOSEN.KELOLADOSEN','menu_name' => 'Dosen','menu_url' => 'dosen/kelola_dosen','menu_level' => '2','order_no' => '7','parent_id' => '2','class_tag' => 'dosen-kelola_dosen','icon' => 'fas fa-minus text-xs','is_active' => '1'],

// ['menu_id' => '10', 'menu_scope' => 'ALL', 'menu_code' => 'SETTING.PROFILE', 'menu_name' => 'User Profile', 'menu_url' => 'setting/profile', 'menu_level' => '2', 'order_no' => '73', 'parent_id' => '6', 'class_tag' => 'setting-profile', 'icon' => 'fas fa-minus text-xs', 'is_active' => '1'],
        //MASTER
        ['menu_id' => '14', 'menu_scope' => 'DOSEN KURIKULUM', 'menu_code' => 'MASTER.PRODI', 'menu_name' => 'Program Studi', 'menu_url' => 'master/prodi', 'menu_level' => '2', 'order_no' => '31', 'parent_id' => '3', 'class_tag' => 'master-prodi', 'icon' => 'fas fa-minus text-xs', 'is_active' => '1'],
        ['menu_id' => '15', 'menu_scope' => 'DOSEN KURIKULUM', 'menu_code' => 'MASTER.MATKUL', 'menu_name' => 'Mata Kuliah', 'menu_url' => 'master/matkul', 'menu_level' => '2', 'order_no' => '32', 'parent_id' => '3', 'class_tag' => 'master-matkul', 'icon' => 'fas fa-minus text-xs', 'is_active' => '1'],
        ['menu_id' => '16', 'menu_scope' => 'DOSEN KURIKULUM', 'menu_code' => 'MASTER.CPLSNDIKTI', 'menu_name' => 'CPL-SNDIKTI', 'menu_url' => 'master/cplsndikti', 'menu_level' => '2', 'order_no' => '33', 'parent_id' => '3', 'class_tag' => 'master-cpl-sndikti', 'icon' => 'fas fa-minus text-xs', 'is_active' => '1'],
        ['menu_id' => '17', 'menu_scope' => 'DOSEN KURIKULUM', 'menu_code' => 'MASTER.CPLPRODI', 'menu_name' => 'CPL-PRODI', 'menu_url' => 'master/cplprodi', 'menu_level' => '2', 'order_no' => '34', 'parent_id' => '3', 'class_tag' => 'master-cpl-prodi', 'icon' => 'fas fa-minus text-xs', 'is_active' => '1'],
        ['menu_id' => '18', 'menu_scope' => 'DOSEN KURIKULUM', 'menu_code' => 'MASTER.BAHANKAJIAN', 'menu_name' => 'Bahan Kajian', 'menu_url' => 'master/bahan_kajian', 'menu_level' => '2', 'order_no' => '35', 'parent_id' => '3', 'class_tag' => 'master-bahan-kajian', 'icon' => 'fas fa-minus text-xs', 'is_active' => '1'],
        ['menu_id' => '19', 'menu_scope' => 'DOSEN KURIKULUM', 'menu_code' => 'MASTER.PL', 'menu_name' => 'Profil Lulusan', 'menu_url' => 'master/profil_lulusan', 'menu_level' => '2', 'order_no' => '36', 'parent_id' => '3', 'class_tag' => 'master-pl', 'icon' => 'fas fa-minus text-xs', 'is_active' => '1'],
        ['menu_id' => '20', 'menu_scope' => 'DOSEN KURIKULUM', 'menu_code' => 'MASTER.RUMPUNMK', 'menu_name' => 'Rumpun-MK', 'menu_url' => 'master/rumpunmk', 'menu_level' => '2', 'order_no' => '37', 'parent_id' => '3', 'class_tag' => 'master-rumpun-mk', 'icon' => 'fas fa-minus text-xs', 'is_active' => '1'],             
       
        //DATA
        ['menu_id' => '21', 'menu_scope' => 'DOSEN KURIKULUM', 'menu_code' => 'DATA.KURIKULUM', 'menu_name' => 'Kurikulum', 'menu_url' => 'data/kurikulum', 'menu_level' => '2', 'order_no' => '41', 'parent_id' => '4', 'class_tag' => 'data-kurikulum', 'icon' => 'fas fa-minus text-xs', 'is_active' => '1'],
        ['menu_id' => '22', 'menu_scope' => 'DOSEN KURIKULUM', 'menu_code' => 'DATA.STRUKTURMKCPL', 'menu_name' => 'Struktur MK-CPL', 'menu_url' => 'data/strukturmkcpl', 'menu_level' => '2', 'order_no' => '42', 'parent_id' => '4', 'class_tag' => 'data-struktur', 'icon' => 'fas fa-minus text-xs', 'is_active' => '1'],
        ['menu_id' => '23', 'menu_scope' => 'DOSEN KURIKULUM', 'menu_code' => 'DATA.KAPRODI', 'menu_name' => 'KAPRODI', 'menu_url' => 'data/kaprodi', 'menu_level' => '2', 'order_no' => '43', 'parent_id' => '4', 'class_tag' => 'data-kaprodi', 'icon' => 'fas fa-minus text-xs', 'is_active' => '1'],
        ['menu_id' => '24', 'menu_scope' => 'DOSEN KURIKULUM', 'menu_code' => 'DATA.CPMK', 'menu_name' => 'CPMK', 'menu_url' => 'data/cpmk', 'menu_level' => '2', 'order_no' => '44', 'parent_id' => '4', 'class_tag' => 'data-cpmk', 'icon' => 'fas fa-minus text-xs', 'is_active' => '1'],
        ['menu_id' => '25', 'menu_scope' => 'DOSEN KURIKULUM', 'menu_code' => 'DATA.CPL.PL', 'menu_name' => 'CPL-PL', 'menu_url' => 'data/cplpl', 'menu_level' => '2', 'order_no' => '45', 'parent_id' => '4', 'class_tag' => 'data-cpl-pl', 'icon' => 'fas fa-minus text-xs', 'is_active' => '1'],
        ['menu_id' => '26', 'menu_scope' => 'DOSEN KURIKULUM', 'menu_code' => 'DATA.CPMK.DETAIL', 'menu_name' => 'CPMK-Detail', 'menu_url' => 'data/cpmkdetail', 'menu_level' => '2', 'order_no' => '46', 'parent_id' => '4', 'class_tag' => 'data-cpmk-detail', 'icon' => 'fas fa-minus text-xs', 'is_active' => '1'],
        ['menu_id' => '27', 'menu_scope' => 'DOSEN KURIKULUM', 'menu_code' => 'DATA.CPL.MATRIKS', 'menu_name' => 'CPL-Matriks', 'menu_url' => 'data/cplmatriks', 'menu_level' => '2', 'order_no' => '47', 'parent_id' => '4', 'class_tag' => 'data-cpl-matriks', 'icon' => 'fas fa-minus text-xs', 'is_active' => '1'],
        ['menu_id' => '28', 'menu_scope' => 'DOSEN KURIKULUM', 'menu_code' => 'DATA.CPLMK', 'menu_name' => 'CPL-MK', 'menu_url' => 'data/cplmk', 'menu_level' => '2', 'order_no' => '48', 'parent_id' => '4', 'class_tag' => 'data-cpl-mk', 'icon' => 'fas fa-minus text-xs', 'is_active' => '1'],
        
        //TRANSACTION
        ['menu_id' => '29', 'menu_scope' => 'DOSEN KURIKULUM', 'menu_code' => 'TRANSACTION.MKBK', 'menu_name' => 'MK-BK', 'menu_url' => 'transaction/mkbk', 'menu_level' => '2', 'order_no' => '51', 'parent_id' => '5', 'class_tag' => 'transaction-mk-bk', 'icon' => 'fas fa-minus text-xs', 'is_active' => '1'],
        ['menu_id' => '30', 'menu_scope' => 'DOSEN KURIKULUM', 'menu_code' => 'TRANSACTION.CPLCPMK', 'menu_name' => 'CPL-CPMK', 'menu_url' => 'transaction/cplcpmk', 'menu_level' => '2', 'order_no' => '52', 'parent_id' => '5', 'class_tag' => 'transaction-cpl-cpmk', 'icon' => 'fas fa-minus text-xs', 'is_active' => '1'],
        ['menu_id' => '31', 'menu_scope' => 'DOSEN KURIKULUM', 'menu_code' => 'TRANSACTION.CPLBK', 'menu_name' => 'CPL-BK', 'menu_url' => 'transaction/cplbk', 'menu_level' => '2', 'order_no' => '53', 'parent_id' => '5', 'class_tag' => 'transaction-cpl-bk', 'icon' => 'fas fa-minus text-xs', 'is_active' => '1'],
        ['menu_id' => '32', 'menu_scope' => 'DOSEN KURIKULUM', 'menu_code' => 'TRANSACTION.CPLBKMK', 'menu_name' => 'CPL-BK-MK', 'menu_url' => 'transaction/cplbkmk', 'menu_level' => '2', 'order_no' => '54', 'parent_id' => '5', 'class_tag' => 'transaction-cpl-bk-mk', 'icon' => 'fas fa-minus text-xs', 'is_active' => '1'],
        
        //REPORT
        ['menu_id' => '33', 'menu_scope' => 'KAPRODI', 'menu_code' => 'REPORT.PENGESAHANKURIKULUM', 'menu_name' => 'Pengesahan Kurikulum', 'menu_url' => 'report/pengesahankurikulum', 'menu_level' => '2', 'order_no' => '61', 'parent_id' => '6', 'class_tag' => 'report-pengesahan-kurikulum', 'icon' => 'fas fa-minus text-xs', 'is_active' => '1'],
    ], 
    ['menu_id', 'menu_code'], ['menu_scope', 'menu_name', 'menu_url', 'class_tag']);
    }
}
