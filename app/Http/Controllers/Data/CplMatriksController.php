<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Data\CplMatriksModel;
use App\Models\Master\CplProdiModel;
use App\Models\Master\CplSndiktiModel;
use App\Models\Master\PLModel;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
class CplMatriksController extends Controller
{
    public function __construct(){
        $this->menuCode  = 'DATA.CPL.MATRIKS';
        $this->menuUrl   = url('data/cplmatriks');     // set URL untuk menu ini
        $this->menuTitle = 'CPL-Matriks';                       // set nama menu
        $this->viewPath  = 'data.cplmatriks.';         // untuk menunjukkan direktori view. Diakhiri dengan tanda titik
    }

    public function index(){
        $this->authAction('read');
        $this->authCheckDetailAccess();

        $breadcrumb = [
            'title' => $this->menuTitle,
            'list'  => ['Data', 'Cpl-Matriks']
        ];

        $activeMenu = [
            'l1' => 'data',
            'l2' => 'data-cpl-matriks',
            'l3' => null
        ];

        $page = [
            'url' => $this->menuUrl,
            'title' => 'Daftar '. $this->menuTitle
        ];
        $data = CplMatriksModel::all();
        $cpl_prodi = CplProdiModel::all();
        $cpl_sndikti = CplSndiktiModel::all();
       // CplMatriksModel::setDefaultCplMatriks();
        return view($this->viewPath . 'index')
            ->with('breadcrumb', (object) $breadcrumb) 
            ->with('activeMenu', (object) $activeMenu)
            ->with('page', (object) $page)
            ->with('data',$data)
            ->with('cpl_prodi',$cpl_prodi)
            ->with('cpl_sndikti',$cpl_sndikti)
            ->with('allowAccess', $this->authAccessKey());
    }

    public function list(Request $request){
         $this->authAction('read', 'json');
         if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();
       
         $data  = CplMatriksModel::all();

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
        $request->validate([
            'cpl_kategori' => 'required',
            'cpl_sndikti_id' => 'required|integer',
            'cpl_prodi_id' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        CplMatriksModel::create($request->all());
        return redirect()->route('cplmatriks.index')->with('success', 'CplMatriks berhasil ditambahkan.');

    }

    public function edit($id){
        $this->authAction('update', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $page = [
            'url' => $this->menuUrl . '/'.$id,
            'title' => 'Edit ' . $this->menuTitle
        ];

        $data = CplMatriksModel::find($id);
     

        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'action')
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data);
    }


    public function update(Request $request, $id){
         $this->authAction('update', 'json');
         if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

         if ($request->ajax() || $request->wantsJson()) {

             $rules = [
            'cpl_kategori' => 'required',
            'cpl_sndikti_id' => 'required|integer',
            'cpl_prodi_id' => 'required|integer',
            'is_active' => 'required|boolean',           ];
             $validator = Validator::make($request->all(), $rules);

             if ($validator->fails()) {
                 return response()->json([
                     'stat'     => false,
                     'mc'       => false,
                     'msg'      => 'Terjadi kesalahan.',
                     'msgField' => $validator->errors()
                 ]);
             }

             $res = CplMatriksModel::updateData($id, $request);

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

         $data = CplMatriksModel::find($id);
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

        $data = CplMatriksModel::find($id);

        return (!$data)? $this->showModalError() :
            $this->showModalConfirm($this->menuUrl.'/'.$id, [
                'cpl_kategori' => $data->cpl_kategori,
                'cpl_sndikti_id' => $data->cpl_sndikti_id,
                'cpl_prodi_id' => $data->cpl_prodi_id,  
            ]);
    }

    public function destroy(Request $request, $id){
         $this->authAction('delete', 'json');
         if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

         if ($request->ajax() || $request->wantsJson()) {
           
            $res = CplMatriksModel::deleteData($id);
            
             return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => CplMatriksModel::getDeleteMessage()
             ]);
         }

         return redirect('/');
    }
}
