<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\CplProdiModel;
use App\Models\Master\MatkulModel;
use App\Models\Data\CplMkModel;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
class CplMkController extends Controller
{
    public function __construct(){
        $this->menuCode  = 'DATA.CPLMK';
        $this->menuUrl   = url('data/cplmk');     // set URL untuk menu ini
        $this->menuTitle = 'CPL-MK';                       // set nama menu
        $this->viewPath  = 'data.cplmk.';         // untuk menunjukkan direktori view. Diakhiri dengan tanda titik
    }

    public function index(){
        $this->authAction('read');
        $this->authCheckDetailAccess();

        $breadcrumb = [
            'title' => $this->menuTitle,
            'list'  => ['Data', 'CPL-MK']
        ];

        $activeMenu = [
            'l1' => 'data',
            'l2' => 'data-cpl-mk',
            'l3' => null
        ];

        $page = [
            'url' => $this->menuUrl,
            'title' => 'Daftar '. $this->menuTitle
        ];
        $data = CplMkModel::selectRaw('is_active, cpl_prodi_id, mk_id')->get();
        $cpl_prodi = CplProdiModel::where('prodi_id', 1)->get();
        $matkul = MatkulModel::all();

        //trik kelola matrik
        $cplmk = [];
        foreach($data as $d){
            $cplmk[$d->mk_id][$d->cpl_prodi_id] = $d->is_active;
        }

       // CplMatriksModel::setDefaultCplMatriks();
        return view($this->viewPath . 'index')
            ->with('breadcrumb', (object) $breadcrumb) 
            ->with('activeMenu', (object) $activeMenu)
            ->with('page', (object) $page)
            ->with('cplmk',$cplmk)
            ->with('cpl_prodi',$cpl_prodi)
            ->with('matkul',$matkul)
            ->with('allowAccess', $this->authAccessKey());
    }

    public function list(Request $request){
         $this->authAction('read', 'json');
         if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();
       
         $data  = CplMkModel::all();

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
        
        $cplmk = $request->input('cplmk');       
        
        CplMkModel::updateCplMk(1, $cplmk);
        return redirect()->route('cplmk.index')->with('success', 'CPLMK berhasil diubah.');

    }

    public function edit($id){
        $this->authAction('update', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $page = [
            'url' => $this->menuUrl . '/'.$id,
            'title' => 'Edit ' . $this->menuTitle
        ];

        $data = CplMkModel::find($id);
     

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
            'mk_id' => 'required|integer',
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

             $res = CplMkModel::updateData($id, $request);

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

         $data = CplMkModel::find($id);
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

        $data = CplMkModel::find($id);

        return (!$data)? $this->showModalError() :
            $this->showModalConfirm($this->menuUrl.'/'.$id, [
                'mk_id' => $data->mk_id,
                'cpl_prodi_id' => $data->cpl_prodi_id,  
            ]);
    }

    public function destroy(Request $request, $id){
         $this->authAction('delete', 'json');
         if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

         if ($request->ajax() || $request->wantsJson()) {
           
            $res = CplMkModel::deleteData($id);
            
             return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => CplMkModel::getDeleteMessage()
             ]);
         }

         return redirect('/');
    }
}
