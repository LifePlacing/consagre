<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];


    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('isProprietario', function($user){

            return $user->user_type == 'proprietario';
        });

        $gate->define('isCorretor', function($user){

            return $user->user_type == 'corretor';
        });

        $gate->define('isImobiliaria', function($user){

            return $user->user_type == 'imobiliaria';
        });  

        $gate->define('isComboAdmin', function($user){
            return $user->user_type == 'proprietario'&&'corretor'&&'imobiliaria';
        }); 

        $gate->define('isComboAds', function($user){
            return $user->user_type == 'proprietario'&&'corretor';
        });   

        $gate->define('isComboVendas', function($user){
            return $user->user_type == 'corretor'&&'imobiliaria';
        });  
        
    }
}
