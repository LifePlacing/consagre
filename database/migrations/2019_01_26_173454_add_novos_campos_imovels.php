<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNovosCamposImovels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('imovels', function(Blueprint $table) { 
            $table->dropColumn('preco_venda');
            $table->dropColumn('preco');

        });

        Schema::table('imovels', function(Blueprint $table)
        {
            
            $table->decimal('preco_aluguel', 10,2)->nullable();
            $table->string('periodo_aluguel', 80)->nullable();
            

            $table->decimal('preco_venda', 10,2)->nullable();   
            $table->decimal('preco', 10,2)->nullable();   
        });
    }

    
    public function down()
    {
       
    }
}
