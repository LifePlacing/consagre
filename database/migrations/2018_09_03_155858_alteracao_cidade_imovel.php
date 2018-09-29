<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlteracaoCidadeImovel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cidades', function (Blueprint $table) {

            $table->increments('id');
            $table->string('nome');
            $table->string('slug');
            $table->timestamps();
        });   

        Schema::table('imovels', function (Blueprint $table) {
            $table->integer('cidade_id')->unsigned()->nullable();
            $table->dropColumn('cidade');
            $table->foreign('cidade_id')->references('id')->on('cidades');          
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
