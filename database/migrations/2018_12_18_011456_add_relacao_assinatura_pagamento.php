<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelacaoAssinaturaPagamento extends Migration
{

    public function up()
    {
        Schema::table('payments', function(Blueprint $table)
        {
            $table->integer('assinatura_id')->unsigned()->nullable();
            $table->foreign('assinatura_id')->references('id')->on('assinaturas');
           
        });

        Schema::table('assinaturas', function(Blueprint $table)
        {
            $table->integer('anunciante_id')->unsigned()->nullable();
            $table->foreign('anunciante_id')->references('id')->on('anunciantes');
           
        });


    }

}
