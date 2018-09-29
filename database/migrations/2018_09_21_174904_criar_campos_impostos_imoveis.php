<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarCamposImpostosImoveis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    
        Schema::table('imovels', function(Blueprint $table) { 
            $table->dropColumn('suites');
            $table->dropColumn('garagem');

        });

        Schema::table('imovels', function(Blueprint $table) { 
            $table->smallInteger('suites')->default(0)->nullable();
            $table->smallInteger('garagem')->default(0)->nullable();
            $table->decimal('iptu', 10,2)->nullable();            
            $table->decimal('condominio', 10,2)->nullable();            

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
