<?php

namespace App\Models\Referensi;

use App\Models\AppModel;
use App\Models\Master\CplModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfilLulusanModel extends AppModel
{
    use SoftDeletes;
    protected $table = 'r_profil_lulusan';
    protected $primaryKey = 'kodeprofil_lulusan_id';
    protected $uniqueKey = '';

    protected static $_table = 'r_profil_lulusan';
    protected static $_primaryKey = 'kodeprofil_lulusan_id';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'kodeprofil_lulusan_id',
        'kodeprofil_lulusan',
        'deskripsi_pl',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

    public function Cpl(){
        return $this->hasMany(CplModel::class);
    }

    protected static $cascadeDelete = false;
    protected static $childModel = [
        //  Model => columnFK
        // 'App\Models\Master\DosenModel' => 'jurusan_id'
    ];
}
