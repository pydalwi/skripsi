<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\Data\StrukturmkModel;
use Illuminate\Http\Request;
use App\Models\Master\MatkulModel;
use App\Models\Master\CplProdiModel;
use App\Models\Master\ProdiModel;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class StrukturmkController extends Controller
{
    public function __construct(){
        $this->menuCode  = 'DATA.STRUKTURMKCPL';
        $this->menuUrl   = url('data/strukturmkcpl');     // set URL untuk menu ini
        $this->menuTitle = 'Struktur MK-CPL';                       // set nama menu
        $this->viewPath  = 'data.strukturmkcpl.';         // untuk menunjukkan direktori view. Diakhiri dengan tanda titik
    }

    public function index(){
        $this->authAction('read');
        $this->authCheckDetailAccess();

        $breadcrumb = [
            'title' => $this->menuTitle,
            'list'  => ['Data', 'Struktur MK-CPL']
        ];

        $activeMenu = [
            'l1' => 'data',
            'l2' => 'data-struktur',
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
            ->with('data',  $data)
            ->with('allowAccess', $this->authAccessKey());
    }

    public function list(Request $request){
   //     $this->authAction('read', 'json');
   //     if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();
//
   //     $data  = StrukturmkModel::all();
//
   //     return DataTables::of($data)
   //         ->addIndexColumn()
   //         ->make(true);
    }


    public function create(){
        $this->authAction('create', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $page = [
            'url' => $this->menuUrl,
            'title' => 'Tambah ' . $this->menuTitle
        ];
        $cplprodi = CplProdiModel::all();
        $prodi = ProdiModel::all();
        $krklm = StrukturmkModel::all();
        return view($this->viewPath . 'action',compact(['prodi']))
            ->with('krklm',$krklm)
            ->with('page', (object) $page);
    }


    public function store(Request $request){
  //      $this->authAction('create', 'json');
  //      if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();
//
  //      if ($request->ajax() || $request->wantsJson()) {
//
  //          $rules = [
  //              'cpl_prodi_id' => 'required',
  //              'mk_id' => 'required',
  //              'struktur_mk_id' => 'required'
  //          ];
//
  //          $validator = Validator::make($request->all(), $rules);
//
  //          if ($validator->fails()) {
  //              return response()->json([
  //                  'stat'     => false,
  //                  'mc'       => false,
  //                  'msg'      => 'Terjadi kesalahan.',
  //                  'msgField' => $validator->errors()
  //              ]);
  //          }
//
  //          $res = StrukturmkModel::insertData($request);
//
  //          return response()->json([
  //              'stat' => $res,
  //              'mc' => $res, // close modal
  //              'msg' => ($res)? $this->getMessage('insert.success') : $this->getMessage('insert.failed')
  //          ]);
//
  //      }
//
  //      return redirect('/');
    }

    public function edit($id){
        $this->authAction('update', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $page = [
            'url' => $this->menuUrl . '/'.$id,
            'title' => 'Edit ' . $this->menuTitle
        ];

        $data = StrukturmkModel::find($id);
        $krklm = StrukturmkModel::all();
        $prodi = ProdiModel::all();
        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'action', compact(['prodi']))
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('krklm',$krklm)
                ->with('data', $data);
                
    }


    public function update(Request $request, $id){
        $this->authAction('update', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {

            $rules = [
                'cpl_prodi_id' => 'required',
                'mk_id' => 'required',
                'struktur_mk_id' => 'required'

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

            $res = StrukturmkModel::updateData($id, $request);

            return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => ($res)? $this->getMessage('update.success') : $this->getMessage('update.failed')
            ]);
        }

        return redirect('/');
    }

    public function show($id){
   //     $this->authAction('read', 'modal');
   //     if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();
//
   //     $data = StrukturmkModel::find($id);
   //     $page = [
   //         'title' => 'Detail ' . $this->menuTitle
   //     ];
//
   //     return (!$data)? $this->showModalError() :
   //         view($this->viewPath . 'detail')
   //             ->with('page', (object) $page)
   //             ->with('id', $id)
   //             ->with('data', $data);
    }


    public function confirm($id){
        $this->authAction('delete', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $data = StrukturmkModel::find($id);

        return (!$data)? $this->showModalError() :
            $this->showModalConfirm($this->menuUrl.'/'.$id, [
                'cpl_prodi_id' => 'required',
                'mk_id' => 'required',
                'struktur_mk_id' => 'required'

            ]);
    }

    public function destroy(Request $request, $id){
  //      $this->authAction('delete', 'json');
  //      if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();
//
  //      if ($request->ajax() || $request->wantsJson()) {
//
  //          $rs = StrukturmkModel::deleteData($id);
  //          return response()->json([
  //              'stat' => $rs,
  //              'mc' => $rs, // close modal
  //              'msg' => StrukturmkModel::getDeleteMessage()
  //          ]);
  //      }
//
  //      return redirect('/');
    }
}
