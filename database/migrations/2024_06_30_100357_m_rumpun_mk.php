<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MRumpunMk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('m_rumpun_mk', function (Blueprint $table) {
            $table->id('rumpun_mk_id');
            $table->string('rumpun_mk', 100)->index();
            $table->unsignedBigInteger('dosen_id')->index()->nullable();
            $table->unsignedBigInteger('kurikulum_id')->index();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();
            $table->index(name:'fk_rumpun_mk1_idx',columns:'dosen_id');
            $table->index(name:'fk_rumpun_mk2_idx',columns:'kurikulum_id');
            $table->foreign(columns:'dosen_id',name:'fk_rumpun_mk1')->references('dosen_id')->on('d_dosen')->noActionOnDelete()->noActionOnUpdate();
            $table->foreign(columns:'kurikulum_id',name:'fk_rumpun_mk2')->references('kurikulum_id')->on('d_kurikulum')->noActionOnDelete()->noActionOnUpdate();
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
        Schema::dropIfExists('m_rumpun_mk');
    }
}
