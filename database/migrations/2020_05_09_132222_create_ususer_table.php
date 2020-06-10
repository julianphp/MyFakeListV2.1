<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ususer', function (Blueprint $table) {
            $table->foreignId('idUsu')
                ->references('idUsu')
                ->on('usuario')
                ->onDelete('cascade');

            $table->foreignId('idSe')
                ->references('idSe')
                ->on('serie')
                ->onDelete('cascade');

            $table->integer('capitulo');
            $table->string('status',50);
            $table->integer('score')->nullable();
            $table->string('review',255)->nullable();
            $table->timestamp('fec_add',0);
            $table->timestamp('fec_end',0)->nullable();
            $table->boolean('favorita')->nullable();
            $table->primary(['idUsu', 'idSe']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ususer');
    }
}
