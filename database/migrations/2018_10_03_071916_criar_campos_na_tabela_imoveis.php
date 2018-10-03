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
           
        });
    }


    public function down()
    {
       
    }
}
