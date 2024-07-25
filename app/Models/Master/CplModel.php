<?php

namespace App\Models\Master;

use App\Models\AppModel;
use App\Models\Referensi\ProfilLulusanModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class CplModel extends AppModel
{
    use SoftDeletes;
    protected $table = 'm_cpl';
    protected $primaryKey = 'cpl_id';
    protected $uniqueKey = 'kode_cpl'; 

    protected static $_table = 'm_cpl';
    protected static $_primaryKey = 'cpl_id';
    protected static $_uniqueKey = 'kode_cpl';

    protected $fillable = [
        'cpl_id',
        'kode_cpl',
        'deskripsi_cpl',
        'kodeprofil_lulusan_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

    public function Matakuliah(){
        return $this->belongsToMany(MatakuliahModel::class,'m_mkcpl');
    }
    public function BahanKajian(){
        return $this->belongsToMany(MatakuliahModel::class,'m_bahankajian');
    }
    public function ProfilLulusan(){
        return $this->belongsTo(ProfilLulusanModel::class);
    }
    protected static $cascadeDelete = false;
    protected static $childModel = [
        //  Model => columnFK
        // 'App\Models\Master\DosenModel' => 'jurusan_id'
    ];

}
