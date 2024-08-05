<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\AppModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\CplProdiModel;
use App\Models\Master\CplSndiktiModel;
use App\Models\Master\ProdiModel;
class CplMatriksModel extends AppModel
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
        'cpl_sndikti_id',
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

    public function CplProdi(){
        return $this->belongsTo(CplProdiModel::class);
    }
    public function CplSndikti(){
        return $this->belongsTo(CplSndiktiModel::class);
    }
    protected static $cascadeDelete = false;
    protected static $childModel = [
      
    ];


    public static function setDefaultCplMatriks(){
        $prodi = CplProdiModel::select('cpl_prodi_id','cpl_prodi_kategori')->get();
        

        $ins = [];
        foreach($prodi as $p){
            $sndikti = CplSndiktiModel::select('cpl_sndikti_id')
                        ->where('pl_id', $p->pl_id)->get();
            
            foreach($sndikti as $s){
                $ins[] = [
                    'cpl_sndikti_id' => $s->cpl_sndikti_id,
                    'cpl_prodi_id' => $p->cpl_prodi_id,
                    'cpl_kategori' => $p->cpl_prodi_kategori,
                    'is_active' => 0,
                ];
            }
        }

        if(count($ins) > 0){
            CplMatriksModel::upsert($ins, ['cpl_sndikti_id','cpl_prodi_id'], ['is_active']);
        }
        return $prodi;

    }



    public static function updateMatriks($prodi_id, $matriks){
        self::where('prodi_id', $prodi_id)->update(['is_active' => 0]);

        if(is_array($matriks) && count($matriks) > 0){
            $ins = [];
            foreach($matriks as $cpl_sndikti_id => $val){
                foreach($val as $cpl_prodi_id => $is_active){
                    $ins[] = [
                        'prodi_id' => $prodi_id,
                        'cpl_sndikti_id' => $cpl_sndikti_id,
                        'cpl_prodi_id' => $cpl_prodi_id,
                        'is_active' => 1
                    ];
                }
            }

            CplMatriksModel::upsert($ins, ['prodi_id','cpl_sndikti_id','cpl_prodi_id'], ['is_active']);
        }
    }
}
