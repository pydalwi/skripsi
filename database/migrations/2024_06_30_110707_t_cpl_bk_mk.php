<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TCplBkMk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('t_cpl_bk_mk', function (Blueprint $table) {
            $table->id('cpl_bk_mk_id');
            $table->unsignedBigInteger('cpl_prodi_id')->index();
            $table->unsignedBigInteger('mk_id')->index();
            $table->unsignedBigInteger('bk_id')->index();
            $table->boolean('is_active')->default(false);
            $table->tinyInteger('cpl_bk_mk_check')->default(0);
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();
            $table->unsignedBigInteger('prodi_id')->index();
            $table->foreign('prodi_id')->references('prodi_id')->on('m_prodi');
            $table->index(name:'fk_tcpl_bk_mk1_idx',columns:'cpl_prodi_id');
            $table->index(name:'fk_tcpl_bk_mk2_idx',columns:'mk_id');
            $table->index(name:'fk_tcpl_bk_mk3_idx',columns:'bk_id');
            $table->foreign(columns:'cpl_prodi_id',name:'fk_tcpl_bk_mk1')->references('cpl_prodi_id')->on('m_cpl_prodi')
            ->noActionOnDelete()
            ->noActionOnUpdate();
            $table->foreign(columns:'mk_id',name:'fk_tcpl_bk_mk2')->references('mk_id')->on('m_mk')
            ->noActionOnDelete()
            ->noActionOnUpdate();
            $table->foreign(columns:'bk_id',name:'fk_tcpl_bk_mk3')->references('bk_id')->on('m_bahan_kajian')
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
        Schema::dropIfExists('t_cpl_bk_mk');
    }
}
