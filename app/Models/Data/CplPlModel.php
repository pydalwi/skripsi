<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\AppModel;
use App\Models\Master\CplProdiModel;
use App\Models\Master\PLModel;

class CplPlModel extends AppModel
{
    use SoftDeletes;
    protected $table = 'd_cpl_pl';
    protected $primaryKey = 'cpl_pl_id';
    protected $uniqueKey = '';

    protected static $_table = 'd_cpl_pl';
    protected static $_primaryKey = 'cpl_pl_id';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'cpl_pl_id',
        'cpl_prodi_id',
        'pl_id',
        'prodi_id',
        'cpl_pl_check',
        'is_active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

    public function ProfilLulusan(){
        return $this->belongsTo(PLModel::class);
    }
    public function CplProdi(){
        return $this->belongsTo(CplProdiModel::class);
    }
    protected static $cascadeDelete = false;
    protected static $childModel = [
      
    ];
    public static function setDefaultCplPl(){
        $prodi = CplProdiModel::select('cpl_prodi_id','cpl_prodi_kategori')->get();
        

        $ins = [];
        foreach($prodi as $p){
            $profil_lulusan = PLModel::select('pl_id')
                        ->where('pl_id', $p->pl_id)->get();
            
            foreach($profil_lulusan as $pl){
                $ins[] = [
                    'pl_id' => $pl->pl_id,
                    'cpl_prodi_id' => $p->cpl_prodi_id,
                  
                    'is_active' => 0,
                ];
            }
        }

        if(count($ins) > 0){
            CplPlModel::upsert($ins, ['pl_id','cpl_prodi_id'], ['is_active']);
        }
        return $prodi;

    }
    public static function updateCplpl($prodi_id, $cplpl){
        self::where('prodi_id', $prodi_id)->update(['is_active' => 0]);

        if(is_array($cplpl) && count($cplpl) > 0){
            $ins = [];
            foreach($cplpl as $cpl_prodi_id => $val){
                foreach($val as $pl_id => $is_active){
                    $ins[] = [
                        'prodi_id' => $prodi_id,
                        'cpl_prodi_id' => $cpl_prodi_id,
                        'pl_id' => $pl_id,
                        'is_active' => 1
                    ];
                }
            }

            CplPlModel::upsert($ins, ['prodi_id','pl_id','cpl_prodi_id'], ['is_active']);
        }
    }
}
