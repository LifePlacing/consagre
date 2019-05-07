<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriaSeeder::class);
        $this->call(ImovelTypeSeeder::class);
        $this->call(AdmSeeder::class);
        $this->call(PlanosSeeder::class);
    }
}
