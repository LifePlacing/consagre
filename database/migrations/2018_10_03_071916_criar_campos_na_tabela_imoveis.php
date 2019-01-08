<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarCamposNaTabelaImoveis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imovels', function(Blueprint $table)
        {
            $table->decimal('preco_venda', 10,2);
            $table->boolean('sob_consulta')->default(false);
            $table->enum('tipo_de_anuncio', array('simples', 'destaque', 'super'))->default('simples');
            $table->integer('total_visualizacao')->nullable();
           
        });
    }


    public function down()
    {
       
    }
}
