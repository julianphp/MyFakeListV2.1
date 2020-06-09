<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSerieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serie', function (Blueprint $table) {
            $table->id('idSe')->unsigned();
            $table->text('descripcion');
            $table->text('duracion');
            $table->boolean('emitiendo');
            $table->integer('episodios');
            $table->text('estado');
            $table->timestamp('fec_ini',0)->nullable();
            $table->timestamp('fec_fin',0)->nullable();
            $table->text('img');
            $table->text('pegi');
            $table->text('tipo');
            $table->text('titulo');
            $table->text('tituloJap');
            $table->text('trailer');
            $table->foreignId('idEst');
        });
        Schema::table('serie', function (Blueprint $table){
            $table->foreign('idEst')
                ->references('idEst')
                ->on('estudio')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('serie');
    }
}
