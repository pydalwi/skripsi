<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Master\JurusanModel;
use App\Models\Setting\PeriodeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PeriodeController extends Controller
{
    public function __construct()
    {
        $this->menuCode  = 'SETTING.PERIODE';                // kode menu, sesuai dengan code di DB
        $this->menuUrl   = url('setting/periode');           // set URL untuk menu ini
        $this->menuTitle = 'Setting - Periode';              // set nama menu
        $this->viewPath  = 'setting.periode.';               // untuk menunjukkan direktori view. Diakhiri dengan tanda titik
    }

    public function index()
    {
        $this->authAction('read');
        $this->authCheckDetailAccess();

        $breadcrumb = [
            'title' => $this->menuTitle,
            'list'  => ['Setting', 'Periode']
        ];

        $activeMenu = [
            'l1' => 'setting',           
            'l2' => 'setting-periode',   
            'l3' => null                 
        ];

        $page = [
            'url' => $this->menuUrl,
            'title' => $this->menuTitle
        ];

        $this->setPeriodeSession();

        $periodes = PeriodeModel::select('periode_id', 'periode_name', 'periode_semester', 'is_active')->get();

        return view($this->viewPath . 'index2')
            ->with('breadcrumb', (object) $breadcrumb)
            ->with('activeMenu', (object) $activeMenu)
            ->with('page', (object) $page)
            ->with('periodes', $periodes)
            ->with('allowAccess', $this->authAccessKey());
    }

    public function list(Request $request){
        $this->authAction('read', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $data  = PeriodeModel::selectRaw("periode_id, periode_name, periode_semester, is_active");

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
            ->with('page', (object) $page)
            ;
    }

    public function edit($id){
        $this->authAction('update', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $page = [
            'url' => $this->menuUrl . '/'.$id,
            'title' => 'Edit ' . $this->menuTitle
        ];

        $data = PeriodeModel::find($id);

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
                'periode_name' => 'required|string|max:100',
                'periode_semester' => 'required|string|max:100',
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

            $res = PeriodeModel::updateData($id, $request);

            return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => ($res)? $this->getMessage('update.success') : $this->getMessage('update.failed')
            ]);
        }

        return redirect('/');
    }

    


    public function store(Request $request){
        $this->authAction('create', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {

            $rules = [
                'periode_name' => 'required|string',
                'periode_semester' => 'required|string',
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

            $res = PeriodeModel::insertData($request);

            return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => ($res)? $this->getMessage('insert.success') : $this->getMessage('insert.failed')
            ]);

        }

        return redirect('/');
    }

    public function edits($id)
    {
        $page = [
            'url' => route('edits', ['id' => $id]),
            'title' => 'Edit Kurikulum MK'
        ];
    
        $data = PeriodeModel::findKurikulumMKByPeriode($id);
        $periodes = PeriodeModel::all();
        $selectedMataKuliah = PeriodeModel::getSelectedMataKuliah($id);
        $allMataKuliah = PeriodeModel::getAllMataKuliah();
        $kurikulums = DB::table('d_kurikulum')
        ->join('m_prodi', 'd_kurikulum.prodi_id', '=', 'm_prodi.prodi_id')
        ->select('d_kurikulum.kurikulum_id', 'd_kurikulum.kurikulum_tahun', 'm_prodi.nama_prodi')
        ->get();
    
        $mataKuliahByKurikulum = [];
        foreach ($kurikulums as $kurikulum) {
            $mataKuliahByKurikulum[$kurikulum->kurikulum_id] = PeriodeModel::filterMataKuliahByKurikulum($kurikulum->kurikulum_id);
        }
    
        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'acperiodemk')
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data)
                ->with('periodes', $periodes)
                ->with('selectedMataKuliah', $selectedMataKuliah)
                ->with('allMataKuliah', $allMataKuliah)
                ->with('kurikulums', $kurikulums)
                ->with('mataKuliahByKurikulum', $mataKuliahByKurikulum);
    }

    public function updates(Request $request, $id)
    {
        // Check authorization and detail access here
        $this->authAction('update', 'json');
        if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {

            $rules = [
                'kurikulum_mk_ids' => 'required|array',
                'new_periode_id' => 'required|integer|exists:m_periode,periode_id',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'stat' => false,
                    'mc' => false,
                    'msg' => 'Terjadi kesalahan.',
                    'msgField' => $validator->errors()
                ]);
            }

            $res = PeriodeModel::updateKurikulumMKPeriode($request->kurikulum_mk_ids, $request->new_periode_id);

            return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => ($res) ? $this->getMessage('update.success') : $this->getMessage('update.failed')
            ]);
        }

        return redirect('/');
    }

    public function updateperiode(Request $request)
    {
        $this->authAction('update', 'json');
        if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {
            // Log the request data
            Log::info('Update Request Data: ', $request->all());

            $rules = [
                'periode_id' => 'required|integer|exists:m_periode,periode_id',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                // Log the validation errors
                Log::error('Validation Errors: ', $validator->errors()->toArray());

                return response()->json([
                    'stat'     => false,
                    'mc'       => false,
                    'msg'      => 'Terjadi kesalahan.',
                    'msgField' => $validator->errors()
                ]);
            }

            // Reset is_active to 0 for all periods
            PeriodeModel::where('is_active', 1)->update(['is_active' => 0]);

            // Log after resetting all periods
            Log::info('All periods reset to is_active = 0');

            // Set is_active to 1 for the selected period
            $periode = PeriodeModel::find($request->periode_id);
            if ($periode) {
                $periode->is_active = 1;
                $periode->save();

                // Log after updating the selected period
                Log::info('Updated Periode: ', $periode->toArray());

                return response()->json([
                    'stat' => true,
                    'mc' => true,
                    'msg' => 'Periode berhasil diubah.'
                ]);
            } else {
                // Log if periode is not found
                Log::error('Periode not found with ID: ' . $request->periode_id);

                return response()->json([
                    'stat' => false,
                    'mc' => false,
                    'msg' => 'Periode tidak ditemukan.'
                ]);
            }
        }

        return redirect('/');
    }

    public function confirm($id){
        $this->authAction('delete', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $data = PeriodeModel::find($id);

        return (!$data)? $this->showModalError() :
            $this->showModalConfirm($this->menuUrl.'/'.$id, [
                'Tahun Periode' => $data->periode_name,
                'Periode' => $data->periode_semester,
            ]);
    }

    public function destroy(Request $request, $id){
        $this->authAction('delete', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {

            $res = PeriodeModel::deleteData($id);

            return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => PeriodeModel::getDeleteMessage()
            ]);
        }

        return redirect('/');
    }
}