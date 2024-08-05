<?php

namespace App\Models;

use App\Models\AppModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class KurikulumMKModel extends AppModel
{
    use SoftDeletes;

    protected $table = 'd_kurikulum_mk';
    protected $primaryKey = 'kurikulum_mk_id';

    protected static $_table = 'd_kurikulum_mk';
    protected static $_primaryKey = 'kurikulum_mk_id';

    protected $fillable = [
        'kurikulum_mk_id',
        'kurikulum_id',
        'rumpun_mk_id',
        'mk_id',
        'prodi_id',
        'kode_mk',
        'sks',
        'semester',
        'jumlah_jam',
        'kelompok_mk',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

    protected static $cascadeDelete = false;   //  True: Force Delete from Parent (cascade)
    protected static $childModel = [
        //  Model => columnFK
        //'App\Models\Master\EmployeeModel' => 'jabatan_id'
    ];

    
    public static function getMks()
{
    $periode = session('periode');
    
    if (!$periode || !isset($periode->periode_id)) {
        // Handle the case where periode is not set in session
        return collect();
    }

    $selectedPeriodeId = $periode->periode_id;

    $map = DB::table('t_kakel_mk AS tk')
        ->selectRaw('m.kurikulum_mk_id, m.kode_mk, k.mk_nama, COUNT(r.kurikulum_mk_id) > 0 AND r.deleted_at IS NULL AS is_frozen')
        ->join('d_kurikulum_mk AS m', 'tk.kurikulum_mk_id', '=', 'm.kurikulum_mk_id')
        ->join('m_mk AS k', 'm.mk_id', '=', 'k.mk_id')
        ->leftJoin('m_rps AS r', 'm.kurikulum_mk_id', '=', 'r.kurikulum_mk_id')
        ->join('m_periode AS p', 'm.periode_id', '=', 'p.periode_id')
        ->where('p.periode_id', $selectedPeriodeId)
        ->groupBy('m.kurikulum_mk_id', 'k.mk_nama')
        ->get();

    return $map;
}



public static function getMksId($rps_id)
{
    $map = DB::table('d_kurikulum_mk AS m')
        ->selectRaw('m.kurikulum_mk_id, k.mk_nama')
        ->join('m_mk AS k', 'm.mk_id', '=', 'k.mk_id')
        ->leftJoin('m_rps AS r', 'm.kurikulum_mk_id', '=', 'r.kurikulum_mk_id')
        ->groupBy('m.kurikulum_mk_id', 'k.mk_nama')
        ->where('r.rps_id', $rps_id)
        ->get();

    return $map;
}

public static function getMksWithSelected($selectedId)
{
    return DB::table('d_kurikulum_mk AS m')
        ->selectRaw('m.kurikulum_mk_id, k.mk_nama, COUNT(r.kurikulum_mk_id) > 0 AND r.deleted_at IS NULL AS is_frozen')
        ->join('m_mk AS k', 'm.mk_id', '=', 'k.mk_id')
        ->leftJoin('m_rps AS r', 'm.kurikulum_mk_id', '=', 'r.kurikulum_mk_id')
        ->groupBy('m.kurikulum_mk_id', 'k.mk_nama')
        ->get()
        ->map(function($item) use ($selectedId) {
            $item->selected = $item->kurikulum_mk_id == $selectedId;
            return $item;
        });
}


}

