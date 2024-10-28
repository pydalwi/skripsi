<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Data\CplPlModel;
use App\Models\Master\CplProdiModel;
use App\Models\Master\PLModel;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
class CplPlController extends Controller
{
    public function __construct(){
        $this->menuCode  = 'DATA.CPL.PL';
        $this->menuUrl   = url('data/cplpl');     // set URL untuk menu ini
        $this->menuTitle = 'CPL-PL';                       // set nama menu
        $this->viewPath  = 'data.cplpl.';         // untuk menunjukkan direktori view. Diakhiri dengan tanda titik
    }

    public function index(){
        $this->authAction('read');
        $this->authCheckDetailAccess();

        $breadcrumb = [
            'title' => $this->menuTitle,
            'list'  => ['Data', 'CPL-PL']
        ];

        $activeMenu = [
            'l1' => 'data',
            'l2' => 'data-cpl-pl',
            'l3' => null
        ];

        $page = [
            'url' => $this->menuUrl,
            'title' => 'Daftar '. $this->menuTitle
        ];

        $data = CplPlModel::selectRaw('is_active, cpl_prodi_id, pl_id')->where('prodi_id', 1)->get();
        $cpl_prodi = CplProdiModel::where('prodi_id', 1)->get();
        $profil_lulusan = PLModel::all();

        //trik kelola matrik
        $cplpl = [];
        foreach($data as $d){
            $cplpl[$d->cpl_prodi_id][$d->pl_id] = $d->is_active;
        }

       // CplPlModel::setDefaultCplPl();
        return view($this->viewPath . 'index')
            ->with('breadcrumb', (object) $breadcrumb)
            ->with('activeMenu', (object) $activeMenu)
            ->with('page', (object) $page)
            ->with('cplpl',$cplpl)
            ->with('cpl_prodi',$cpl_prodi)
            ->with('profil_lulusan',$profil_lulusan)
            ->with('allowAccess', $this->authAccessKey());
    }

    public function list(Request $request){
         $this->authAction('read', 'json');
         if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

         $data  = CplPlModel::all();

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

        $cplpl = $request->input('cplpl');       
        
        CplPlModel::updateCplPl(1, $cplpl);
        return redirect()->route('cplpl.index')->with('success', 'Cpl Profil Lulusan berhasil ditambahkan.');

    }

    public function edit($id){
        $this->authAction('update', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $page = [
            'url' => $this->menuUrl . '/'.$id,
            'title' => 'Edit ' . $this->menuTitle
        ];

        $data = CplPlModel::find($id);
     

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
                'cpl_prodi_id' => 'required|integer',
                'pl_id' => 'required|integer',
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
             $res =CplPlModel::updateData($id, $request);

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

         $data = CplPlModel::find($id);
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

        $data = CplPlModel::find($id);

        return (!$data)? $this->showModalError() :
            $this->showModalConfirm($this->menuUrl.'/'.$id, [
                'cpl_prodi_id' => $data->cpl_prodi_id,  
                'pl_id' => $data->pl_id
            ]);
    }

    public function destroy(Request $request, $id){
         $this->authAction('delete', 'json');
         if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

         if ($request->ajax() || $request->wantsJson()) {
            
            $res = CplPlModel::deleteData($id);
            
            return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => CplPlModel::getDeleteMessage()
             ]);
         }

         return redirect('/');
    }
}
