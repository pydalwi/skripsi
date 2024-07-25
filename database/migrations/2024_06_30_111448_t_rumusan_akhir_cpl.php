<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TRumusanAkhirCpl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_rumusan_akhir_cpl', function (Blueprint $table) {
            $table->id('rumusan_akhir_cpl_id');
            $table->integer('skor maks');
            $table->integer('total');
            $table->unsignedBigInteger('cpl_prodi_id')->nullable()->index();
            $table->unsignedBigInteger('mk_id')->nullable()->index();
            $table->unsignedBigInteger('cpmk_id')->nullable()->index();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();
            $table->index(name:'fk_ttahap_mekanisme_penilaian1_idx',columns:'cpl_prodi_id');
            $table->index(name:'fk_ttahap_mekanisme_penilaian2_idx',columns:'mk_id');
            $table->index(name:'fk_ttahap_mekanisme_penilaian3_idx',columns:'cpmk_id');
            $table->foreign(columns:'cpl_prodi_id',name:'fk_rumusan_akhir_cpl1')->references('cpl_prodi_id')->on('m_cpl_prodi')
            ->noActionOnDelete()
            ->noActionOnUpdate();
            $table->foreign(columns:'mk_id',name:'fk_rumusan_akhir_cpl2')->references('mk_id')->on('m_mk')
            ->noActionOnDelete()
            ->noActionOnUpdate();
            $table->foreign(columns:'cpmk_id',name:'fk_rumusan_akhir_cpl3')->references('cpmk_id')->on('d_cpmk')
            ->noActionOnDelete()
            ->noActionOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_rumusan_akhir_cpl');
    }
}
