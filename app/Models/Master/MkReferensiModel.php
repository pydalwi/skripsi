<?php

namespace App\Models\Master;

use App\Models\AppModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class MkReferensiModel extends AppModel
{
    use SoftDeletes;
    protected $table = 'm_mkreferensi';
    protected $primaryKey = '';
    protected $uniqueKey = '';

    protected static $_table = 'm_mkreferensi';
    protected static $_primaryKey = '';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'referensi_model_ref_id',
        'matakuliah_model_mk_id',
        'prodi_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];
}
