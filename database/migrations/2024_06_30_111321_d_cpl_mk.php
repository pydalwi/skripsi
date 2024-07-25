<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DCplMk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_cpl_mk', function (Blueprint $table) {
            $table->id('cpl_mk_id');
            $table->boolean('is_active')->default(false);
            $table->string('mk_nama');
            $table->unsignedBigInteger('cpl_prodi_id')->nullable()->index();
            $table->unsignedBigInteger('mk_id')->nullable()->index();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();
            $table->index(name:'fk_cpl_mk1_idx',columns:'cpl_prodi_id');
            $table->index(name:'fk_cpl_mk2_idx',columns:'mk_id');
            $table->foreign(columns:'cpl_prodi_id',name:'fk_cpl_mk1')->references('cpl_prodi_id')->on('m_cpl_prodi')
            ->noActionOnDelete()
            ->noActionOnUpdate();
            $table->foreign(columns:'mk_id',name:'fk_cpl_mk2')->references('mk_id')->on('m_mk')
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
        Schema::dropIfExists('d_cpl_mk');
    }
}
