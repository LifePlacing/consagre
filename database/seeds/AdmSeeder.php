<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Admin;

class AdmSeeder extends Seeder
{

    public function run()
    {
        Admin::create([
            'nome' => 'Administrador',
            'email' => 'administrador@admin.com.br',
            'password' => Hash::make('15D4aeb4'),
        ]);
    }
}
