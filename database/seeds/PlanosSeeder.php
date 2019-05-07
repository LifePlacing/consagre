<?php

use Illuminate\Database\Seeder;
use App\Plano;

class PlanosSeeder extends Seeder
{

    public function run()
    {
       Plano::create([       	
       	'nome' => 'Plano Básico',
       	'quant_anuncios' => 0,
       	'super_destaques' => 5,
       	'destaques' => 10,
       	'valor_mensal' => 2900,
       	'captacao' => false, 
        'interval' => 0
        /* Para plano mensal assinatura interval = 1*/
       ]);
        
       Plano::create([       	
       	'nome' => 'Plano Pro',
       	'quant_anuncios' => 0,
       	'super_destaques' => 10,
       	'destaques' => 50,
       	'valor_mensal' => 4000,
       	'captacao' => true, 
        'interval' => 0
        /* Para plano mensal assinatura interval = 1*/
       ]);
    }
}
