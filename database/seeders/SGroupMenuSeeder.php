<?php

namespace Database\Seeders;

use App\Models\Setting\MenuModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SGroupMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu_super = [];
        $menu_admin = [];
        $menu_dokur = [];
        $menu_kaprodi = [];
        
        
        
        $data = MenuModel::get();
      foreach($data as $i){
              $menu_super[] = ['group_id'  => 1, 'menu_id'   => $i->menu_id, 'c'   => 1, 'r'    => 1, 'u'   => 1, 'd' => 1];
              $menu_admin[] = ['group_id'  => 2, 'menu_id'   => $i->menu_id, 'c'   => 0, 'r'    => 1, 'u'   => 0, 'd' => 0];
                  
          }
         
      
   //  for ($i = 1; $i <= 33; $i++){
   //     if ($i === 1 || ($i >= 13 && $i <= 37)) {
   //         $menu_super[] = ['group_id'  => 1, 'menu_id'   => $i, 'c'   => 1, 'r'    => 1, 'u'   => 1, 'd' => 1];
   //         $menu_kaprodi[] = ['group_id'  => 4, 'menu_id'   => $i, 'c'   => 1, 'r'    => 1, 'u'   => 1, 'd' => 1];
   //         $menu_dokur[] = ['group_id'  => 3, 'menu_id'   => $i, 'c'   => 1, 'r'    => 1, 'u'   => 1, 'd' => 1];
   //      } if($i >= 6 && $i <= 33) {
   //          $menu_kaprodi[] = ['group_id'  => 4, 'menu_id'   => $i, 'c'   => 1, 'r'    => 1, 'u'   => 1, 'd' => 1];
    //     } if($i === 7 || $i === 9 || $i === 2 || $i === 13 || $i ===14 || $i === 21 || $i === 23) {
    //        $menu_admin[] = ['group_id'  => 2, 'menu_id'   => $i, 'c'   => 1, 'r'    => 1, 'u'   => 1, 'd' => 1];
    //        $menu_kaprodi[] = ['group_id'  => 4, 'menu_id'   => $i, 'c'   => 1, 'r'    => 1, 'u'   => 1, 'd' => 1];
    //        $menu_dokur[] = ['group_id'  => 3, 'menu_id'   => $i, 'c'   => 1, 'r'    => 1, 'u'   => 1, 'd' => 1];
    //     }
    //    }//

        DB::table('s_group_menu')->insert($menu_super);
        DB::table('s_group_menu')->insert($menu_admin);

    }
}
