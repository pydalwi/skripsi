<?php

namespace App\Models\Transactional;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AppModel;
use App\Models\Master\ProdiModel;
use App\Models\Master\CplProdiModel;
use App\Models\Master\BahanKajianModel;
use App\Models\Transactional\CplBkMkModel;

class CplBkModel extends AppModel
{
    use SoftDeletes;
    protected $table = 't_cpl_bk';
    protected $primaryKey = 'cpl_bk_id';
    protected $uniqueKey = '';

    protected static $_table = 't_cpl_bk';
    protected static $_primaryKey = 'cpl_bk_id';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'cpl_bk_id',
        'bk_id',
        'cpl_prodi_id',
        'prodi_id',
        'is_active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

    public function BahanKajian(){
        return $this->belongsTo(BahanKajianModel::class);
    }
    public function CplProdi(){
        return $this->belongsTo(CplProdiModel::class);
    }
    public function CplBkMk(){
        return $this->hasMany(CplBkMkModel::class,'t_cpl_bk_mk');
    }
   
    protected static $cascadeDelete = false;
    protected static $childModel = [
      
    ];

    public static function setDefaultCplBkMatriks(){
        $prodi = CplProdiModel::select('cpl_prodi_id','cpl_prodi_kategori')->get();
        

        $ins = [];
        foreach($prodi as $p){
            $bahankajian = BahanKajianModel::select('bk_id')
                        ->where('bk_id', $p->bk_id)->get();
            
            foreach($bahankajian as $bk){
                $ins[] = [
                    'bk_id' => $bk->bk_id,
                    'cpl_prodi_id' => $p->cpl_prodi_id,
                    'cpl_kategori' => $p->cpl_prodi_kategori,
                    'is_active' => 0,
                ];
            }
        }

        if(count($ins) > 0){
            CplBkModel::upsert($ins, ['bk_id','cpl_prodi_id'], ['is_active']);
        }
        return $prodi;

    }



    public static function updateCplBk($prodi_id, $cplbk){
        self::where('prodi_id', $prodi_id)->update(['is_active' => 0]);

        if(is_array($cplbk) && count($cplbk) > 0){
            $ins = [];
            foreach($cplbk as $bk_id => $val){
                foreach($val as $cpl_prodi_id => $is_active){
                    $ins[] = [
                        'prodi_id' => $prodi_id,
                        'bk_id' => $bk_id,
                        'cpl_prodi_id' => $cpl_prodi_id,
                        'is_active' => 1
                    ];
                }
            }

            CplBkModel::upsert($ins, ['prodi_id','bk_id','cpl_prodi_id'], ['is_active']);
        }
    }
}
