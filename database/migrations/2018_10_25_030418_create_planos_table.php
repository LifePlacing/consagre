<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanosTable extends Migration
{

    public function up()
    {
        Schema::create('planos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo', 60)->unique();
            $table->string('nome', 80);
            $table->integer('quant_anuncios');
            $table->integer('super_destaques');
            $table->integer('destaques');
            $table->integer('valor_mensal');
            $table->boolean('captacao')->default(false);            
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('planos');
    }
}
