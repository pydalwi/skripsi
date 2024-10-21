<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\Data\CpmkDetailModel;
use App\Models\Master\ProdiModel;
use App\Models\Master\CplProdiModel;
use App\Models\Master\MatkulModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
class CpmkDetailController extends Controller
{
    public function __construct(){
        $this->menuCode  = 'DATA.CPMK.DETAIL';
        $this->menuUrl   = url('data/cpmkdetail');     // set URL untuk menu ini
        $this->menuTitle = 'CPMK-Detail';                       // set nama menu
        $this->viewPath  = 'data.cpmkdetail.';         // untuk menunjukkan direktori view. Diakhiri dengan tanda titik
    }

    public function index(){
        $this->authAction('read');
        $this->authCheckDetailAccess();
        

        $breadcrumb = [
            'title' => $this->menuTitle,
            'list'  => ['Data', 'CPMK-Detail']
        ];

        $activeMenu = [
            'l1' => 'data',
            'l2' => 'data-cpmk-detail',
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

        $data  = CpmkDetailModel::all();

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

        $prodi = ProdiModel::all();
        $cplprodi = CplProdiModel::all();
        $matkul = MatkulModel::all();
        return view($this->viewPath . 'action', compact(['cplprodi'],['matkul'],['prodi']))
            ->with('page', (object) $page);
    }


    public function store(Request $request){
        $this->authAction('create', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {

            $rules = [
                'sub_cpmk_kode' => 'required',
                'uraian_sub_cpmk' => 'required',
                'indikator_sub_cpmk' => 'required',
                'prodi_id' => 'required',
                'cpl_prodi_id' => 'required',
                'mk_id' => 'required',

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

            $res = CpmkDetailModel::insertData($request);

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

        $data = CpmkDetailModel::find($id);

        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'action', compact(['cplprodi'],['matkul'],['prodi']))
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data);
    }


    public function update(Request $request, $id){
        $this->authAction('update', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {

            $rules = [
                'sub_cpmk_kode' => 'required',
                'uraian_sub_cpmk' => 'required',
                'indikator_sub_cpmk' => 'required',
                'prodi_id' => 'required',
                'cpl_prodi_id' => 'required',
                'mk_id' => 'required',
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

            $res = CpmkDetailModel::updateData($id, $request);

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

        $data = CpmkDetailModel::find($id);
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

        $data = CpmkDetailModel::find($id);

        return (!$data)? $this->showModalError() :
            $this->showModalConfirm($this->menuUrl.'/'.$id, [
                'sub_cpmk_kode' => $data->sub_cpmk_kode,
                'uraian_sub_cpmk' => $data->uraian_sub_cpmk,
                'indikator_sub_cpmk' => $data->indikator_sub_cpmk,
                'prodi_id' => $data->prodi_id,
                'cpl_prodi_id' => $data->cpl_prodi_id,
                'mk_id' => $data->mk_id,
            ]);
    }

    public function destroy(Request $request, $id){
        $this->authAction('delete', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {

            $res = CpmkDetailModel::deleteData($id);

            return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => CpmkDetailModel::getDeleteMessage()
            ]);
        }

        return redirect('/');
    }
}
