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

        $data = CplPlModel::all();
        $cpl_prodi = CplProdiModel::all();
        $profil_lulusan = PLModel::join('m_prodi','m_profil_lulusan.prodi_id','=','m_prodi.prodi_id')->get();
        return view($this->viewPath . 'index')
            ->with('breadcrumb', (object) $breadcrumb)
            ->with('activeMenu', (object) $activeMenu)
            ->with('page', (object) $page)
            ->with('data',$data)
            ->with('cpl_prodi',$cpl_prodi)
            ->with('pl',$profil_lulusan)
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
        $request->validate([
            'd_cpl_pl_id' => 'required',
            'cpl_prodi_id' => 'required|integer',
            'pl_id' => 'required|integer',
            'd_cpl_pl_check' => 'required',
        ]);

        CplPlModel::create($request->all());
        return redirect()->route('cplpl.index')->with('success', 'CPL Profil Lulusan berhasil ditambahkan.');

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
                 'mk_kode' => ['required', 'string', 'unique:m_mk','max:10', CplPlModel::setUniqueInsertIgnore($id)],
                 'mk_nama' => 'required|string|max:100',
                 'mk_sks' => 'required|integer',
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

        $data = CplPlModel::find($id);

        return (!$data)? $this->showModalError() :
            $this->showModalConfirm($this->menuUrl.'/'.$id, [
                'Kode Matkul' => $data->kode_mk,
                'Nama Matkul' => $data->nama_mk,
                'Jenis Matkul' =>  $data->jenis_mk,
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
