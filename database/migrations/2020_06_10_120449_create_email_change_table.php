<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailChangeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_change', function (Blueprint $table) {
            $table->foreignId('idUsu')
                ->references('idUsu')
                ->on('usuario')
                ->onDelete('cascade');
            $table->text('newEmail');
            $table->string('token',69);
            $table->boolean('used')->nullable();
            $table->timestamp('created');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_change');
    }
}
