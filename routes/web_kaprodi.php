<?php



use App\Http\Controllers\Data\KurikulumController;
use App\Http\Controllers\Data\KaprodiController;
use App\Http\Controllers\Data\CpmkController;
use App\Http\Controllers\Data\CpmkDetailController;
use App\Http\Controllers\Data\CplPlController;
use App\Http\Controllers\Data\CplMatriksController;
use App\Http\Controllers\Data\CplMkController;
use App\Http\Controllers\Data\StrukturmkController;
use App\Http\Controllers\Master\BahanKajianController;
use App\Http\Controllers\Master\CplSnDiktiController;
use App\Http\Controllers\Master\CplProdiController;
use App\Http\Controllers\Master\MatkulController;
use App\Http\Controllers\Master\RumpunMkController;
use App\Http\Controllers\Master\ProdiController;
use App\Http\Controllers\Master\PLController;
use App\Http\Controllers\Transactional\MkBkController;
use App\Http\Controllers\Transactional\CplCpmkController;
use App\Http\Controllers\Transactional\CplBkMkController;
use App\Http\Controllers\Transactional\CplBkController;
use App\Http\Controllers\Transactional\TahapMekanismePenilaianController;
use App\Http\Controllers\Transactional\BobotpenilaiancplmkcpmkController;
use App\Http\Controllers\Transactional\BobotpenilaianmkcplcpmkController;
use App\Http\Controllers\Transactional\RumusanakhirmkController;
use App\Http\Controllers\Transactional\RumusanakhircplController;
use App\Http\Controllers\Setting\AccountController;
use Illuminate\Support\Facades\Route;

// Data Master
Route::group(['prefix' => 'master', 'middleware' => ['auth']], function() {

    // Mata Kuliah
   Route::resource('matkul', MatkulController::class)->parameter('matkul', 'id');
//   Route::post('matkul/list', [MatkulController::class, 'list']);
//   Route::get('matkul/{id}/delete', [MatkulController::class, 'confirm']);
//
//   // Cpl Sndikti
   Route::resource('cplsndikti', CplSndiktiController::class)->parameter('cplsndikti', 'id');
//   Route::post('cplsndikti/list', [CplSndiktiController::class, 'list']);
//   Route::get('cplsndikti/{id}/delete', [CplSndiktiController::class, 'confirm']);
//
//    // Cpl Prodi
    Route::resource('cplprodi', CplProdiController::class)->parameter('cplprodi', 'id');
//    Route::post('cplprodi/list', [CplProdiController::class, 'list']);
//    Route::get('cplprodi/{id}/delete', [CplProdiController::class, 'confirm']);
//
//   // Prodi
   Route::resource('prodi', ProdiController::class)->parameter('prodi', 'id');
//   Route::post('prodi/list', [ProdiController::class, 'list']);
//   Route::get('prodi/{id}/delete', [ProdiController::class, 'confirm']);
//    
   // Bahan Kajian
    Route::resource('bahan_kajian', BahanKajianController::class)->parameter('bahan_kajian', 'id');
//    Route::post('bahan_kajian/list', [BahanKajianController::class, 'list']);
//    Route::get('bahan_kajian/{id}/delete', [BahanKajianController::class, 'confirm']);
//
   // Profil Lulusan
   Route::resource('profil_lulusan', PLController::class)->parameter('profil_lulusan', 'id');
//   Route::post('profil_lulusan/list', [PLController::class, 'list']);
//   Route::get('profil_lulusan/{id}/delete', [PLController::class, 'confirm']);
//
   // Rumpun Mata Kuliah
   Route::resource('rumpunmk', RumpunMkController::class)->parameter('rumpun_mk', 'id');
//   Route::post('rumpunmk/list', [RumpunMkController::class, 'list']);
//   Route::get('rumpunmk/{id}/delete', [RumpunMkController::class, 'confirm']);
//
   });
//


//Data
route::group(['prefix' => 'data', 'middleware' => ['auth']], function() {

   // Kurikulum 
   Route::resource('kurikulum', KurikulumController::class)->parameter('kurikulum', 'id');
//   Route::post('kurikulum/list', [KurikulumController::class, 'list']);
//   Route::get('kurikulum/{id}/delete', [KurikulumController::class, 'confirm']);

   // Kurikulum Matakuliah
   // Route::resource('kurikulum_mk', KurikulumMkController::class)->parameter('kurikulumMk', 'id');
   // Route::post('kurikulum_mk/list', [KurikulumMkController::class, 'list']);
   // Route::get('kurikulum_mk/{id}/delete', [KurikulumMkController::class, 'confirm']);

//   // CPMK
   Route::resource('cpmk', CpmkController::class)->parameter('cpmk', 'id');
//  Route::post('cpmk/list', [CpmkController::class, 'list']);
//   Route::get('cpmk/{id}/delete', [CpmkController::class, 'confirm']);

//    // CPMK DETAIL
   Route::resource('cpmkdetail', CpmkDetailController::class)->parameter('cpmkdetail', 'id');
//   Route::post('cpmkdetail/list', [CpmkDetailController::class, 'list']);
//   Route::get('cpmkdetail/{id}/delete', [CpmkDetailController::class, 'confirm']);

//   // KAPRODI
   Route::resource('kaprodi', KaprodiController::class)->parameter('kaprodi', 'id');
//   Route::post('kaprodi/list', [KaprodiController::class, 'list']);
//   Route::get('kaprodi/{id}/delete', [KaprodiController::class, 'confirm']);
   
//   // CPL PL 
   Route::resource('cplpl', CplPlController::class)->parameter('cplpl', 'id');
//   Route::post('cplpl/list', [CplPlController::class, 'list']);
//   Route::get('cplpl/{id}/delete', [CplPlController::class, 'confirm']);
//
   // CPL MATRIKS
   Route::resource('cplmatriks', CplMatriksController::class)->parameter('cplmatriks', 'id');
//   // Route::post('cplmatriks/list', [CplMatriksController::class, 'list']);
//   // Route::get('cplmatriks/{id}/delete', [CplMatriksController::class, 'create']);

   //  CPL MK
   Route::resource('cplmk', CplMkController::class)->parameter('cplmk','id');
       
   // Struktur MK CPL
   Route::resource('strukturmkcpl', StrukturmkController::class)->parameter('strukturmkcpl','id');
});

//Settings
Route::group(['prefix' => 'setting', 'middleware' => ['auth']], function() {

    // Group
  //  Route::resource('group', GroupController::class)->parameter('group', 'id');
  //  Route::post('group/list', [GroupController::class, 'list']);
  //  Route::get('group/{id}/delete', [GroupController::class, 'confirm']);
  //  Route::put('group/{id}/menu', [GroupController::class, 'menu_save']);

    // User
  //  Route::resource('user', UserController::class)->parameter('user', 'id');
  //  Route::post('user/list', [UserController::class, 'list']);
  //  Route::get('user/{id}/delete', [UserController::class, 'confirm']);

     // Menu
  //   Route::resource('menu', MenuController::class)->parameter('menu', 'id');
  //   Route::post('menu/list', [MenuController::class, 'list']);
  //   Route::get('menu/{id}/delete', [MenuController::class, 'confirm']);
});

//transaksi
    Route::group(['prefix' => 'transaction', 'middleware' => ['auth']], function() {
   
    // MKBK
    Route::resource('mkbk', MkBkController::class)->parameter('t_mk_bk', 'id');
    //Route::post('mkbk/list', [MkBkController::class, 'list']);
    //Route::get('mkbk/{id}/delete', [MkBkController::class, 'confirm']);
        
    // CPL BK
    Route::resource('cplbk', CplBkController::class)->parameter('CplBk', 'id');
    //Route::post('bplbk/list', [CplBkController::class, 'list']);
   // Route::get('cplbk/{id}/delete', [CplBkController::class, 'confirm']);
    
    // CPL CPMK
     Route::resource('cplcpmk', CplCpmkController::class)->parameter('CplCpmk', 'id');
     //Route::post('cplcpmk/list', [CplCpmkController::class, 'list']);
     //Route::get('cplcpmk/{id}/delete', [CplCpmkController::class, 'confirm']);


    // CPL BK MK
    Route::resource('cplbkmk', CplBkMKController::class)->parameter('CplBkMk', 'id');
    //Route::post('cplbkmk/list', [CplBkMKController::class, 'list']);
    //Route::get('cplbkmk/{id}/delete', [CplBkMKController::class, 'confirm']);
    
});