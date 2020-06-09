<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSergenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sergen', function (Blueprint $table) {
            $table->foreignId('idSe')
                ->references('idSe')
                ->on('serie')
                ->onDelete('cascade');

            $table->foreignId('idGen')
                ->references('idGen')
                ->on('genero');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sergen');
    }
}
