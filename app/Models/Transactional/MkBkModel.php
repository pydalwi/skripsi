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
    protected $table = 't_bk_mk';
    protected $primaryKey = 'bk_mk_id';
    protected $uniqueKey = '';

    protected static $_table = 't_bk_mk';
    protected static $_primaryKey = 'bk_mk_id';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'bk_mk_id',
        'bk_id',
        'mk_id',
        'prodi_id',
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
}
