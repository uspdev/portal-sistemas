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
            $numItens = mt_rand(2, 8);
            for ($j = 1; $j <= $numItens; $j++) {
                $item = \App\Models\Item::factory()->create(['grupo_id' => $grupo->id]);
                // $item->grupo()->save($grupo);
            }
        }
    }
}
