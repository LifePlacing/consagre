<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCampoTabelaMedia extends Migration
{

    public function up()
    {
        Schema::table('media', function(Blueprint $table)
        {
            $table->longText('caption')->nullable();
        });
    }
  
}
