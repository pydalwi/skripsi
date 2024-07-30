<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DKurikulumMk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_kurikulum_mk', function (Blueprint $table) {
            $table->id('kurikulum_mk_id');
            $table->unsignedBigInteger('kurikulum_id')->index();
            $table->unsignedBigInteger('rumpun_mk_id')->index()->nullable();
            $table->unsignedBigInteger('mk_id')->index();
            $table->unsignedBigInteger('prodi_id')->index();
            $table->unsignedBigInteger('periode_id')->nullable();
            $table->string('kode_mk', 10)->index();
            $table->smallInteger('sks')->nullable();
            $table->smallInteger('semester')->nullable();
            $table->smallInteger('jumlah_jam')->nullable();
            $table->string('kelompok_mk', 10)->index();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();

            $table->foreign('kurikulum_id')->references('kurikulum_id')->on('d_kurikulum');
            $table->foreign('rumpun_mk_id')->references('rumpun_mk_id')->on('m_rumpun_mk');
            $table->foreign('mk_id')->references('mk_id')->on('m_mk');
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
        Schema::dropIfExists('d_kurikulum_mk');
    }
}