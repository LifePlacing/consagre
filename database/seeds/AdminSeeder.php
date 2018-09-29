<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class AdminSeeder extends Seeder
{

    public function run()
    {
		User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com.br',
            'password' => Hash::make('15D4aeb4'),
			'verified'=>1,
        	'role'=>'admin'

        ]);


    }
}
