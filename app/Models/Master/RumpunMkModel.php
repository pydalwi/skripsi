<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AppModel;
use App\Models\Data\KurikulumModel;
use App\Models\Data\KurikulumMkModel;

class RumpunMkModel extends AppModel
{
    use SoftDeletes;
    protected $table = 'm_rumpun_mk';
    protected $primaryKey = 'rumpun_mk_id';
    protected $uniqueKey = '';

    protected static $_table = 'm_rumpun_mk';
    protected static $_primaryKey = 'rumpun_mk_id';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'rumpun_mk_id',
        'kurikulum_id',
        'dosen_id',
        'rumpun_mk',
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
    public function KurikulumMk(){
        return $this->hasMany(KurikulumMkModel::class);
    }
    protected static $cascadeDelete = false;
    protected static $childModel = [
      
    ];
}
