<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXmlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xmls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sistema', 80);
            $table->string('url', 200);
            $table->dateTime('LastPublishDate')->nullable();
            $table->integer('anunciante_id')->unsigned();
            $table->foreign('anunciante_id')->references('id')->on('anunciantes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('xmls');
    }
}
