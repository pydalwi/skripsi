<?php

namespace App\Http\Controllers\Transactional;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transactional\MkBkModel;
use App\Models\Master\MatkulModel;
use App\Models\Master\BahanKajianModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
class MkBkController extends Controller
{
    public function __construct(){
        $this->menuCode  = 'TRANSACTION.MKBK';
        $this->menuUrl   = url('transaction/mkbk');     // set URL untuk menu ini
        $this->menuTitle = 'MK-BK';                       // set nama menu
        $this->viewPath  = 'Transactional.MkBk.';         // untuk menunjukkan direktori view. Diakhiri dengan tanda titik
    }

    public function index(){
        $this->authAction('read');
        $this->authCheckDetailAccess();

        $breadcrumb = [
            'title' => $this->menuTitle,
            'list'  => ['Data Transaction', 'MK-BK']
        ];

        $activeMenu = [
            'l1' => 'transaction',
            'l2' => 'transaction-mk-bk',
            'l3' => null
        ];

        $page = [
            'url' => $this->menuUrl,
            'title' => 'Daftar '. $this->menuTitle
        ];

        $data = MkBkModel::selectRaw('is_active, bk_id, mk_id')->where('bk_id', 1)->get();
        $bahankajian = BahanKajianModel::where('bk_id', 1)->get();
        $matkul = MatkulModel::all();

        //trik kelola matrik
        $mkbk = [];
        foreach($data as $d){
            $mkbk[$d->mk_id][$d->bk_id] = $d->is_active;
        }

       // CplMatriksModel::setDefaultCplMatriks();
        return view($this->viewPath . 'index')
            ->with('breadcrumb', (object) $breadcrumb) 
            ->with('activeMenu', (object) $activeMenu)
            ->with('page', (object) $page)
            ->with('mkbk',$mkbk)
            ->with('bahankajian',$bahankajian)
            ->with('matkul',$matkul)
            ->with('allowAccess', $this->authAccessKey());
    }

    public function list(Request $request){
        $this->authAction('read', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $data  = MkBkModel::all();

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
        
        $mkbk = $request->input('mkbk');       
        
        MkBkModel::updateMkBk(1, $mkbk);
        return redirect()->route('mkbk.index')->with('success', 'MkBk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authAction('read', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $data = MkBkModel::find($id);
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
        $this->authAction('update', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $page = [
            'url' => $this->menuUrl . '/'.$id,
            'title' => 'Edit ' . $this->menuTitle
        ];

        $data = MkBkModel::find($id);
     

        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'action')
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data);
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
           
           'mk_id' => 'required|integer',
           'bk_id' => 'required|integer',
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authAction('delete', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {
          
           $res = MkBkModel::deleteData($id);
           
            return response()->json([
               'stat' => $res,
               'mc' => $res, // close modal
               'msg' => MkBkModel::getDeleteMessage()
            ]);
        }

        return redirect('/');
   }    
}
