<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignCols extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media', function (Blueprint $table) {
          $table->foreign('imovel_id')->references('id')->on('imovels')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });          

    }


    public function down()
    {
        
    }
}
