<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelacionadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relacionados', function (Blueprint $table) {
            $table->foreignId('idSe')
                ->references('idSe')
                ->on('serie')
                ->onDelete('cascade');

            $table->foreignId('idRel')
                ->references('idSe')
                ->on('serie')
                ->onDelete('cascade');
            $table->text('tipo');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relacionados');
    }
}
