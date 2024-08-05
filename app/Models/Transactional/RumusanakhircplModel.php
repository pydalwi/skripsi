<?php

namespace App\Models\Transactional;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Master\ProdiModel;
class RumusanakhircplModel extends Model
{
    use SoftDeletes;
    protected $table = 't_rumusan_akhir_cpl';
    protected $primaryKey = 'rumusan_akhir_cpl_id';
    protected $uniqueKey = '';

    protected static $_table = 't_rumusan_akhir_cpl';
    protected static $_primaryKey = 'rumusan_akhir_cpl_id';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'rumusan_akhir_cpl_id',
        'cpl_prodi_id',
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
