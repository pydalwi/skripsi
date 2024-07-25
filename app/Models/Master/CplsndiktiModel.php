<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\AppModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\ProdiModel;
use App\Models\Data\CplMatriksModel;

class CplsndiktiModel extends AppModel
{
    use SoftDeletes;
    protected $table = 'm_cpl_sndikti';
    protected $primaryKey = 'cpl_sndikti_id';
    protected $uniqueKey = '';

    protected static $_table = 'm_cpl_sndikti';
    protected static $_primaryKey = 'cpl_sndikti_id';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'cpl_sndikti_kode',
        'cpl_sndikti_id',
        'cpl_sndikti_kategori',
        'cpl_sndikti_deskripsi',
        'pl_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];
    public function Profil_lulusan() {
        return $this->belongsTo(PLModel::class);
    }
    public function CplMatriks() {
        return $this->hasMany(CplMatriksModel::class);
    }
    protected static $cascadeDelete = false;
    protected static $childModel = [
       
    ];
    public static function setDefaultCplMatriks(){
        $prodi = CplProdiModel::select('cpl_prodi_id','cpl_prodi_kategori')->get();
        

        $ins = [];
        foreach($prodi as $p){
            $sndikti = CplSndiktiModel::select('cpl_sndikti_id')
                        ->where('cpl_sndikti_kategori', $p->cpl_prodi_kategori)->get();
            
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
      
    }
}