<?php

namespace App\Models\Master;

use App\Models\AppModel;
use App\Models\Data\KurikulumModel;
use App\Models\Referensi\PokokBahasanModel;
use App\Models\Referensi\ReferensiModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatakuliahModel extends AppModel
{
    use SoftDeletes;
    protected $table = 'm_matakuliah';
    protected $primaryKey = 'mk_id';
    protected $uniqueKey = '';

    protected static $_table = 'm_matakuliah';
    protected static $_primaryKey = 'mk_id';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'mk_id',
        'kode_mk',
        'nama_mk',
        'jumlah_sks',
        'jumlah_jam',
        'deskripsi_mk',
        'jenis_mk',
        'semester',
        'kurikulum_id',
        'user_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

    public function Kurikulum(){
        return $this->belongsTo(KurikulumModel::class);
    }

    public function Cpl(){
        return $this->belongsToMany(CplModel::class,'m_mkcpl');
    }
    public function BahanKajian(){
        return $this->belongsToMany(CplModel::class,'m_bahankajian');
    }

    public function Cpmk(){
        return $this->belongsToMany(CpmkModel::class,'m_mkcpmk');
    }
    public function PokokBahasan(){
        return $this->belongsToMany(PokokBahasanModel::class,'r_mk_pokokbahasan');
    }

    public function Referensi(){
        return $this->belongsToMany(ReferensiModel::class,'m_mkreferensi');
    }
}
