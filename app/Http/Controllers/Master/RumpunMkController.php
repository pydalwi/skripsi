<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\RumpunMkModel;
use App\Models\Master\MatkulModel;
use Illuminate\Support\Facades\Validator;
class RumpunMkController extends Controller
{
     public function __construct(){
        $this->menuCode  = 'MASTER.RUMPUNMK';
        $this->menuUrl   = url('master/rumpunmk');     // set URL untuk menu ini
        $this->menuTitle = 'Rumpun-MK';                       // set nama menu
        $this->viewPath  = 'master.rumpun_mk.';         // untuk menunjukkan direktori view. Diakhiri dengan tanda titik
    }

    public function index(){
        $this->authAction('read');
        $this->authCheckDetailAccess();

        $breadcrumb = [
            'title' => $this->menuTitle,
            'list'  => ['Data Master', 'Rumpun-MK']
        ];

        $activeMenu = [
            'l1' => 'master',
            'l2' => 'master-rumpun-mk',
            'l3' => null
        ];

        $page = [
            'url' => $this->menuUrl,
            'title' => 'Daftar '. $this->menuTitle
        ];

        $data = MatkulModel::all();
        return view($this->viewPath . 'index')
            ->with('breadcrumb', (object) $breadcrumb)
            ->with('activeMenu', (object) $activeMenu)
            ->with('page', (object) $page)
            ->with('data',$data)
            ->with('allowAccess', $this->authAccessKey());
    }

    public function list(Request $request){
        // $this->authAction('read', 'json');
        // if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        // $data  = JurusanModel::selectRaw("jurusan_id, jurusan_name, jurusan_code");

        // return DataTables::of($data)
        //     ->addIndexColumn()
        //     ->make(true);
    }


    public function create(){
        $this->authAction('create', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $page = [
            'url' => $this->menuUrl,
            'title' => 'Tambah ' . $this->menuTitle
        ];

        $data = RumpunMkModel::all();
        $krklm = RumpunMkModel::all();

        return view($this->viewPath . 'action')
            
            
            ->with('krklm',$krklm)
            ->with('page', (object) $page);
    }


    public function store(Request $request){
        // $this->authAction('create', 'json');
        // if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        // if ($request->ajax() || $request->wantsJson()) {

        //     $rules = [
        //         'jurusan_code' => ['required', 'string', 'max:10', JurusanModel::setUniqueInsert()],
        //         'jurusan_name' => 'required|string|max:100',
        //     ];

        //     $validator = Validator::make($request->all(), $rules);

        //     if ($validator->fails()) {
        //         return response()->json([
        //             'stat'     => false,
        //             'mc'       => false,
        //             'msg'      => 'Terjadi kesalahan.',
        //             'msgField' => $validator->errors()
        //         ]);
        //     }

        //     $res = JurusanModel::insertData($request);

        //     return response()->json([
        //         'stat' => $res,
        //         'mc' => $res, // close modal
        //         'msg' => ($res)? $this->getMessage('insert.success') : $this->getMessage('insert.failed')
        //     ]);

        // }

        // return redirect('/');
    }

    public function edit($id){
        $this->authAction('update', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $page = [
            'url' => $this->menuUrl . '/'.$id,
            'title' => 'Edit ' . $this->menuTitle
        ];

        $data = RumpunMkModel::find($id);
        $krklm = RumpunMkModel::all();

        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'action')
                ->with('page', (object) $page)
                ->with('krklm', $krklm)
                ->with('id', $id)
                ->with('data', $data);
    }


    public function update(Request $request, $id){
        // $this->authAction('update', 'json');
        // if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        // if ($request->ajax() || $request->wantsJson()) {

        //     $rules = [
        //         'jurusan_code' => ['required', 'string', 'max:10', JurusanModel::setUniqueInsertIgnore($id)],
        //         'jurusan_name' => 'required|string|max:100',
        //     ];

        //     $validator = Validator::make($request->all(), $rules);

        //     if ($validator->fails()) {
        //         return response()->json([
        //             'stat'     => false,
        //             'mc'       => false,
        //             'msg'      => 'Terjadi kesalahan.',
        //             'msgField' => $validator->errors()
        //         ]);
        //     }

        //     $res = JurusanModel::updateData($id, $request);

        //     return response()->json([
        //         'stat' => $res,
        //         'mc' => $res, // close modal
        //         'msg' => ($res)? $this->getMessage('update.success') : $this->getMessage('update.failed')
        //     ]);
        // }

        // return redirect('/');
    }

    public function show($id){
        // $this->authAction('read', 'modal');
        // if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        // $data = JurusanModel::find($id);
        // $page = [
        //     'title' => 'Detail ' . $this->menuTitle
        // ];

        // return (!$data)? $this->showModalError() :
        //     view($this->viewPath . 'detail')
        //         ->with('page', (object) $page)
        //         ->with('id', $id)
        //         ->with('data', $data);
    }


    public function confirm($id){
        $this->authAction('delete', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $data = RumpunMkModel::find($id);

        return (!$data)? $this->showModalError() :
            $this->showModalConfirm($this->menuUrl.'/'.$id, [
                'Kode Matkul' => $data->kode_mk,
                'Nama Matkul' => $data->nama_mk,
                'Jenis Matkul' =>  $data->jenis_mk,
            ]);
    }

    public function destroy(Request $request, $id){
        // $this->authAction('delete', 'json');
        // if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        // if ($request->ajax() || $request->wantsJson()) {

        //     return response()->json([
        //         'stat' => false,
        //         'mc' => false, // close modal
        //         'msg' => 'Periode tidak dapat dihapus.'
        //     ]);
        // }

        // return redirect('/');
    }
}
