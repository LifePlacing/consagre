<?php

use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{

    public function run()
    {
        DB::table('categorias')->insert(['name'=> 'Padrão']);
        DB::table('categorias')->insert(['name'=> 'Duplex']);
        DB::table('categorias')->insert(['name'=> 'Triplex']);
        DB::table('categorias')->insert(['name'=> 'Cobertura']);
    }
}
