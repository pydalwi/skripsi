<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MCplProdi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('m_cpl_prodi', function (Blueprint $table) {
            $table->id('cpl_prodi_id');
            $table->string('cpl_prodi_kategori',100)->nullable();
            $table->string('cpl_prodi_kode',10)->index();
            $table->longText('cpl_prodi_deskripsi')->nullable();
            $table->unsignedBigInteger('prodi_id')->nullable()->index();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();
            $table->index(name:'fk_cpl_prodi_pd1_idx',columns:'prodi_id');
            $table->foreign(columns:'prodi_id',name:'fk_cpl_prodi_pd1')->references('prodi_id')->on('m_prodi')
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
        Schema::dropIfExists('m_cpl_prodi');
    }
}
