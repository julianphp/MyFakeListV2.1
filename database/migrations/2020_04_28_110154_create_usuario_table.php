<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->bigIncrements('idUsu');
            $table->string('alias',20)->unique();
            $table->string('email',77)->unique();
            $table->text('password');
            $table->string('avatar',200)->default('avatares/default.jpg');
            $table->string('about',500)->nullable();
            $table->string('location',70)->nullable();
            $table->timestamps();
            $table->rememberToken();
            $table->integer('is_admin')->nullable();
            $table->softDeletes();
            $table->string('token_delete_account',69)->nullable();
            $table->timestamp('token_delete_account_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario');
    }
}
