<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('media', function (Blueprint $table) {
        $table->increments('id');
        $table->binary('source');
        $table->integer('position')->nullable();
        $table->integer('imovel_id')->unsigned();
        $table->timestamps();
        $table->softDeletes();
      });
    }

    public function down()
    {
        Schema::dropIfExists('media');
    }
}
