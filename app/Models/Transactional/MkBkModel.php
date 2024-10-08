<?php

namespace App\Models\Transactional;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AppModel;
use App\Models\Master\MatkulModel;
use App\Models\Master\BahanKajianModel;
use App\Models\Master\ProdiModel;

class MkBkModel extends AppModel
{
    use SoftDeletes;
    protected $table = 't_mk_bk';
    protected $primaryKey = 'mk_bk_id';
    protected $uniqueKey = '';

    protected static $_table = 't_bk_mk';
    protected static $_primaryKey = 'mk_bk_id';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'mk_bk_id',
        'bk_id',
        'mk_id',
        'prodi_id',
        'is_active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

    public function MataKuliah(){
        return $this->belongsTo(MatkulModel::class);
    }
    public function BahanKajian(){
        return $this->belongsTo(BahanKajianModel::class);
    }
    protected static $cascadeDelete = false;
    protected static $childModel = [
      
    ];
    public static function setDefaultMkBk(){
        $bahan_kajian = BahanKajianModel::select('bk_id','bk_kategori')->get();
        

        $ins = [];
        foreach($bahan_kajian as $bk){
            $matkul = MatkulModel::select('mk_id')
                        ->where('bk_id', $bk->bk_id)->get();
            
            foreach($matkul as $mk){
                $ins[] = [
                    'mk_id' => $matkul->mk_id,
                    'bk_id' => $bk->bk_id,
                    'bk_kategori' => $bk->bk_kategori,
                    'is_active' => 0,
                ];
            }
        }

        if(count($ins) > 0){
            MkBkModel::upsert($ins, ['mk_id','bk_id'], ['is_active']);
        }
        return $bahan_kajian;

    }



    public static function updateMkBk($prodi_id, $mkbk){
        self::where('prodi_id', $prodi_id)->update(['is_active' => 0]);

        if(is_array($mkbk) && count($mkbk) > 0){
            $ins = [];
            foreach($mkbk as $mk_id => $val){
                foreach($val as $bk_id => $is_active){
                    $ins[] = [
                        'mk_id' => $mk_id,
                        'bk_id' => $bk_id,
                        'prodi_id' => $prodi_id,
                        'is_active' => 1
                    ];
                }
            }

            MkBkModel::upsert($ins, ['prodi_id','mk_id','bk_id'], ['is_active']);
        }
    }
}
