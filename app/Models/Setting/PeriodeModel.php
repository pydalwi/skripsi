<?php

namespace App\Models\Setting;

use App\Models\AppModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeriodeModel extends AppModel
{
    use SoftDeletes;

    protected $table = 'm_periode';
    protected $primaryKey = 'periode_id';

    protected static $_table = 'm_periode';
    protected static $_primaryKey = 'periode_id';

    protected $fillable = [
        'periode_name',
        'periode_semester',
        'is_active',
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

    public static function findKurikulumMKByPeriode($periodeId)
    {
        $data = DB::table('d_kurikulum_mk AS dkm')
            ->select('dkm.kurikulum_mk_id', 'm.mk_nama', 'dkm.periode_id')
            ->join('m_mk AS m', 'dkm.mk_id', '=', 'm.mk_id')
            ->where('dkm.periode_id', $periodeId)
            ->get();

        return $data;
    }
    public static function clearPeriodeId($kurikulumMkIds)
    {
        DB::table('d_kurikulum_mk')
            ->whereIn('kurikulum_mk_id', $kurikulumMkIds)
            ->update(['periode_id' => null]);

        return true;
    }

    public static function updateKurikulumMKPeriode($kurikulumMkIds, $newPeriodeId)
    {
        DB::table('d_kurikulum_mk')
            ->whereIn('kurikulum_mk_id', $kurikulumMkIds)
            ->update(['periode_id' => $newPeriodeId]);

        return true;
    }

    public static function getSelectedMataKuliah($periodeId)
    {
        return DB::table('d_kurikulum_mk AS dkm')
            ->select('dkm.kurikulum_mk_id', 'm.mk_nama', 'dkm.periode_id')
            ->join('m_mk AS m', 'dkm.mk_id', '=', 'm.mk_id')
            ->where('dkm.periode_id', $periodeId)
            ->get();
    }

    public static function getAllMataKuliah()
    {
        return DB::table('d_kurikulum_mk AS dkm')
            ->select('dkm.kurikulum_mk_id', 'm.mk_nama')
            ->join('m_mk AS m', 'dkm.mk_id', '=', 'm.mk_id')
            ->get();
    }
    public static function filterMataKuliahByKurikulum($kurikulumId)
    {
        return DB::table('d_kurikulum_mk AS dkm')
            ->select('dkm.kurikulum_mk_id', 'm.mk_nama')
            ->join('m_mk AS m', 'dkm.mk_id', '=', 'm.mk_id')
            ->where('dkm.kurikulum_id', $kurikulumId)
            ->get();
    }
}