<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterarCampoPrecoImovel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imovels', function(Blueprint $table) { 
            $table->dropColumn('preco');

        }); 
        Schema::table('imovels', function(Blueprint $table) { 
            $table->decimal('preco', 10,2);
            $table->string('estado', 20);
            $table->softDeletes();

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
