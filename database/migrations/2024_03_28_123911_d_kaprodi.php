<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DKaprodi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 
        Schema::create('d_kaprodi', function (Blueprint $table) {
            $table->id('kaprodi_id');
            $table->unsignedBigInteger('dosen_id')->index();
            $table->year('tahun')->index();
            $table->unsignedBigInteger('prodi_id')->index();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();
            $table->index(name:'fk_kaprodi_prodi1_idx',columns:'prodi_id');
            $table->foreign(columns:'prodi_id',name:'fk_kaprodi_prodi1')->references('prodi_id')->on('m_prodi')->noActionOnDelete()->noActionOnUpdate();
            $table->foreign('dosen_id')->references('dosen_id')->on('d_dosen');
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
        Schema::dropIfExists('d_kaprodi');
    }
}
