<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\AppModel;
use App\Models\Master\MkModel;
use App\Models\Data\CpmkDetailModel;
use App\Models\Master\MatkulModel;
use Illuminate\Support\Facades\DB;

class CpmkModel extends AppModel
{
    use SoftDeletes;
    protected $table = 'd_cpmk';
    protected $primaryKey = 'cpmk_id';
    protected $uniqueKey = '';

    protected static $_table = 'd_cpmk';
    protected static $_primaryKey = 'cpmk_id';
    protected static $_uniqueKey = '';

    protected $fillable = [
        'cpmk_id',
        'mk_id',
        'cpmk_kode',
        'cpmk_deskripsi',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

    public function Matakuliah(){
        return $this->belongsTo(MatkulModel::class);
    }
    public function CpmkDetail(){
        return $this->hasMany(CpmkDetailModel::class);
    }
    protected static $cascadeDelete = false;
    protected static $childModel = [
      
    ];
    public static function Cpmk($cpmk_id, array $cpl_cpmk_id,
            )
            {
                
                DB::beginTransaction();
                // print_r($jenis_media);

                try {

                // Insert or update d_rps_cpmk table
                $existingCplCpmk = DB::table('d_cpmk')
                ->where('cpmk_id', $cpmk_id)
                ->whereNull('deleted_at')
                ->get();

                $existingCplCpmkIds = $existingCplCpmk->pluck('rps_cpmk_id')->toArray();

                foreach ($cpl_cpmk_id as $index => $cplCpmkId) {
                // Periksa apakah cpl_prodi_id sudah ada dalam data yang ada dengan deleted_at null
                $existingcpmk = $existingCplCpmk->where('cpl_cpmk_id', $cplCpmkId)
                                            ->whereNull('deleted_at')
                                            ->first();

                if (!$existingcpmk) {
                    // Jika tidak ada data yang cocok dengan deleted_at null, tambahkan data baru
                    DB::table('d_cpmk')->insert([
                        'cpmk_id' => $cpmk_id,
                        'created_at' => now(), // Optional, jika ada kolom created_at
                        'updated_at' => now() // Optional, jika ada kolom updated_at
                    ]);
                    
                }
                }

                DB::commit();
    
                return true; // Jika transaksi berhasil
            } catch (\Exception $e) {
                DB::rollback();
                return false; // Jika terjadi kesalahan
            }
        }
}
