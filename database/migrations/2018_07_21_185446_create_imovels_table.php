<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImovelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imovels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo', 80);
            $table->enum('meta', array('aluguel', 'venda', 'temporada'));
            $table->decimal('preco', 10,2);            
            $table->smallInteger('banheiros');
            $table->smallInteger('suites')->nullable();
            $table->smallInteger('quartos');
            $table->smallInteger('garagem')->nullable();
            $table->double('area_util', 8,2);
            $table->double('area_total', 8,2)->nullable();
            $table->longText('descricao')->nullable();
            $table->string('cidade', 50);
            $table->string('logradouro', 50);
            $table->string('bairro', 50);
            $table->string('cep', 8);
            $table->string('unidade', 8);            
            $table->integer('status')->length(1)->default(0);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('imovels');
    }
}
