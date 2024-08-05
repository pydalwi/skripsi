<?php

namespace App\Models\Transactional;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Master\ProdiModel;
use App\Models\Master\MatkulModel;
use App\Models\Data\CpmkModel;
use App\Models\Master\CplProdiModel;
class TahapmekanismeModel extends Model
{
    use SoftDeletes;
    protected $table = 't_tahap_mekanisme_penilaian';
    protected $primaryKey = 'tahap_mekanisme_penilaian_id';
    protected $uniqueKey = '';

    protected static $_table = 't_tahap mekanisme_penilaian';
    protected static $_primaryKey = 'tahap_mekanisme_penilaian_id';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'tahap_mekanisme_penilaian_id',
        'cpl_prodi_id',
        'cpmk_id',
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
    public function Cpmk(){
        return $this->belongsTo(CpmkModel::class);
    }
    protected static $cascadeDelete = false;
    protected static $childModel = [
      
    ];
}