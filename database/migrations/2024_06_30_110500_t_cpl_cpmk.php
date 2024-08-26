<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TCplCpmk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('t_cpl_cpmk', function (Blueprint $table) {
            $table->id('cpl_cpmk_id');
            $table->unsignedBigInteger('cpl_prodi_id')->nullable()->index();
            $table->unsignedBigInteger('cpmk_id')->nullable()->index();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();
            $table->unsignedBigInteger('prodi_id')->index();
            $table->unsignedBigInteger('mk_id')->index();
            $table->foreign('prodi_id')->references('prodi_id')->on('m_prodi');
            $table->foreign('mk_id')->references('mk_id')->on('m_mk');
            $table->index(name:'fk_tcpl_cpmk1_idx',columns:'cpl_prodi_id');
            $table->index(name:'fk_tcpl_cpmk2_idx',columns:'cpmk_id');
            $table->foreign(columns:'cpl_prodi_id',name:'fk_tcpl_cpmk1')->references('cpl_prodi_id')->on('m_cpl_prodi')
            ->noActionOnDelete()
            ->noActionOnUpdate();
            $table->foreign(columns:'cpmk_id',name:'fk_tcpl_cpmk2')->references('cpmk_id')->on('d_cpmk')
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
        //
        Schema::dropIfExists('t_cpl_cpmk');
    }
}
