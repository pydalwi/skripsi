<?php

namespace App\Models\Dosen;

use App\Models\AppModel;
use App\Models\Rps\PengampuModel;
use App\Models\Setting\UserModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class DosenModel extends AppModel
{
    use SoftDeletes;

    protected $table = 'd_dosen';
    protected $primaryKey = 'dosen_id';

    protected static $_table = 'd_dosen';
    protected static $_primaryKey = 'dosen_id';

    protected $fillable = [
        'user_id',
        'dosen_id',
        'nama_dosen',
        'nip',
        'nidn',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

    protected static $cascadeDelete = false;   //  True: Force Delete from Parent (cascade)
    protected static $childModel = [
        //  Model => columnFK
        //'App\Models\Master\EmployeeModel' => 'jabatan_id'
    ];

   // public function pengampu()
   // {
   //     return $this->belongsTo(PengampuModel::class, 'dosen_id', 'dosen_id');
   // }

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }

    public static function getDosenMap( $tag = ''){
        $dosenData = DB::table('d_dosen')
            ->select('nama_dosen', 'group_id')
            ->get();
    
        foreach ($dosenData as $data) {
            $tag .= '<tr><td>'.$data->nama_dosen.'</td>'.
                '<td class="text-center pr-2"><div class="icheck-success d-inline"><input class="group" name="group_id" id="grups'.$data->group_id.'" value="'.($data->group_id == 2 ? 2 : 4).'" type="checkbox" '.($data->group_id == 2 ? 'checked' : '').'><label for="grups'.$data->group_id.'"></label></div></td>'.
                 //'<td class="text-center pr-2"><input class="group_id_checkbox" name="group_id'.$data->nama_dosen.'" value="'.($data->group_id == 2 ? 2 : 4).'" type="checkbox" '.($data->group_id == 2 ? 'checked' : '').'></td>'.
                '</tr>';
        }
    //     // Tambahkan tombol simpan dan batal
    // $tag .= '<tr><td colspan="2" class="text-right"><button type="button" data-url="kelola_dosen/show" class="btn btn-primary mr-2" >Simpan</button><button type="button" class="btn btn-secondary" onclick="batal()">Batal</button></td></tr>';
    
        return $tag;
    }
    
    
    public static function setDosenMap($request){
        $menu = $request->except(['_token', '_method']);


        if(!empty($menu) && is_array($menu)){
            foreach($menu as $menu_id => $act){
                self::updateOrInsert(
                        ['group_id' => $menu_id],
                        [
                            'group_id' => isset($act['group_id'])? 3 : 4,
                        ]
                    );
            }
        }
        return true;
    }
};
