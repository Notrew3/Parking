<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvulsosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avulsos', function (Blueprint $table) {
             $table->increments('id');
           // $table->unsignedInteger('clientes_id');
           // $table->foreign('clientes_id')->references('id')->on('clientes');
            $table->string('placa');
            $table->unsignedInteger('carro_id');
            $table->foreign('carro_id')->references('id')->on('carros');
            $table->boolean('patio');            
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
        Schema::dropIfExists('avulsos');
    }
}
