<?php

namespace App\Models\Master;

use App\Models\Master\ProdiModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AppModel;
use App\Models\Data\CplPlModel;

class PLModel extends AppModel
{
    use SoftDeletes;

    protected $table = 'm_profil_lulusan';
    protected $primaryKey = 'pl_id';
    protected $uniqueKey = '';

    protected static $_table = 'm_profil_lulusan';
    protected static $_primaryKey = 'pl_id';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'pl_id',
        'kode_pl',
        'prodi_id',
        'deskripsi_pl',
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
    public function CplPl(){
        return $this->hasMany(CplPlModel::class);
    }
    public function CplSndikti(){
        return $this->hasMany(CplSndiktiModel::class);
    }

    protected static $cascadeDelete = false;
    protected static $childModel = [
       
    ];

}
