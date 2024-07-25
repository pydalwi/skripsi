<?php

namespace App\Models\Transactional;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RumusanakhirmkModel extends Model
{
    use SoftDeletes;
    protected $table = 't_rumusan_akhir_mk';
    protected $primaryKey = 'rumusan_akhir_mk_id';
    protected $uniqueKey = '';

    protected static $_table = 't_rumusan_akhir_mk';
    protected static $_primaryKey = 'rumusan_akhir_mk_id';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'rumusan_akhir_mk_id',
        'cpl_prodi_id',
        'cpmk_id',
        'mk_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

   
}
