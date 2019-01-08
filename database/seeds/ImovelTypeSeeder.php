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
      DB::table('imovel_types')->insert(['tipo'=>'Casa']);
      DB::table('imovel_types')->insert(['tipo'=>'Casa Padrão']);
      DB::table('imovel_types')->insert(['tipo'=>'Sobrado']);
      DB::table('imovel_types')->insert(['tipo'=>'Flat']);
      DB::table('imovel_types')->insert(['tipo'=>'Habi']);
      DB::table('imovel_types')->insert(['tipo'=>'Duplex/Triplex']);
      DB::table('imovel_types')->insert(['tipo'=>'Apartamento']);
      DB::table('imovel_types')->insert(['tipo'=>'Loteamento / Condomínio']);
      DB::table('imovel_types')->insert(['tipo'=>'Fazenda / Rancho']);
      DB::table('imovel_types')->insert(['tipo'=>'Casa de Condomínio']);
      DB::table('imovel_types')->insert(['tipo'=>'Prédio Inteiro']);
      DB::table('imovel_types')->insert(['tipo'=>'Casa Commercial']);
      DB::table('imovel_types')->insert(['tipo'=>'Loja / Stúdio']);
      DB::table('imovel_types')->insert(['tipo'=>'Conjunto Comercial']);
      DB::table('imovel_types')->insert(['tipo'=>'Indústria']);
      DB::table('imovel_types')->insert(['tipo'=>'Loja / Salão']);
      DB::table('imovel_types')->insert(['tipo'=>'Galpão / Depósito']);
      DB::table('imovel_types')->insert(['tipo'=>'Chácara']);
      DB::table('imovel_types')->insert(['tipo'=>'Casa Rural']);
      DB::table('imovel_types')->insert(['tipo'=>'Fazenda / Rancho']);
      DB::table('imovel_types')->insert(['tipo'=>'Condomínio']);
    }
}
