<?php

namespace App\Models\Setting;

use App\Models\AppModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuModel extends AppModel
{
    use SoftDeletes;

    protected $table = 's_menu';
    protected $primaryKey = 'menu_id';
    protected $uniqueKey = 'menu_code';

    protected static $_table = 's_menu';
    protected static $_primaryKey = 'menu_id';
    protected static $_uniqueKey = 'menu_code';

    protected $fillable = [
            'menu_code',
            'menu_name',
            'menu_url',
            'menu_level',
            'order_no',
            'parent_id',
            'class_tag',
            'icon',
            'is_active',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'deleted_at',
            'deleted_by'
        ];

    public static function insertData($request, $exception = []){
        $data = $request->except(['_token', '_method']);
        $data['menu_scope'] = "ALL";
        $data['created_by'] = Auth::user()->user_id;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['menu_code'] = strtoupper($data['menu_code']);

        return self::insert($data);     // return status insert data
    }

    public static function updateData($id, $request, $exception = []){
        $data = $request->except(['_token', '_method']);
        $data['menu_scope'] = "ALL";
        $data['updated_by'] = Auth::user()->user_id;
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['menu_code'] = strtoupper($data['menu_code']);

        return self::where('menu_id', $id)
            ->update($data);
    }
    protected static $cascadeDelete = false;
    protected static $childModel = [
        //  Model => columnFK
        // 'App\Models\Master\DosenModel' => 'jurusan_id'
    ];
}
