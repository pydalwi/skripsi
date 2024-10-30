<?php

namespace App\Http\Controllers\Transactional;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transactional\CplBkModel;
use App\Models\Master\CplProdiModel;
use App\Models\Master\BahanKajianModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
class CplBkController extends Controller
{
    public function __construct(){
        $this->menuCode  = 'TRANSACTION.CPLBK';
        $this->menuUrl   = url('transaction/cplbk');     // set URL untuk menu ini
        $this->menuTitle = 'CPL-BK';                       // set nama menu
        $this->viewPath  = 'Transactional.CplBk.';         // untuk menunjukkan direktori view. Diakhiri dengan tanda titik
    }

    public function index(){
        $this->authAction('read');
        $this->authCheckDetailAccess();

        $breadcrumb = [
            'title' => $this->menuTitle,
            'list'  => ['Data Transaction', 'CPL-BK']
        ];

        $activeMenu = [
            'l1' => 'transaction',
            'l2' => 'transaction-cpl-bk',
            'l3' => null
        ];

        $page = [
            'url' => $this->menuUrl,
            'title' => 'Daftar '. $this->menuTitle
        ];

        $data = CplBkModel::selectRaw('is_active, cpl_prodi_id, bk_id')->get();
        $cpl_prodi = CplProdiModel::where('prodi_id', 1)->get();
        $bahan_kajian = BahanKajianModel::all();

        $cplbk = [];
        foreach($data as $d){
            $cplbk[$d->bk_id][$d->cpl_prodi_id] = $d->is_active;
        }
        return view($this->viewPath . 'index')
            ->with('breadcrumb', (object) $breadcrumb)
            ->with('activeMenu', (object) $activeMenu)
            ->with('page', (object) $page)
            ->with('cplbk',$cplbk)
            ->with('cpl_prodi',$cpl_prodi)
            ->with('bahan_kajian',$bahan_kajian)
            ->with('allowAccess', $this->authAccessKey());
    }

    public function list(Request $request){
        $this->authAction('read', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $data  = CplBkModel::all();

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cplbk = $request->input('cplbk');       
        
        CplBkModel::updateCplBk(1, $cplbk);
        return redirect()->route('cplbk.index')->with('success', 'CPLBK berhasil diubah.');
   
    }

    public function confirm($id){
        $this->authAction('delete', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $data = CplBkModel::find($id);

        return (!$data)? $this->showModalError() :
            $this->showModalConfirm($this->menuUrl.'/'.$id, [
                'bk_id' => $data->bk_id,
                'cpl_prodi_id' => $data->cpl_prodi_id,  
            ]);
    }


    public function show($id)
    {
        $this->authAction('read', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $data = CplBkModel::find($id);
        $page = [
            'title' => 'Detail ' . $this->menuTitle
        ];

        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'detail')
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
  //      $data = TahapMekanismePenilaian::find($id);
  //      return view('tahap_mekanisme_penilaian.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authAction('update', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {

            $rules = [
           'bk_id' => 'required|integer',
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

            $res = CplBkModel::updateData($id, $request);

            return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => ($res)? $this->getMessage('update.success') : $this->getMessage('update.failed')
            ]);
        }

        return redirect('/');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id){
    $this->authAction('delete', 'json');
    if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

    if ($request->ajax() || $request->wantsJson()) {
      
       $res = CplBkModel::deleteData($id);
       
        return response()->json([
           'stat' => $res,
           'mc' => $res, // close modal
           'msg' => CplBkModel::getDeleteMessage()
        ]);
    }

    return redirect('/');
}
}
