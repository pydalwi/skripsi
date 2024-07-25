<?php

namespace App\Models\Referensi;

use App\Models\AppModel;
use App\Models\Master\MatakuliahModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PokokBahasanModel extends AppModel
{
    use SoftDeletes;
    protected $table = 'r_pokok_bahasan';
    protected $primaryKey = 'pb_id';
    protected $uniqueKey = 'pb_id';

    protected static $_table = 'r_pokok_bahasan';
    protected static $_primaryKey = 'pb_id';
    protected static $_uniqueKey = 'pb_id';

    protected $fillable = [
        'pb_id',
        'deskripsi_pb',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

    public function MataKuliah(){
        return $this->belongsToMany(MatakuliahModel::class,'r_mk_pokokbahasan');
    }
    protected static $cascadeDelete = false;
    protected static $childModel = [
        //  Model => columnFK
        // 'App\Models\Master\DosenModel' => 'jurusan_id'
    ];
}
