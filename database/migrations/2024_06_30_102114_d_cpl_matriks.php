<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DCplMatriks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 
        Schema::create('d_cpl_matriks', function (Blueprint $table) {
            $table->id('cpl_matriks_id');
            $table->boolean('is_active')->default(false);
            $table->tinyInteger('cpl_matriks_check')->default(0);
            $table->unsignedBigInteger('cpl_prodi_id')->index();
            $table->unsignedBigInteger('cpl_sndikti_id')->index();
            $table->unsignedBigInteger('prodi_id')->index();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();
            $table->index(name:'fk_cpl_matriks1_idx',columns:'cpl_prodi_id');
            $table->index(name:'fk_cpl_matriks2_idx',columns:'cpl_sndikti_id');
            $table->foreign(columns:'cpl_prodi_id',name:'fk_cpl_matriks1')->references('cpl_prodi_id')->on('m_cpl_prodi')
            ->noActionOnDelete()
            ->noActionOnUpdate();
            $table->foreign(columns:'cpl_sndikti_id',name:'fk_cpl_matriks2')->references('cpl_sndikti_id')->on('m_cpl_sndikti')
            ->noActionOnDelete()
            ->noActionOnUpdate();
            $table->foreign('prodi_id')->references('prodi_id')->on('m_prodi');
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
        Schema::dropIfExists('d_cpl_matriks');
    }
}
