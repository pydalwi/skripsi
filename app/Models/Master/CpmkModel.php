<?php

namespace App\Models\Master;

use App\Models\AppModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class CpmkModel extends AppModel
{
    use SoftDeletes;
    protected $table = 'm_cpmk'; 
    protected $primaryKey = 'cpmk_id';
    protected $uniqueKey = 'kode_cpmk';

    protected static $_table = 'm_cpmk';
    protected static $_primaryKey = 'cpmk_id';
    protected static $_uniqueKey = 'kode_cpmk';

    protected $fillable = [
        'cpmk_id',
        'kode_cpmk',
        'deskripsi_cpmk',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

    public function MataKuliah(){
        return $this->belongsToMany(MatakuliahModel::class,'m_mkcpmk');
    }


    protected static $cascadeDelete = false;
    protected static $childModel = [
        //  Model => columnFK
        // 'App\Models\Master\DosenModel' => 'jurusan_id'
    ];
}
