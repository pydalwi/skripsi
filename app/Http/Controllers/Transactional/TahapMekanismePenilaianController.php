<?php

namespace App\Http\Controllers\Transactional;

use App\Http\Controllers\Controller;
use App\Models\Transactional\TahapmekanismeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
class TahapMekanismePenilaianController extends Controller
{
    public function __construct(){
        $this->menuCode  = 'TRANSACTION.TAHAPMEKANISMEPENILAIAN';
        $this->menuUrl   = url('transaction/mekanispenilaian');     // set URL untuk menu ini
        $this->menuTitle = 'Tahap & Mekanisme Penilaian';                       // set nama menu
        $this->viewPath  = 'Transactional.Tahapmekanismepenilaian.';         // untuk menunjukkan direktori view. Diakhiri dengan tanda titik
    }

    public function index(){
        $this->authAction('read');
        $this->authCheckDetailAccess();

        $breadcrumb = [
            'title' => $this->menuTitle,
            'list'  => ['Transaction', 'Tahap & Mekanisme Penilaian']
        ];

        $activeMenu = [
            'l1' => 'transaction',
            'l2' => 'transaction-mekanisme',
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

        $data  = TahapmekanismeModel::all();

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
        $request->validate([
            'cpl' => 'required',
            'mk' => 'required',
            'cpmk' => 'required',
            'tahap_penilaian' => 'required',
            'teknik_penilaian' => 'required',
            'instrumen' => 'required',
            'kriteria' => 'required',
            'bobot' => 'required|integer|min:0|max:100'
        ]);

        $total_bobot = TahapmekanismeModel::sum('bobot') + $request->bobot;

        if ($total_bobot > 100) {
            return back()->withErrors(['bobot' => 'Total bobot tidak boleh lebih dari 100%']);
        }

        TahapmekanismeModel::create($request->all());
        return redirect()->route('tahap_mekanisme_penilaian.index')->with('success', 'Data berhasil ditambahkan.');
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = TahapmekanismeModel::find($id);
        return view('tahap_mekanisme_penilaian.edit', compact('data'));
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
        $request->validate([
            'cpl' => 'required',
            'mk' => 'required',
            'cpmk' => 'required',
            'tahap_penilaian' => 'required',
            'teknik_penilaian' => 'required',
            'instrumen' => 'required',
            'kriteria' => 'required',
            'bobot' => 'required|integer|min:0|max:100'
        ]);

        $data = TahapmekanismeModel::find($id);
        $total_bobot = TahapmekanismeModel::where('id', '!=', $id)->sum('bobot') + $request->bobot;

        if ($total_bobot > 100) {
            return back()->withErrors(['bobot' => 'Total bobot tidak boleh lebih dari 100%']);
        }

        $data->update($request->all());
        return redirect()->route('tahap_mekanisme_penilaian.index')->with('success', 'Data berhasil diperbarui.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TahapmekanismeModel::destroy($id);
        return redirect()->route('tahap_mekanisme_penilaian.index')->with('success', 'Data berhasil dihapus.');
    }
}
