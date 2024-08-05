<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\CplProdiModel;
use App\Models\Master\MatkulModel;
use App\Models\Master\ProdiModel;
use App\Models\AppModel;
use Illuminate\Database\Eloquent\SoftDeletes;
class CplMkModel extends Model
{
    use SoftDeletes;
    protected $table = 'd_cpl_matriks';
    protected $primaryKey = 'cpl_matriks_id';
    protected $uniqueKey = '';

    protected static $_table = 'd_cpl_matriks';
    protected static $_primaryKey = 'cpl_matriks_id';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'cpl_matriks_id',
        'mk_id',
        'cpl_prodi_id',
        'cpl_kategori',
        'prodi_id',
        'is_active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

    public function Prodi(){
        return $this->belongsTo(ProdiModel::class);
    }
    public function CplProdi(){
        return $this->belongsTo(CplProdiModel::class);
    }
    public function Matkul(){
        return $this->belongsTo(MatkulModel::class);
    }
    protected static $cascadeDelete = false;
    protected static $childModel = [
      
    ];
    public static function setDefaultCplMk(){
        $prodi = CplProdiModel::select('cpl_prodi_id','mk_id','cpl_prodi_kategori')->get();
        

        $ins = [];
        foreach($prodi as $p){
            $matkul = MatkulModel::select('mk_id')
                        ->where('mk_id', $p->prodi_id)->get();
            
            foreach($matkul as $mk){
                $ins[] = [
                    'mk_id' => $mk->mk_id,
                    'cpl_prodi_id' => $p->cpl_prodi_id,
                    'prodi_id' => $p->prodi_id,
                    'is_active' => 0,
                ];
            }
        }

        if(count($ins) > 0){
            CplMkModel::upsert($ins, ['mk_id','cpl_prodi_id'], ['is_active']);
        }
        return $prodi;

    }
    public static function updateCplMk($prodi_id, $cplmk){
        self::where('prodi_id', $prodi_id)->update(['is_active' => 0]);

        if(is_array($cplmk) && count($cplmk) > 0){
            $ins = [];
            foreach($cplmk as $mk_id => $val){
                foreach($val as $cpl_prodi_id => $is_active){
                    $ins[] = [
                        'prodi_id' => $prodi_id,
                        'mk_id' => $mk_id,
                        'cpl_prodi_id' => $cpl_prodi_id,
                        'is_active' => 1
                    ];
                }
            }

            CplMatriksModel::upsert($ins, ['prodi_id','mk_id','cpl_prodi_id'], ['is_active']);
        }
    }
}
