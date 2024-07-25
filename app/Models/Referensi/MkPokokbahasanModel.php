<?php

namespace App\Models\Referensi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MkPokokbahasanModel extends Model
{
    use SoftDeletes;
    protected $table = 'r_mk_pokokbahasan';
    protected $primaryKey = '';
    protected $uniqueKey = '';

    protected static $_table = 'r_mk_pokokbahasan';
    protected static $_primaryKey = '';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'pokok_bahasan_model_pb_id',
        'matakuliah_model_mk_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];
}
