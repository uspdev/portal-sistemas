<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        $nomes = ['Acadêmico', 'Financeiro', 'Administrativo', 'Graduação', 'Pós-graduação', 'Biblioteca', 'Informática'];

        foreach ($nomes as $nome) {
            $grupo = \App\Models\Grupo::factory()->create(['nome' => $nome]);
            // $c->settings()->set('estado', 'producao');
            $numsistemas = mt_rand(2, 8);
            for ($j = 1; $j <= $numsistemas; $j++) {
                $sistema = \App\Models\Sistema::factory()->create();
                $sistema->grupos()->save($grupo);
            }
        }
    }
}
