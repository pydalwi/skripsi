<?php

namespace App\Models\Transactional;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AppModel;
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

    public static function setDefaultCplBk(){
        $prodi = CplProdiModel::select('cpl_prodi_id','pl_id','cpl_prodi_kategori')->get();
        

        $ins = [];
        foreach($prodi as $p){
            $bahan_kajian = BahanKajianModel::select('bk_id')
                        ->where('pl_id', $p->pl_id)->get();
            
            foreach($bahan_kajian as $bk){
                $ins[] = [
                    'bk_id' => $bk->bk_id,
                    'cpl_prodi_id' => $p->cpl_prodi_id,
                  
                    'is_active' => 0,
                ];
            }
        }

        if(count($ins) > 0){
            CplBkModel::upsert($ins, ['bk_id','cpl_prodi_id'], ['is_active']);
        }
        return $prodi;

    }
}
