<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelacaoAnuncianteImovel extends Migration
{

    public function up()
    {
        Schema::table('imovels', function(Blueprint $table)
        {
            $table->integer('anunciante_id')->unsigned()->nullable();            
            $table->foreign('anunciante_id')->references('id')->on('anunciantes');
           
        });

         Schema::table('anunciantes', function(Blueprint $table)
        {
        	$table->string('cpf', 14)->unique()->nullable();
        });

    }


}
