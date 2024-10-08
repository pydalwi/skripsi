<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MCplIndikator extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        {
            //
            Schema::create('m_cpl_indikator', function (Blueprint $table) {
                $table->id('cpl_indikator_id');
                $table->float('cpl_indikator_kode')->index();
                $table->longText('cpl_indikator_kinerja')->nullable();
                $table->dateTime('created_at')->nullable()->useCurrent();
                $table->integer('created_by')->nullable()->index();
                $table->dateTime('updated_at')->nullable();
                $table->integer('updated_by')->nullable()->index();
                $table->dateTime('deleted_at')->nullable()->index();
                $table->integer('deleted_by')->nullable()->index();  
                $table->unsignedBigInteger('prodi_id')->index();
                $table->foreign('prodi_id')->references('prodi_id')->on('m_prodi');
                $table->unsignedBigInteger('cpl_prodi_id')->index();
                $table->foreign('cpl_prodi_id')->references('cpl_prodi_id')->on('m_cpl_prodi');
            });
           
    }
}
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_cpl_indikator');
    }
    
}
