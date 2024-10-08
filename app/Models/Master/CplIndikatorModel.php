<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Master\ProdiModel;
use App\Models\Master\CplProdiModel;

class CplIndikatorModel extends Model
{
    use SoftDeletes;
    protected $table = 'm_cpl_indikator';
    protected $primaryKey = 'cpl_indikator_id';
    protected $uniqueKey = ''; 

    protected static $_table = 'm_cpl_indikator';
    protected static $_primaryKey = 'cpl_indikator_id';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'cpl_indikator_id',
        'prodi_id',
        'cpl_indikator_kinerja',
        'cpl_indikator_kode',
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
    public function CplProdi() {
        return $this->HasMany(CplProdiModel::class);
    }
    protected static $cascadeDelete = false;
    protected static $childModel = [
       
    ];
}
