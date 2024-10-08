<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\CplProdiModel;
use App\Models\Master\ProdiModel;
use App\Models\Master\CplIndikatorModel;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
class CplIndikatorController extends Controller
{
   
    public function __construct(){
        $this->menuCode  = 'MASTER.CPLINDIKATOR';
        $this->menuUrl   = url('master/cplindikator');     // set URL untuk menu ini
        $this->menuTitle = 'CPL Indikator';                       // set nama menu
        $this->viewPath  = 'master.cplindikator.';         // untuk menunjukkan direktori view. Diakhiri dengan tanda titik
    }

    public function index(){
        $this->authAction('read');
        $this->authCheckDetailAccess();

        $breadcrumb = [
            'title' => $this->menuTitle,
            'list'  => ['Data Master', 'CPL Indikator']
        ];

        $activeMenu = [
            'l1' => 'master',
            'l2' => 'master-cpl-indikator',
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

        $data  = CplIndikatorModel::all();
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
        $cplindikator = CplIndikatorModel::all();
        $prodi = ProdiModel::all();
        $cplprodi = CplProdiModel::all();
        return view($this->viewPath . 'action', compact(['prodi'],['cplprodi']))
            ->with('page', (object) $page);
    }


    public function store(Request $request){
        $this->authAction('create', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {

            $rules = [
                'cpl_prodi_id' => 'required',
                'cpl_indikator_kode' => 'required',
                'cpl_indikator_kinerja' => 'required',
                'prodi_id' => 'required',
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

            $res = CplIndikatorModel::insertData($request);

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

        $data = CplIndikatorModel::find($id);
        $prodi = ProdiModel::all();
        $cplprodi = CplProdiModel::all();
        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'action', compact(['prodi'],['cplprodi']))
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data);
    }


    public function update(Request $request, $id){
        $this->authAction('update', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {

            $rules = [
                'cpl_prodi_id' => 'required',
                'cpl_indikator_kode' => 'required',
                'cpl_indikator_kinerja' => 'required',
                'prodi_id' => 'required',
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

            $res = CplIndikatorModel::updateData($id, $request);

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

        $data = CplIndikatorModel::find($id);
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

        $data = CplIndikatorModel::find($id);
        
        return (!$data)? $this->showModalError() :
            $this->showModalConfirm($this->menuUrl.'/'.$id, [
                'cpl_prodi_id' => $data->cpl_prodi_id,
                'cpl_indikator_kode' => $data->cpl_indikator_kode,
                'cpl_indikator_kinerja' => $data->cpl_indikator_kinerja,
                'prodi_id' => $data->prodi_id
            ]);
    }

    public function destroy(Request $request, $id){
        $this->authAction('delete', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {

            $rs = CplIndikatorModel::deleteData($id);
            return response()->json([
                'stat' => $rs,
                'mc' => $rs, // close modal
                'msg' => CplIndikatorModel::getDeleteMessage()
            ]);
        }

        return redirect('/');
    }
}
