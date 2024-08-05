<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Dosen\DosenModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class DosenController extends Controller
{
    public function __construct(){
        $this->menuCode  = 'DOSEN.KELOLADOSEN';
        $this->menuUrl   = url('dosen/kelola_dosen');     // set URL untuk menu ini
        $this->menuTitle = 'Kelola Dosen';                       // set nama menu
        $this->viewPath  = 'dosen.kelola_dosen.';         // untuk menunjukkan direktori view. Diakhiri dengan tanda titik
    }

    public function index(){
        $this->authAction('read');
        $this->authCheckDetailAccess();

        $breadcrumb = [
            'title' => $this->menuTitle,
            'list'  => ['Data Dosen', 'Kelola Dosen']
        ];

        $activeMenu = [
            'l1' => 'dosen',
            'l2' => 'dosen-kelola_dosen',
            'l3' => null
        ];

        $page = [
            'url' => $this->menuUrl,
            'title' => 'Daftar '. $this->menuTitle
        ];

        return view($this->viewPath . 'index')
            ->with('breadcrumb', (object) $breadcrumb)
            ->with('activeMenu', (object) $activeMenu)
            ->with('page', (object) $page)
            ->with('allowAccess', $this->authAccessKey());
    }

    public function list(Request $request){
        $this->authAction('read', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $data  = DosenModel::selectRaw("dosen_id, nama_dosen,nip,nidn");

        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }


    public function create(){
        $this->authAction('create', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $page = [
            'url' => $this->menuUrl,
            'title' => 'Tambah ' . $this->menuTitle
        ];

        return view($this->viewPath . 'action')
            ->with('page', (object) $page);
    }
    

    public function store(Request $request){
        $this->authAction('create', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {

            $rules = [
                'nama_dosen' => 'required|string|max:100',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'stat'     => false,
                    'mc'       => false,
                    'msg'      => 'Terjadi kesalahan.',
                    'msgField' => $validator->errors()
                ]);
            }

            $res = DosenModel::insertData($request);

            return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => ($res)? $this->getMessage('insert.success') : $this->getMessage('insert.failed')
            ]);

        }

        return redirect('/');
    }

    public function edit($id){
        $this->authAction('update', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $page = [
            'url' => $this->menuUrl . '/'.$id,
            'title' => 'Edit ' . $this->menuTitle
        ];

        $data = DosenModel::find($id);

        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'action')
                ->with('page', (object) $page)
                ->with('id', $id);
    }


    public function update(Request $request, $id){
        $this->authAction('update', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {

            $rules = [
                'nama_dosen' => 'required|string|max:100',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'stat'     => false,
                    'mc'       => false,
                    'msg'      => 'Terjadi kesalahan.',
                    'msgField' => $validator->errors()
                ]);
            }

            $res = DosenModel::updateData($id, $request);

            return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => ($res)? $this->getMessage('update.success') : $this->getMessage('update.failed')
            ]);
        }

        return redirect('/');
    }

    public function show($id) {
        $this->authAction('read', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $data = DosenModel::find($id);
        $page = [
            'title' => 'Detail ' . $this->menuTitle
        ];

        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'detail')
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data);
    }

    public function confirm($id){
        $this->authAction('delete', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $data = DosenModel::find($id);

        return (!$data)? $this->showModalError() :
            $this->showModalConfirm($this->menuUrl.'/'.$id, [
                'Kode' => $data->jurusan_code,
                'Jurusan' => $data->jurusan_name,
            ]);
    }

    public function destroy(Request $request, $id){
        $this->authAction('delete', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {

            return response()->json([
                'stat' => false,
                'mc' => false, // close modal
                'msg' => 'Periode tidak dapat dihapus.'
            ]);
        }

        return redirect('/');
    }
}

