<?php

namespace App\Models\Master;

use App\Models\AppModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class MkcplModel extends AppModel
{
    use SoftDeletes;
    protected $table = 'm_mkcpl';
    protected $primaryKey = '';
    protected $uniqueKey = '';
    protected static $_table = 'm_mkcpl';
    protected static $_primaryKey = '';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'cpl_id',
        'mk_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];
}
