<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterarCampoSenha extends Migration
{

    public function up()
    {

        Schema::table('users', function(Blueprint $table) { 
            $table->dropColumn('password');

        }); 

        Schema::table('users', function(Blueprint $table) { 
            $table->string('password', 150);

        }); 


    }


    public function down()
    {

    }
}
