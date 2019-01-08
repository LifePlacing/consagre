<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssinaturasTable extends Migration
{

    public function up()
    {
        Schema::create('assinaturas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('custom_id', 60)->unique();
            $table->string('name', 80);
            $table->integer('value');
            $table->string('status', 50);
            $table->integer('last_charge')->nullable();
            $table->integer('plano_id')->unsigned();
            $table->timestamps();
            $table->foreign('plano_id')->references('id')->on('planos');
        });
    }


    public function down()
    {
        Schema::dropIfExists('assinaturas');
    }
}
