<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\AppModel;
use App\Models\Data\CpmkModel;


class CpmkDetailModel extends AppModel
{
    use SoftDeletes;
    protected $table = 'd_cpmk_detail';
    protected $primaryKey = 'cpmk_detail_id';
    protected $uniqueKey = '';

    protected static $_table = 'd_cpmk_detail';
    protected static $_primaryKey = 'cpmk_detail_id';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'cpmk_detail_id',
        'cpmk_id',
        'sub_cpmk_kode',
        'indikator_sub_cpmk',
        'uraian_sub_cpmk',
        'cpl_prodi_id',
        'mk_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

    public function Cpmk(){
        return $this->hasMany(CpmkModel::class);
    }
    protected static $cascadeDelete = false;
    protected static $childModel = [ 
    ];
}
