<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarCampoCodigoImovel extends Migration
{

    public function up()
    {
      Schema::table('imovels', function (Blueprint $table) {           

        $table->string('codigo')->unique()->nullable();
        
        });    
    }


    public function down()
    {
        
    }
}
