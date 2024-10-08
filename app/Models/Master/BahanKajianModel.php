<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\AppModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Master\ProdiModel;


class BahanKajianModel extends AppModel
{
    use SoftDeletes;
    protected $table = 'm_bahan_kajian';
    protected $primaryKey = 'bk_id';
    protected $uniqueKey = '';

    protected static $_table = 'm_bahan_kajian';
    protected static $_primaryKey = 'bk_id';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'bk_id',
        'prodi_id',
        'bk_kategori',
        'bk_kode',
        'bk_deskripsi',
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

    public static function bktampil()
    {
         return DB::table('t_mk_bk AS tm')
            ->join('m_mk AS mk', 'tm.mk_id', '=', 'mk.mk_id')
            ->join('m_bahan_kajian AS bk', 'tm.bk_id', '=', 'bk.bk_id')
            ->join('m_prodi AS prodi', 'bk.prodi_id', '=', 'prodi.prodi_id')
            ->select('tm.*','mk.mk_nama', 'bk.bk_deskripsi', 'prodi.nama_prodi')
            ->orderBy('tm.mk_bk_id', 'asc')
            ->get();
    }

    public static function insertDatabk($request)
    {
        try {
            DB::beginTransaction();

            // Insert data into m_bahan_kajian
            $bkId = DB::table('m_bahan_kajian')->insertGetId([
                'prodi_id' => $request->input('prodi_id'),
                'bk_kode' => $request->input('bk_kode'),
                'bk_deskripsi' => $request->input('bk_deskripsi')
            ]);

            // Insert data into t_mk_bk
            DB::table('t_mk_bk')->insert([
                'bk_id' => $bkId,
                'mk_id' => $request->input('mk_id')
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public static function getDataForEdit($id)
    {
        return DB::table('t_mk_bk AS tm')
            ->join('m_bahan_kajian AS bk', 'tm.bk_id', '=', 'bk.bk_id')
            ->select('tm.mk_bk_id', 'bk.prodi_id', 'tm.mk_id', 'bk.bk_kode', 'bk.bk_deskripsi')
            ->where('tm.mk_bk_id', $id)
            ->first();
    }



}
