<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DKurikulum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('d_kurikulum', function (Blueprint $table) {
            $table->id('kurikulum_id');
            $table->year('kurikulum_tahun')->index();
            $table->unsignedBigInteger('prodi_id')->index();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();
            $table->index(name:'fk_kurikulum_prodi1_idx',columns:'prodi_id');
            $table->foreign(columns:'prodi_id',name:'fk_kurikulum_prodi1')->references('prodi_id')->on('m_prodi')->noActionOnDelete()->noActionOnUpdate();
            
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
        Schema::dropIfExists('d_kurikulum');
    }
}
