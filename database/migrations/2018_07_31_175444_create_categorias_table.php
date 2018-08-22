<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('name', array('Padrão', 'Duplex', 'Triplex', 'Cobertura'));
            $table->timestamps();
        });

        Schema::table('imovels', function (Blueprint $table) {           

        $table->foreign('categoria_id')->references('id')->on('categorias')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });  
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorias');
    }
}
