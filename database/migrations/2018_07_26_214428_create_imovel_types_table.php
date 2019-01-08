<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImovelTypesTable extends Migration
{

    public function up()
    {
        Schema::create('imovel_types', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('tipo', 40);            
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('imovel_types');
    }
}
