<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlteracaoImoveis extends Migration
{

    public function up()
    {
       Schema::table('imovels', function (Blueprint $table) {
            $table->integer('imovel_type_id')->unsigned();
            $table->integer('user_id')->unsigned();           
            $table->integer('categoria_id')->unsigned();           
                      
       });
       
    }


    public function down()
    {
        //
    }
}
