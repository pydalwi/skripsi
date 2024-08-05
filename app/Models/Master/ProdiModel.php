<?php

namespace App\Models\Master;

use App\Models\AppModel;
use App\Models\Data\KurikulumModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\Data\KurikulumMkModel;
use App\Models\Master\CplSndiktiModel;
use App\Models\Master\CplProdiModel;
use App\Models\Master\BahanKajianModel;
use App\Models\Master\PLModel;
use App\Models\Data\KaprodiModel;

class ProdiModel extends AppModel
{
    use SoftDeletes;

    protected $table = 'm_prodi';
    protected $primaryKey = 'prodi_id';
    protected $uniqueKey = 'prodi_id';

    protected static $_table = 'm_prodi';
    protected static $_primaryKey = 'prodi_id';
    protected static $_uniqueKey = 'prodi_id';

    protected $fillable = [
        'prodi_id',
        'nama_prodi',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

    public function Kurikulum(){
        return $this->hasMany(KurikulumModel::class);
    }
    public function KurikulumMK(){
        return $this->hasMany(KurikulumMKModel::class);
    }
    public function BahanKajian(){
        return $this->hasMany(BahanKajianModel::class);
    }
    public function CplProdi(){
        return $this->hasMany(CplProdiModel::class);
    }
    public function CplSndikti(){
        return $this->hasMany(CplSndiktiModel::class);
    }
    public function ProfilLulusan(){
        return $this->belongsTo(PLModel::class);
    }
    public function Kaprodi(){
        return $this->hasMany(KaprodiModel::class);
    }
    protected static $cascadeDelete = false;
    protected static $childModel = [
     
    ];

}
