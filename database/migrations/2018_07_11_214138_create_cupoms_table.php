<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCupomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cupoms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tabela_preco_id');
            $table->foreign('tabela_preco_id')->references('id')->on('tabela_preco');
            $table->unsignedInteger('precos_id');
            $table->foreign('precos_id')->references('id')->on('precos');
            $table->unsignedInteger('avulsos_id');
            $table->foreign('avulsos_id')->references('id')->on('avulsos');
            $table->time('estadia');
            $table->float('valor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cupoms');
    }
}
