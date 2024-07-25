<?php

namespace App\Models\Master;

use App\Models\AppModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MkcpmkModel extends AppModel
{
    use HasFactory;
    protected $table = 'm_mkcpmk'; 
    protected $primaryKey = '';
    protected $uniqueKey = '';
    protected static $_table = 'm_mkcpmk';
    protected static $_primaryKey = '';
    protected static $_uniqueKey = '';
    protected $fillable = [
        'cpmk_id',
        'mk_id',
        'prodi_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];
}
