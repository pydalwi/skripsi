<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\CplsndiktiModel;
use App\Models\Master\ProdiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
class CplSndiktiController extends Controller
{
    public function __construct(){
        $this->menuCode  = 'MASTER.CPLSNDIKTI';
        $this->menuUrl   = url('master/cplsndikti');     // set URL untuk menu ini
        $this->menuTitle = 'CPL-SNDIKTI';                       // set nama menu
        $this->viewPath  = 'master.cplsndikti.';         // untuk menunjukkan direktori view. Diakhiri dengan tanda titik
    }

    public function index(){
        $this->authAction('read');
        $this->authCheckDetailAccess();

        $breadcrumb = [
            'title' => $this->menuTitle,
            'list'  => ['Data Master', 'CPL-SNDIKTI']
        ];

        $activeMenu = [
            'l1' => 'master',
            'l2' => 'master-cpl-sndikti',
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

        $data  = CplsndiktiModel::all();

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
        $cplsndikti = CplsndiktiModel::all();
        $prodi = ProdiModel::all();
       
        return view($this->viewPath . 'action', compact(['prodi']))
            ->with('page', (object) $page);
            
    }


    public function store(Request $request){
        $this->authAction('create', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {

            $rules = [
                'cpl_sndikti_kode' => 'required',
                'cpl_sndikti_deskripsi' => 'required',
                'cpl_sndikti_kategori' => 'required',
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

            $res = CplsndiktiModel::insertData($request);

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

        $data = CplsndiktiModel::find($id);
        $prodi = ProdiModel::find($id);
   
        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'action', compact(['prodi']))
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data);
    }


    public function update(Request $request, $id){
        $this->authAction('update', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {

            $rules = [
                'cpl_sndikti_kode' => 'required',
                'cpl_sndikti_deskripsi' => 'required',
                'cpl_sndikti_kategori' => 'required',
                'prodi_id' => 'required'
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

            $res = CplsndiktiModel::updateData($id, $request);

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

        $data = CplsndiktiModel::find($id);
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

        $data = CplsndiktiModel::find($id);
        
        return (!$data)? $this->showModalError() :
            $this->showModalConfirm($this->menuUrl.'/'.$id, [
                'cpl_sndikti_kode' => $data->cpl_sndikti_kode,
                'cpl_sndikti_deskripsi' => $data->cpl_sndikti_deskripsi,
                'cpl_sndikti_kategori' => $data->cpl_sndikti_kategori,
                'prodi_id' => $data->prodi_id
            ]);
    }

    public function destroy(Request $request, $id){
        $this->authAction('delete', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {

            $rs = CplsndiktiModel::deleteData($id);
            return response()->json([
                'stat' => $rs,
                'mc' => $rs, // close modal
                'msg' => CplsndiktiModel::getDeleteMessage()
            ]);
        }

        return redirect('/');
    }
}
