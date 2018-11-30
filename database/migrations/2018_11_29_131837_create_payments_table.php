<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{

    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('charge_id');
            $table->string('status');
            $table->string('payment');
            $table->integer('plan_id');
            $table->integer('anunciante_id')->unsigned()->nullable();
            $table->string('notification_token')->nullable();
            $table->foreign('anunciante_id')->references('id')->on('anunciantes');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
