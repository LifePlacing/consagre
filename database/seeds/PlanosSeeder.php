<?php

use Illuminate\Database\Seeder;
use App\Plano;

class PlanosSeeder extends Seeder
{

    public function run()
    {
       Plano::create([       	
       	'nome' => 'Plano Básico',
       	'quant_anuncios' => 50,
       	'super_destaques' => 1,
       	'destaques' => 5,
       	'valor_mensal' => 2900,
       	'captacao' => false, 
        'interval' => 1

       ]);
        
       Plano::create([       	
       	'nome' => 'Plano Pro-100',
       	'quant_anuncios' => 100,
       	'super_destaques' => 10,
       	'destaques' => 5,
       	'valor_mensal' => 4000,
       	'captacao' => true, 
        'interval' => 1

       ]);
    }
}
