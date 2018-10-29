<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarRelacaoAnunciantePlano extends Migration
{

    public function up()
    {
        Schema::table('anunciantes', function(Blueprint $table)
        {
            $table->integer('plano_id')->unsigned()->nullable();
            $table->foreign('plano_id')->references('id')->on('planos');            
           
        });
    }


}
