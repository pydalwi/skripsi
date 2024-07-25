<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\AppModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Master\CplProdiModel;
use App\Models\Master\MatkulModel;
class StrukturmkModel extends Model
{
    use SoftDeletes;
    protected $table = 'd_strukturmk';
    protected $primaryKey = 'struktur_mk_id';
    protected $uniqueKey = '';

    protected static $_table = 'd_strukturmk';
    protected static $_primaryKey = 'struktur_mk_id';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'struktur_mk_id',
        'cpl_prodi_id',
        'mk_id',
        'is_active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

    public function Matkul(){
        return $this->hasMany(MatkulModel::class);
    }
    public function CplProdi(){
        return $this->hasMany(CplProdiModel::class);
    }
    protected static $cascadeDelete = false;
    protected static $childModel = [
      
    ];
}
