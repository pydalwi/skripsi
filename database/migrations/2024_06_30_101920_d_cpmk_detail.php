<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DCpmkDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('d_cpmk_detail', function (Blueprint $table) {
            $table->id('cpmk_detail_id');
            $table->string('sub_cpmk_kode')->nullable();
            $table->text('uraian_sub_cpmk')->nullable();
            $table->string('indikator_sub_cpmk')->nullable();
            $table->unsignedBigInteger('cpmk_id')->index();
            $table->unsignedBigInteger('cpl_prodi_id')->index();
            $table->unsignedBigInteger('mk_id')->index();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();
            $table->unsignedBigInteger('prodi_id')->index();
            $table->foreign('prodi_id')->references('prodi_id')->on('m_prodi');

            $table->index(
                name:'fk_cpmk_detail1_idx',
                columns:'cpmk_id'
            );
            $table->index(
                name:'fk_cpmk_detail2_idx',
                columns:'cpl_prodi_id'
            );
            $table->index(
                name:'fk_cpmk_detail3_idx',
                columns:'mk_id'
            );
            $table->foreign(columns:'cpmk_id',name:'fk_cpmk_detail1')
            ->references('cpmk_id')->on('d_cpmk')
            ->noActionOnDelete()
            ->noActionOnUpdate();
            $table->foreign(columns:'cpl_prodi_id',name:'fk_cpmk_detail2')
            ->references('cpl_prodi_id')->on('m_cpl_prodi')
            ->noActionOnDelete()
            ->noActionOnUpdate();
            $table->foreign(columns:'mk_id',name:'fk_cpmk_detail3')
            ->references('mk_id')->on('m_mk')
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
        Schema::dropIfExists('d_cpmk_detail');
    }
}
