<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnunciantesTable extends Migration
{

    public function up()
    {
        Schema::create('anunciantes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 80);
            $table->string('tipo', 20);
            $table->string('creci', 7)->nullable();
            $table->string('email',50)->unique();
            $table->string('password', 60)->nullable();
            $table->string('site')->nullable();
            $table->string('phone_fixo', 20);
            $table->string('celular', 20);
            $table->longText('sobre')->nullable();
            $table->string('cidade', 50);
            $table->string('logradouro', 50);
            $table->string('bairro', 50);
            $table->string('cep', 8);
            $table->string('unidade', 8);
            $table->string('logo')->nullable();
            $table->string('contato', 80)->nullable();
            $table->string('cargo', 70)->nullable();
            $table->boolean('verified')->default(false);
            $table->rememberToken();            
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('anunciantes');
    }
}
