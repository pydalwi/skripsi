<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DDosen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('d_dosen', function (Blueprint $table) {
            $table->id('dosen_id');
            $table->string('nama_dosen',200)->nullable();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('prodi_id')->nullable();
            $table->string('nip',50)->nullable();
            $table->string('nidn',50)->nullable();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();

            $table->foreign('user_id')->references('user_id')->on('s_user');
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
        Schema::dropIfExists('d_dosen');
    }
}
