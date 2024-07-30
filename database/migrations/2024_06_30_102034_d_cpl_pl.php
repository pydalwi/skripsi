<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DCplPl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('d_cpl_pl', function (Blueprint $table) {
            $table->id('cpl_pl_id');
            $table->boolean('is_active')->default(false);
            $table->tinyInteger('cpl_pl_check')->default(0);
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();
            $table->unsignedBigInteger('pl_id')->index();
            $table->unsignedBigInteger('cpl_prodi_id')->index();
            $table->index(
                name:'fk_cpl_pl1_idx',
                columns:'pl_id'
            );
            $table->index(
                name:'fk_cpl_pl2_idx',
                columns:'cpl_prodi_id'
            );
            $table->foreign(columns:'pl_id',name:'fk_d_cpl_pl1_id')
            ->references('pl_id')->on('m_profil_lulusan')
            ->noActionOnDelete()
            ->noActionOnUpdate();
            $table->foreign(columns:'cpl_prodi_id',name:'fk_d_cpl_pl2_id')
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
        //
        Schema::dropIfExists('d_cpl_pl');
    }
}
