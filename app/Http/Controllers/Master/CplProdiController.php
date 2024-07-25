<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\CplProdiModel;
use App\Models\Master\PLModel;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
class CplProdiController extends Controller
{
   
    public function __construct(){
        $this->menuCode  = 'MASTER.CPLPRODI';
        $this->menuUrl   = url('master/cplprodi');     // set URL untuk menu ini
        $this->menuTitle = 'CPL-PRODI';                       // set nama menu
        $this->viewPath  = 'master.cplprodi.';         // untuk menunjukkan direktori view. Diakhiri dengan tanda titik
    }

    public function index(){
        $this->authAction('read');
        $this->authCheckDetailAccess();

        $breadcrumb = [
            'title' => $this->menuTitle,
            'list'  => ['Data Master', 'CPL-PRODI']
        ];

        $activeMenu = [
            'l1' => 'master',
            'l2' => 'master-cpl-prodi',
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

        $data  = CplProdiModel::all();
        $profil_lulusan = PLModel::all();
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
        $cplprodi = CplProdiModel::all();
        $profil_lulusan = PLModel::join('m_prodi','m_profil_lulusan.prodi_id','=','m_prodi.prodi_id')->get();
        return view($this->viewPath . 'action', compact(['profil_lulusan']))
            ->with('page', (object) $page);
    }


    public function store(Request $request){
        $this->authAction('create', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {

            $rules = [
                'cpl_prodi_kode' => 'required',
                'cpl_prodi_deskripsi' => 'required',
                'cpl_prodi_kategori' => 'required',
                'pl_id' => 'required',
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

            $res = CplProdiModel::insertData($request);

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

        $data = CplProdiModel::find($id);
        $profil_lulusan = PLModel::join('m_prodi','m_profil_lulusan.prodi_id','=','m_prodi.prodi_id')->get();
        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'action', compact(['profil_lulusan']))
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data);
    }


    public function update(Request $request, $id){
        $this->authAction('update', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {

            $rules = [
                'cpl_prodi_kode' => 'required',
                'cpl_prodi_deskripsi' => 'required',
                'cpl_prodi_kategori' => 'required',
                'pl_id' => 'required'
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

            $res = CplProdiModel::updateData($id, $request);

            return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => ($res)? $this->getMessage('update.success') : $this->getMessage('update.failed')
            ]);
        }

        return redirect('/');
    }

    public function show($id){
        $this->authAction('read', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $data = CplProdiModel::find($id);
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

        $data = CplProdiModel::find($id);
        
        return (!$data)? $this->showModalError() :
            $this->showModalConfirm($this->menuUrl.'/'.$id, [
                'cpl_Prodi_kode' => $data->cpl_prodi_kode,
                'cpl_Prodi_deskripsi' => $data->cpl_prodi_deskripsi,
                'cpl_Prodi_kategori' => $data->cpl_prodi_kategori,
                'pl_id' => $data->pl_id
            ]);
    }

    public function destroy(Request $request, $id){
        $this->authAction('delete', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {

            $rs = CplProdiModel::deleteData($id);
            return response()->json([
                'stat' => $rs,
                'mc' => $rs, // close modal
                'msg' => CplProdiModel::getDeleteMessage()
            ]);
        }

        return redirect('/');
    }
}


