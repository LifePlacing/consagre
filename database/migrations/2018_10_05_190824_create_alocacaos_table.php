<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlocacaosTable extends Migration
{

    public function up()
    {
        Schema::create('alocacoes', function (Blueprint $table) {

            $table->integer('imovel_id')->unsigned();
            $table->foreign('imovel_id')->references('id')->on('imovels');

            $table->integer('anunciante_id')->unsigned();
            $table->foreign('anunciante_id')->references('id')->on('anunciantes');

            $table->timestamps();

            $table->primary(['imovel_id', 'anunciante_id']);

        });
    }


    public function down()
    {
        Schema::dropIfExists('alocacoes');
    }
}
