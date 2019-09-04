<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensagemsTable extends Migration
{

    public function up()
    {
        Schema::create('mensagems', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('msg');
            $table->string('email_remetente');
            $table->string('nome_remetente');
            $table->string('telefone');
            $table->integer('imovel_id')->unsigned();             
            $table->foreign('imovel_id')->references('id')->on('imovels');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('mensagems');        
    }
}
