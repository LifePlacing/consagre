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
       	'valor_mensal' => 3500,
       	'captacao' => false, 
        'interval' => 1

       ]);
        
       Plano::create([       	
       	'nome' => 'Plano Pro',
       	'quant_anuncios' => 0,
       	'super_destaques' => 10,
       	'destaques' => 50,
       	'valor_mensal' => 5000,
       	'captacao' => true, 
        'interval' => 1

       ]);
    }
}
