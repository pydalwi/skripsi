<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DCpmk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('d_cpmk', function (Blueprint $table) {
            $table->id('cpmk_id');
            $table->string('cpmk_kode')->unique()->nullable();
            $table->longText('cpmk_deskripsi')->nullable();
            $table->unsignedBigInteger('mk_id')->index();
            $table->unsignedBigInteger('cpl_prodi_id')->index();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();
            $table->unsignedBigInteger('prodi_id')->index();
            $table->foreign('prodi_id')->references('prodi_id')->on('m_prodi');
            $table->index(name:'fk_cpmk1_idx',columns:'mk_id');
            $table->foreign(columns:'mk_id',name:'fk_cpmkidx1')->references('mk_id')->on('m_mk')->noActionOnDelete()->noActionOnUpdate();
            $table->index(name:'fk_cpmk2_idx',columns:'cpl_prodi_id');
            $table->foreign(columns:'cpl_prodi_id',name:'fk_cpmkidx2')->references('cpl_prodi_id')->on('m_cpl_prodi')->noActionOnDelete()->noActionOnUpdate();

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
        Schema::dropIfExists('d_cpmk');
    }
}
