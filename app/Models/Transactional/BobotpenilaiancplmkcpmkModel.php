<?php

namespace App\Models\Transactional;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BobotpenilaiancplmkcpmkModel extends Model
{
    use SoftDeletes;
    protected $table = 't_bobot_penilaian_cpl_mk_cpmk';
    protected $primaryKey = 'bobot_penilaian_cpl_mk_cpmk_id';
    protected $uniqueKey = '';

    protected static $_table = 't_bobot_penilaian_cpl_mk_cpmk';
    protected static $_primaryKey = 'bobot_penilaian_cpl_mk_cpmk_id';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'bobot_penilaian_cpl_mk_cpmk_id',
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
