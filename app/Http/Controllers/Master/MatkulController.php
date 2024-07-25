<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Data\KurikulumModel;
use App\Models\Master\MatkulModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
class MatkulController extends Controller
{
    public function __construct(){
        $this->menuCode  = 'MASTER.MATKUL';
        $this->menuUrl   = url('master/matkul');     // set URL untuk menu ini
        $this->menuTitle = 'Mata Kuliah';                       // set nama menu
        $this->viewPath  = 'master.matkul.';         // untuk menunjukkan direktori view. Diakhiri dengan tanda titik
    }

    public function index(){
        $this->authAction('read');
        $this->authCheckDetailAccess();

        $breadcrumb = [
            'title' => $this->menuTitle,
            'list'  => ['Data Master', 'Mata Kuliah']
        ];

        $activeMenu = [
            'l1' => 'master',
            'l2' => 'master-matkul',
            'l3' => null
        ];

        $page = [
            'url' => $this->menuUrl,
            'title' => 'Daftar '. $this->menuTitle
        ];
        $data =MatkulModel::all();
        return view($this->viewPath . 'index')
            ->with('breadcrumb', (object) $breadcrumb)
            ->with('activeMenu', (object) $activeMenu)
            ->with('page', (object) $page)
            ->with('data',$data)
            ->with('allowAccess', $this->authAccessKey());
    }

    public function list(Request $request){
         $this->authAction('read', 'json');
         if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

         $data  = MatkulModel::all();

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

        $rules =[
            'mk_nama' => 'required',
            'mk_kode' => 'required',
            'sks'   =>  'required',
            'semester' => 'required',
            'mk_jenis' => 'required',
            'mk_kategori' => 'required'
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

            $res = MatkulModel::insertData($request);

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

        $data = MatkulModel::find($id);


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
                 'mk_kode' => 'required',
                 'mk_nama' => 'required',
                 'sks'   =>  'required',
                 'semester' => 'required',
                 'mk_jenis' => 'required',
                 'mk_kategori' => 'required'
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

             $res = MatkulModel::updateData($id, $request);

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

         $data = MatkulModel::find($id);
         $page = [
             'title' => 'Detail ' . $this->menuTitle
         ];

         return (!$data)? $this->showModalError() :
             view($this->viewPath . 'detail')
                 ->with('page', (object) $page)
                 ->with('id', $id)
                 ->with('data', $data);
    }


    public function confirm(string $id){
        $this->authAction('delete', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $data = MatkulModel::find($id);

        return (!$data)? $this->showModalError() :
            $this->showModalConfirm($this->menuUrl.'/'.$id, [
                'mk_kode' => $data->mk_kode,
                'mk_nama' => $data->mk_nama,
                'sks'          => $data->sks,
                'semester' => $data->semester,
                'mk_jenis' =>  $data->mk_jenis,
            ]);
    }

    public function destroy(Request $request, string $id){
         $this->authAction('delete', 'json');
         if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

         if ($request->ajax() || $request->wantsJson()) {

            $res = MatkulModel::deleteData($id);
            
            return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => MatkulModel::getDeleteMessage()
             ]);
         }

         return redirect('/');
    }
}
