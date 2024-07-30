<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DStrukturmk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_strukturmk', function (Blueprint $table) {
            $table->id('struktur_mk_id');
            $table->smallInteger('sks');
            $table->smallInteger('semester');
            $table->smallInteger('jumlah_mk');
            $table->string('Mk_wajib');
            $table->string('Mk_pil');
            $table->string('MKWK');
            $table->tinyInteger('mk_jenis')->unsigned();
            $table->boolean('is_active')->default(false);
            $table->tinyInteger('struktur_mk_check')->default(0);
            $table->unsignedBigInteger('mk_id')->index();
            $table->unsignedBigInteger('cpl_prodi_id')->index();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();
            $table->index(
                name:'fk_d_strukturmk1_idx',
                columns:'mk_id'
            );
            $table->index(
                name:'fk_d_strukturmk2_idx',
                columns:'cpl_prodi_id'
            );
            $table->foreign(columns:'mk_id',name:'fk_d_strukturmk1')
            ->references('mk_id')->on('m_mk')
            ->noActionOnDelete()
            ->noActionOnUpdate();
            $table->foreign(columns:'cpl_prodi_id',name:'fk_d_strukturmk2')
            ->references('cpl_prodi_id')->on('m_cpl_prodi')
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
        Schema::dropIfExists('d_strukturmk');
    }
}
