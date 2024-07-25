<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class tmkbk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('t_mk_bk', function (Blueprint $table) {
            $table->id('mk_bk_id');
            $table->boolean('is_active')->default(false);
            $table->unsignedBigInteger('mk_id')->index();
            $table->unsignedBigInteger('bk_id')->index();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();
            $table->index(name:'fk_mk_bk1_idx',columns:'mk_id');
            $table->index(name:'fk_mk_bk2_idx',columns:'bk_id');
            $table->foreign(columns:'mk_id',name:'fk_mk_bk1')->references('mk_id')->on('m_mk')->noActionOnDelete()->noActionOnUpdate();
            $table->foreign(columns:'bk_id',name:'fk_mk_bk2')->references('bk_id')->on('m_bahan_kajian')->noActionOnDelete()->noActionOnUpdate();
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
        Schema::dropIfExists('t_mk_bk');
    }
}
