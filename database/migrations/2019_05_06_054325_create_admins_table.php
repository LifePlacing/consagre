<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{

    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nome', 80);
            $table->string('email', 80)->unique();
            $table->string('password', 100);
            $table->rememberToken();
        });
    }


    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
