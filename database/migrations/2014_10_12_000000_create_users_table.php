<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 80);
            $table->string('email', 50)->unique();
            $table->string('cpf', 14)->unique()->nullable();
            $table->string('password', 50);
            $table->string('phone',20)->nullable();
            $table->string('sobre')->nullable();
            $table->enum('user_type', array('proprietario', 'corretor', 'imobiliaria'))->default('proprietario');
            $table->enum('role', array('admin', 'membro'))->default('membro');
            $table->boolean('verified')->default(false);
            $table->rememberToken();
            $table->timestamps();            
        });
    }


    public function down()
    {
        Schema::dropIfExists('users');
    }
}
