<?php

namespace App\Models\Transactional;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AppModel;
use App\Models\Master\CplProdiModel;
use App\Models\Master\MatkulModel;
use App\Models\Transactional\CplBkModel;
use App\Models\Master\ProdiModel;

class CplBkMkModel extends AppModel
{
    use SoftDeletes;
    protected $table = 't_cpl_bk_mk';
    protected $primaryKey = 'cpl_bk_mk_id';
    protected $uniqueKey = '';

    protected static $_table = 't_cpl_bk_mk';
    protected static $_primaryKey = 'cpl_bk_mk_id';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'cpl_bk_mk_id',
        'cpl_bk_id',
        'mk_id',
        'cpl_prodi_id',
        'prodi_id',
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
    public function MataKuliah(){
        return $this->belongsTo(MatkulModel::class);
    }
    public function CplBk(){
        return $this->hasMany(CplBkModel::class);
    }

    protected static $cascadeDelete = false;
    protected static $childModel = [
      
    ];
}
