<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\AppModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Master\ProdiModel;
use App\Models\Data\CplMatriksModel;
use App\Models\Transactional\CplBkModel;
use App\Models\Data\CplPlModel;
use App\Models\Transactional\CplBkMkModel;
use App\Models\Transactional\CplCpmkModel;
class CplProdiModel extends AppModel
{
    use SoftDeletes;
    protected $table = 'm_cpl_prodi';
    protected $primaryKey = 'cpl_prodi_id';
    protected $uniqueKey = ''; 

    protected static $_table = 'm_cpl_prodi';
    protected static $_primaryKey = 'cpl_prodi_id';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'cpl_prodi_id',
        'prodi_id',
        'cpl_prodi_kategori',
        'cpl_prodi_kode',
        'cpl_prodi_deskripsi',
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
    public function Profil_lulusan() {
        return $this->belongsTo(PLModel::class);
    }
    public function CplMatriks(){
        return $this->hasMany(CplMatriksModel::class);
    }
    public function CplBk(){
        return $this->hasMany(CplBkModel::class,'t_cpl_bk');
    }
    public function CplPl(){
        return $this->hasMany(CplPlModel::class,'d_cpl_pl');
    }
    public function CplBkMk(){
        return $this->hasMany(CplBkMkModel::class,'t_cpl_bk_mk');
    } 
    public function CplCpmk(){
        return $this->hasMany(CplCpmkModel::class,'t_cpl_cpmk');
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
