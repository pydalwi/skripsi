<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\AppModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Master\ProdiModel;
use App\Models\Transaction\CplBkModel;
use App\Models\Transaction\MkBkModel;

class BahanKajianModel extends AppModel
{
    use SoftDeletes;
    protected $table = 'm_bahan_kajian';
    protected $primaryKey = 'bk_id';
    protected $uniqueKey = '';

    protected static $_table = 'm_bahan_kajian';
    protected static $_primaryKey = 'bk_id';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'bk_id',
        'prodi_id',
        'bk_kategori',
        'bk_kode',
        'bk_deskripsi',
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
    public function CplBk(){
        return $this->hasMany(CplBkModel::class,'t_cpl_bk');
    }
    public function MkBk(){
        return $this->hasMany(MkBkModel::class,'t_mk_bk');
    }
    protected static $cascadeDelete = false;
    protected static $childModel = [
       
    ];
}
