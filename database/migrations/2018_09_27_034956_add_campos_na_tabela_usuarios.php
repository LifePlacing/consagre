<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCamposNaTabelaUsuarios extends Migration
{

    public function up()
    {
            Schema::table('users', function(Blueprint $table)
        {
            $table->string('sexo')->nullable();
            $table->string('foto')->nullable();
        });
    }


    public function down()
    {
        //
    }
}
