<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gateways', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nome', 60);
            $table->string('email', 60)->nullable();
            $table->string('cliente_id', 120)->nullable();
            $table->string('cliente_secret', 120)->nullable();
            $table->boolean('cliente_sandbox')->default(true);
            $table->string('token', 80)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gateways');
    }
}
