<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\AppModel;
use App\Models\Master\ProdiModel;

class KaprodiModel extends AppModel
{
    use SoftDeletes;
    protected $table = 'd_kaprodi';
    protected $primaryKey = 'kaprodi_id';
    protected $uniqueKey = '';

    protected static $_table = 'd_kaprodi';
    protected static $_primaryKey = 'kaprodi_id';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'kaprodi_id',
        'prodi_id',
        'tahun',
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
    protected static $cascadeDelete = false;
    protected static $childModel = [
      
    ];
}