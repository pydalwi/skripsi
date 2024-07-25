<?php

namespace App\Models\Master;

use App\Models\AppModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Data\CpmkModel;
use App\Models\Data\KurikulumMkModel;
use App\Models\Master\RumpunMkModel;
use App\Models\Transactional\CplBkMkModel;
use App\Models\Transactional\MkBkModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatkulModel extends AppModel
{
    use SoftDeletes;
    protected $table = 'm_mk';
    protected $primaryKey = 'mk_id';
    protected $uniqueKey = '';

    protected static $_table = 'm_mk';
    protected static $_primaryKey = 'mk_id';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'mk_id',
        'mk_nama',
        'mk_jenis',
        'mk_kode',
        'mk_kategori',
        'sks',
        'semester',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

    public function KurikulumMk(){
        return $this->hasMany(KurikulumMkModel::class);
    }
    public function Cpmk(){
        return $this->hasMany(CpmkModel::class);
    }
    public function CplBkMk(){
        return $this->hasMany(CplBkMkModel::class,'t_cpl_bk_mk');
    }
    public function MkBk(){
        return $this->hasMany(MkBkModel::class,'t_mk_bk');
    }

    protected static $cascadeDelete = false;
    protected static $childModel = [
     
    ];

}
