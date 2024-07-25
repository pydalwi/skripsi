<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\AppModel;
use App\Models\Master\MatkulModel;
use App\Models\Master\ProdiModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class KurikulumModel extends AppModel
{
    use SoftDeletes;
    protected $table = 'd_kurikulum';
    protected $primaryKey = 'kurikulum_id';
    protected $uniqueKey = '';

    protected static $_table = 'd_kurikulum';
    protected static $_primaryKey = 'kurikulum_id';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'kurikulum_id',
        'kurikulum_tahun',
        'kurikulum_nama',
        'prodi_id',
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
    public function MataKuliah(){
        return $this->hasMany(MatkulModel::class);
    }
    protected static $cascadeDelete = false;
    protected static $childModel = [

    ];
}
