<?php

namespace App\Models\Referensi;

use App\Models\AppModel;
use App\Models\Master\MatakuliahModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReferensiModel extends AppModel
{
    use SoftDeletes; 
    protected $table = 'r_referensi';
    protected $primaryKey = 'ref_id';
    protected $uniqueKey = '';

    protected static $_table = 'r_referensi';
    protected static $_primaryKey = 'ref_id';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'ref_id',
        'judul_ref',
        'penulis_ref',
        'tahun_ref',
        'penerbit_ref',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

    public function MataKuliah(){
        return $this->belongsToMany(MatakuliahModel::class,'m_mkreferensi');
    }
    protected static $cascadeDelete = false;
    protected static $childModel = [
        //  Model => columnFK
        // 'App\Models\Master\DosenModel' => 'jurusan_id'
    ];
}
