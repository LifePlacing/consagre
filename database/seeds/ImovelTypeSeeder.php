<?php

use Illuminate\Database\Seeder;

class ImovelTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('imovel_types')->insert(['tipo'=>'Apartamento Padrão']);
      DB::table('imovel_types')->insert(['tipo'=>'Kitchenette/Conjugado']);
      DB::table('imovel_types')->insert(['tipo'=>'Loft']);
      DB::table('imovel_types')->insert(['tipo'=>'Casa Padrão']);
      DB::table('imovel_types')->insert(['tipo'=>'Terreno']);
      DB::table('imovel_types')->insert(['tipo'=>'Garagem']);
      DB::table('imovel_types')->insert(['tipo'=>'Ponto Comercial']);
      DB::table('imovel_types')->insert(['tipo'=>'Casa de vila']);
      DB::table('imovel_types')->insert(['tipo'=>'Conjunto Comercial/Sala']);
      DB::table('imovel_types')->insert(['tipo'=>'Fazenda']);
      DB::table('imovel_types')->insert(['tipo'=>'Flat']);
      DB::table('imovel_types')->insert(['tipo'=>'Galpão/Deposito']);
      DB::table('imovel_types')->insert(['tipo'=>'Loja Shopping']);
      DB::table('imovel_types')->insert(['tipo'=>'Loja / Salão']);
      DB::table('imovel_types')->insert(['tipo'=>'Loteamento / Condominio']);
      DB::table('imovel_types')->insert(['tipo'=>'Hotel / Motel']);
      DB::table('imovel_types')->insert(['tipo'=>'Pousada']);
      DB::table('imovel_types')->insert(['tipo'=>'Prédio Inteiro']);
    }
}
