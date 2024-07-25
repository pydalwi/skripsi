<?php

namespace App\Models\Transactional;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AppModel;
use App\Models\Master\CplProdiModel;
use App\Models\Data\CpmkModel;

class CplCpmkModel extends AppModel
{
    use SoftDeletes;
    protected $table = 't_cpl_cpmk';
    protected $primaryKey = 'cpl_cpmk_id';
    protected $uniqueKey = '';

    protected static $_table = 't_cpl_cpmk';
    protected static $_primaryKey = 'cpl_cpmk_id';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'cpl_cpmk_id',
        'cpl_prodi_id',
        'cpmk_id',
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
    public function Cpmk(){
        return $this->belongsTo(CpmkModel::class);
    }
    protected static $cascadeDelete = false;
    protected static $childModel = [
      
    ];
}
