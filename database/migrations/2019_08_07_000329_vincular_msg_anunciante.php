<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VincularMsgAnunciante extends Migration
{

    public function up()
    {
        Schema::table('mensagems', function(Blueprint $table)
        {
            $table->integer('anunciante_id')->nullable()->unsigned();             
            $table->foreign('anunciante_id')->references('id')->on('anunciantes');
        });
    }

    
    public function down()
    {
        
    }
}
